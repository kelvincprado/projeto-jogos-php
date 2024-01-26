<?php
    session_start();

    if(!isset($_SESSION['user'])){
        $_SESSION['user'] = '';
        $_SESSION['nome'] = '';
        $_SESSION['tipo'] = '';
    }

    function cripto($senha){
        $c = '';
        for($pos = 0; $pos < strlen($senha); $pos++){
            $letra = ord($senha[$pos]) + 1;
            $c .= chr($letra);
        }
        return $c;
    }

    function gerarHash($senha){
        $txt = cripto($senha);
        $hash = password_hash($txt, PASSWORD_DEFAULT);
        return $hash;
    }

    function testarHash($senha, $hash){
        $ok = password_verify(cripto($senha), $hash);
        return $ok;
    }

    function logout(){
        session_destroy();
    }

    function is_logado(){
        if(empty($_SESSION['user'])){
            return false;
        }else{
            return true;
        }
    }

    function is_admin(){
        if(!isset($_SESSION['tipo'])){
            return false;
        }else{
            if(($_SESSION['tipo']) == 'admin'){
                return true;
            }else{
                return false;
            }
        }
    }

    function is_editor(){
        if(!isset($_SESSION['tipo'])){
            return false;
        }else{
            if(($_SESSION['tipo']) == 'editor'){
                return true;
            }else{
                return false;
            }
        }
    }
?>