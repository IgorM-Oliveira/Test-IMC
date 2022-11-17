<?php
namespace App\model;

require_once "Conexao.php";

class Usuario
{
    private $id;
    private $nome;
    private $rgm;
    private $nomeUsuario;
    private $senha;
    private $status;
    private $tipo;
    private $administrador;

    private $enumAdministrador = array(null => null, "t" => true, "f" => false);

    private $conexao;

    function __construct(
        $nome = null,
        $rgm = null,
        $nomeUsuario = null,
        $senha = null,
        $status = null,
        $tipo = null,
        $administrador = null
    ) {
        $this->id = null;
        $this->setNome($nome);
        $this->setRGM($rgm);
        $this->setNomeUsuario($nomeUsuario);
        $this->setSenha($senha);
        $this->setStatus($status);
        $this->setTipo($tipo);
        $this->setAdministrador($administrador);

        $this->conexao = Conexao::getInstancia();
    }

    public function getId()
    {
        return $this->id;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setRGM($rgm)
    {
        $this->rgm = $rgm;
    }
    public function
    setNomeUsuario($nomeUsuario)
    {
        $this->nomeUsuario = $nomeUsuario;
    }
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function getStatus()
    {
        return $this->status;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }
    public function getTipo()
    {
        return $this->tipo;
    }
    public function
    setAdministrador($administrador)
    {
        $this->administrador = $this->enumAdministrador[$administrador];
    }
    public function getAdministrador()
    {
        return $this->administrador;
    }


    public function criar()
    {
        if ($this->id != null)
            return false;

        $query = "INSERT INTO usuarios (nome,rgm,usuario,senha,status,tipo,administrador,created,modified) VALUES ('" . $this->nome . "','" . $this->rgm . "','" . $this->nomeUsuario . "','" . md5(sha1($this->senha)) . "','remove_red_eye','person',false,'" . date(DATE_ATOM) . "','" . date(DATE_ATOM) . "')";

        $result = pg_query($query);

        if ($result)
            $this->id = pg_last_oid($result);

        return $result;
    }

    public function ler($id = null)
    {
        if ($id == null) {
            $sql = "SELECT * FROM usuarios";
        } else {
            $sql = "SELECT * FROM usuarios WHERE id='$id'";
        }
        $returnValue = array();

        $result = pg_query($sql);

        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            array_push($returnValue, $line);
        }

        return $returnValue;
    }

    public function getUsuario($id)
    {
        $result = $this->ler($id);
        if (empty($result))
            return 0;

        $result = $result[0];

        $this->id = $id;
        $this->setNome($result["nome"]);
        $this->setRGM($result["rgm"]);
        $this->setNomeUsuario($result["usuario"]);
        $this->setSenha($result["senha"]);
        $this->setTipo($result["tipo"]);
        $this->setStatus($result["status"]);
        $this->setAdministrador($result["administrador"]);

        return $this;
    }

    public function atualizar()
    {
        error_reporting(E_ERROR | E_PARSE);

        if ($this->id == null)
            return false;

        $query = "UPDATE usuarios SET nome= '" . $this->nome . "', rgm= '" . $this->rgm . "', usuario= '" . $this->usuario . "', senha= '" . $this->senha . "', status= '" . $this->status . "', tipo= '" . $this->tipo . "', administrador= '" . $this->administrador . "', modified= '" . date(DATE_ATOM) . "' WHERE id= '" . $this->id . "'";

        $result = pg_query($query);

        return $result;
    }

    public function deletar()
    {
        if ($this->id == null)
            return false;

        $query = "DELETE FROM usuarios WHERE id='" . $this->id . "'";

        $result = pg_query($query);
        
        if($result)
            $this->id = null;

        return $result;
    }
}


//Instanciar um novo usuario com dados
//$usuario = new Usuario("Felipe", "46763", "fpp", "12345", "remove_red_eye", "supervisor_account", true);
//Inserir no banco de dados
//$usuario->criar();

//Instanciar um novo usuario sem dados
//$usuario = new Usuario();
//Pegar as informações do usuario pelo seu ID
//$usuario->getUsuario(2);

//Setar informações do usuario
//$usuario->setNome("Felipe");
//Atualizar informações no banco de dados
//$usuario->atualizar();

//Deletar o usuario
//$usuario->deletar();