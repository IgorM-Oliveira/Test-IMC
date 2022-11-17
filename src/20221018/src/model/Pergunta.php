<?php
namespace App\model;

require_once "Conexao.php";

class Pergunta {
    private $id;
    private $pergunta;
    private $status;
    private $usuario;

    private $conexao;

    function __construct($pergunta=null, $status=null) {
        $this->setPergunta($pergunta);
        $this->setStatus($status);

        $this->conexao = Conexao::getInstancia();
    }


    // Getters and Setters
    public function getId() {
        return $this->id;
    }
    public function getPergunta() {
        return $this->pergunta;
    }
    public function getStatus() {
        return $this->status;
    }
    public function getUsuario() {
        return $this->usuario;
    }
    public function setPergunta($pergunta) {
        $this->pergunta = $pergunta;
    }
    public function setStatus($status) {
        $this->status = $status;
    }
    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }


    // Crud
    public function criar() {
        if ($this->id != null) {
            return false;
        }

        $usuarioId = 1;
        if ($this->getUsuario() != null) {
            $usuarioId = $this->getUsuario();
        }

        $query = "INSERT INTO perguntas (pergunta,status,usuario_id,created,modified) VALUES ('" . $this->pergunta . "','" . $this->status . "','" . $usuarioId . "','" . date(DATE_ATOM) . "','" . date(DATE_ATOM) . "')";

        $result = pg_query($query);

        if ($result) {
            $this->id = pg_last_oid($result);
        }

        return $result;
    }

    public function ler($id = null) {
        if ($id == null) {
            $sql = "SELECT * FROM perguntas";
        } else {
            $sql = "SELECT * FROM perguntas WHERE id='$id'";
        }
        $returnValue = array();

        $result = pg_query($sql);

        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            array_push($returnValue, $line);
        }

        return $returnValue;
    }

    public function getPerguntaDetalhes($id) {
        $result = $this->ler($id);
        if (empty($result)) {
            return 0;
        }

        $result = $result[0];

        $this->id = $id;
        $this->setPergunta($result["pergunta"]);
        $this->setStatus($result["status"]);

        return $this;
    }

    public function atualizar() {
        error_reporting(E_ERROR | E_PARSE);

        if ($this->id == null) {
            return false;
        }

        $query = "UPDATE perguntas SET pergunta= '" . $this->pergunta . "', status= '" . $this->status . "', modified= '" . date(DATE_ATOM) . "' WHERE id= '" . $this->id . "'";

        $result = pg_query($query);

        return $result;
    }

    public function deletar() {
        if ($this->id == null) {
            return false;
        }

        $query = "DELETE FROM perguntas WHERE id='" . $this->id . "'";

        $result = pg_query($query);
        
        if($result) {
            $this->id = null;
        }

        return $result;
    }
}