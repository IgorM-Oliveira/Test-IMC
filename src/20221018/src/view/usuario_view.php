<?php
$usuarios = $_REQUEST['usuarios'];

$icons = array("create" => "Editor", "remove_red_eye" => "Somente Leitura", "clear" => "Bloqueado", "supervisor_account" => "Professor", "person" => "Aluno", "verified_user" => "Administrador");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .tooltipped {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Modal Structure -->
    <div id="modalUsuario" class="modal">
        <div class="modal-content">
            <h4>Usuário</h4>
            <h5 id="usuarioModalUsuario"></h5>
            <br><br>
            <div class="row">
                <form id="formUsuario" method="post" action="controller/InserirController.php">
                    <div class="input-field col m4 s12">
                        <input name="nome" id="nome" type="text" class="validate">
                        <label for="nome">Nome</label>
                    </div>
                    <div class="input-field col m4 s12">
                        <input name="nomeUsuario" id="nomeUsuario" type="text" class="validate">
                        <label for="nomeUsuario">Nome de Usuario</label>
                    </div>
                    <div class="input-field col m4 s12">
                        <input name="rgm" id="rgm" type="text" class="validate">
                        <label for="rgm">RGM</label>
                    </div>
                    <div class="input-field col m4 s12">
                        <select id="selectTipo" name="tipoUsuario">
                            <option value="" disabled selected>Selecione o Tipo</option>
                            <option value="supervisor_account">Professor</option>
                            <option value="person">Aluno</option>
                        </select>
                        <label>Tipo do Usuário</label>
                    </div>
                    <div class="input-field col m4 s12">
                        <select id="selectStatus" name="statusUsuario">
                            <option value="" disabled selected>Selecione o Status</option>
                            <option value="create">Editor</option>
                            <option value="remove_red_eye">Somente Leitura</option>
                            <option value="clear">Bloqueado</option>
                        </select>
                        <label>Status do Usuário</label>
                    </div>
                    <div class="input-field col m4 s12">
                        <select id="selectAdministrador" name="administradorUsuario">
                            <option value="" disabled selected>Selecione a Resposta</option>
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                        <label>Usuário Administrador</label>
                    </div>
                    <br><br><br><br><br><br><br><br><br><br><br><br>
                    <div class="col s12 right-align">
                        <a class="waves-effect waves-light btn light-blue lighten-1 btnSubmit" id="btnSubmitUsuario" data-form="formUsuario">Enviar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <nav class="light-blue lighten-1" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="index.php?p=home" class="brand-logo">PeR EngSoft</a>
    </nav>
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 m6">
                    <h4>Usuários</h4>
                </div>
            </div>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th></th>
                <th>Nome</th>
                <th>RGM</th>
                <th>Tipo</th>
                <th>Status</th>
            </tr>
            <?php
            foreach ($usuarios as $usuario) {
            ?>
                <tr>
                    <td><?= $usuario["id"] ?></td>
                    <td>
                        <?php
                        if ($usuario["administrador"] == 't') {
                        ?>
                            <i class="material-icons tooltipped" data-position="bottom" data-tooltip="<?= $icons["verified_user"] ?>"><?= "verified_user" ?></i>
                        <?php
                        }
                        ?>
                    </td>
                    <td><?= $usuario["nome"] ?></td>
                    <td><?= $usuario["rgm"] ?></td>
                    <td><i class="material-icons tooltipped" data-position="bottom" data-tooltip="<?= $icons[$usuario["tipo"]] ?>"><?= $usuario["tipo"] ?></i></td>
                    <td><i class="material-icons tooltipped" data-position="bottom" data-tooltip="<?= $icons[$usuario["status"]] ?>"><?= $usuario["status"] ?></i></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red" id="btn-add-user">
            <i class="large material-icons">add</i>
        </a>
    </div>
    <!-- Compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(() => {
            $('.modal').modal();
            $('.tooltipped').tooltip();
            $('.fixed-action-btn').floatingActionButton();

            $('#btn-add-user').click(() => {
                $('.modal').modal('open');
            })

            $('select').formSelect();

            $('#btnSubmitUsuario').click(()=>{
                $('#formUsuario').submit();
            })
        });
    </script>

</body>

</html>