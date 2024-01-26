<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Listagem de Jogos</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" href="estilos/estilo.css"/>	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
	<?php
		require_once "includes/banco.php";
		require_once "includes/funcoes.php";
		require_once "includes/login.php";

		if(isset($_GET['o'])){
			$ordem = $_GET['o'];
		}else{
			$ordem = 'n';
		}
		
		if(isset($_GET['c'])){
			$chave = $_GET['c'];
		}else{
			$chave = "";
		}		
	?>
	<main>
		<?php
			include_once "topo.php";
		?>
		<h1>Escolha seu jogo</h1>
		<form method="get" id="busca" action="index.php">
			Ordenar: 
			<a href="index.php?o=n&c=<?php echo $chave; ?>">Nome</a> | 
			<a href="index.php?o=p&c=<?php echo $chave; ?>">Produtora</a> | 
			<a href="index.php?o=n1&c=<?php echo $chave; ?>">Nota Alta</a> | 
			<a href="index.php?o=n2&c=<?php echo $chave; ?>">Nota Baixa</a> | 
			<a href="index.php">Mostrar Todos</a> |
			Buscar: <input type="text" name="c" size="10" maxlength="40"/>
			<input type="submit" value="Ok"/>
		</form>
		<table class="listagem">
			<?php
				$q = "select j.cod, j.nome, g.genero, p.produtora, j.capa, j.nota from jogos j join generos g on j.genero = g.cod join produtoras p on j.produtora = p.cod ";
				
				if (!empty($chave)){
					$q .= "where j.nome like '%$chave%' or p.produtora like '%$chave%' or g.genero like '%$chave%' ";
				}
				
				switch($ordem){
					case 'p':
						$q .= "order by p.produtora";
						break;
					case 'n1':
						$q .= "order by j.nota DESC";
						break;
					case 'n2':
						$q .= "order by j.nota ASC";
						break;
					default:
						$q .= "order by j.nome";
				}
				
				
				
				$busca = $banco->query($q);
				if(!$busca){
					echo "<tr><td>Infelizmente a busca deu um erro</p>";
				}else{
					if ($busca->num_rows == 0){
						echo "<tr><td>Nenhum registro encontrado";
					}else{
						while($reg = $busca->fetch_object()){
							$t = thumb($reg->capa);
							echo "<tr><td><img src='$t' class='mini'/>";
							echo "<td><a href='detalhes.php?cod=$reg->cod'>$reg->nome</a>";
							echo "[$reg->genero]";
							echo "</br>$reg->produtora";
							if(is_admin()){
								echo "<td><i class='material-icons'>add_circle</i> 
								<i class='material-icons'>edit</i>
								<i class='material-icons'>delete</i>";
							}else if(is_editor()){
								echo "<td><i class='material-icons'>edit</i>";
							}
						}
					}
				}
			
			?>
			
		</table>
	</main>
	<?php
		include_once "rodape.php";
	?>
</body>
</html>