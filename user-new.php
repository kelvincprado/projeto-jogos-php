<!DOCTYPE html>
<?php
    require_once "includes/banco.php";
    require_once "includes/funcoes.php";
    require_once "includes/login.php";
?>
<html lang="pt-br">
    <head>
        <title>Novo usuário</title>
        <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="estilos/estilo.css"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <main>
            <?php
                if(!is_admin()){
                    echo msg_erro('AREA RESTRITA! Você não é administrador!');
                }else{
                    if(!isset($_POST['usuario'])){
                        require 'user-new-form.php';
                    }else{
                        $usuario = $_POST['usuario'];
                        $nome = $_POST['nome'];
                        $senha1 = $_POST['senha1'];
                        $senha2 = $_POST['senha2'];
                        $tipo = $_POST['tipo'];

                        if($senha1 === $senha2){
                            if (empty($usuario) || empty($nome) || empty($senha1) || empty($senha2) || empty($tipo)){
                                echo msg_erro("Todos os dados sao obrigatórios!");
                            }else{
                                $senha = gerarHash($senha1);
                                $sql = "INSERT INTO usuarios (usuario, nome, senha, tipo) VALUES ('$usuario', '$nome', '$senha', '$tipo')";
                                if($banco->query($sql)){
                                    echo msg_sucesso("Usuario $nome cadastrado com sucesso!");
                                }else{
                                    echo msg_erro("Não foi possivel criar o usuário $usuario. Talvez o login já esteja sendo usado.");
                                }
                            }
                        }else{
                            echo msg_erro("Senhas não conferem");
                        }
                    }
                }
                echo voltar();
            ?>
        </main>
    </body>
</html>