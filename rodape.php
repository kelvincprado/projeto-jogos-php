<?php
	echo "<footer>";
	echo "<p>Acessado por ". $_SERVER['REMOTE_ADDR'] ." em ".date('d/m/Y') ." </p>";
	echo "<p>Desenvolvido por Kelvin Prado &copy; 2020</p>";
	echo "</footer>";
	$banco->close();
?>