<!DOCTYPE html>
<?php
    require_once "includes/banco.php";
    require_once "includes/funcoes.php";
    require_once "includes/login.php";
?>
<html lang="pt-br">
    <head>
        <title>Login de Usuário</title>
        <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="estilos/estilo.css"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <style>
            main{
                width: 300px;
                font-size: 15pt;
                /*position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);*/
            }
            td{
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <main>
            <?php
                if(isset($_POST['usuario'])){
                    $u = $_POST['usuario'];
                }else{
                    $u = null;
                }

                if(isset($_POST['senha'])){
                    $s = $_POST['senha'];
                }else{
                    $s = null;
                }
                

                if(is_null($u) || is_null($s)){
                    require "user-login-form.php";
                }else{
                    $busca = $banco->query("select usuario, nome, senha, tipo from usuarios where usuario = '$u' limit 1");
                    if (!$busca){
                        echo msg_erro("Falha ao acessar o banco!");
                    }else{
                        if($busca->num_rows > 0){
                            $reg = $busca->fetch_object();
                            if(testarHash($s, $reg->senha)){
                                echo msg_sucesso("Logado com sucesso");
                                $_SESSION['nome'] = $reg->nome;
                                $_SESSION['user'] = $reg->usuario;
                                $_SESSION['tipo'] = $reg->tipo;
                            }else{
                                echo msg_erro("Senha inválida");
                            }
                        }else{
                            echo msg_erro("Usuário não existe!");
                        }
                        
                    }
                }
                echo voltar();
            ?>
        </main>
    </body>
</html>