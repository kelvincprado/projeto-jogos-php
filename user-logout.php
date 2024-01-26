<!DOCTYPE html>
<?php
    require_once "includes/banco.php";
    require_once "includes/funcoes.php";
    require_once "includes/login.php";
?>
<html lang="pt-br">
    <head>
        <title>Logout</title>
        <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="estilos/estilo.css"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <main>
            <?php
                logout();
                echo msg_sucesso("Usuário desconectado com sucesso");
                echo voltar();
            ?>
        </main>
    </body>
</html>