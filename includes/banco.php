<?php
						//host     usuario  senha  banco
	$banco = new mysqli("localhost", "root", "", "bd_games");
	if($banco->connect_errno){
		echo "<p>Encontrei um erro $banco->errno --> $banco->connect_errno</p>";
		die();
	}
	
	$banco->query("SET NAME 'utf-8'");
	$banco->query("SET character_set_connection=utf8");
	$banco->query("SET character_set_client=utf8");
	$banco->query("SET character_set_results=utf8");

?>