<?php
	session_start();
?>
<html>
	<head>
		<title>Gestor de Archivos</title>
	</head>
	<body>
		<?php
			calcularRuta();
		?>
		<table align=left border=1 cellpadding="1">
			<tr>
				<td>
					<?php
				 		echo $_SESSION['ruta'];
					?>
				</td>
				<td>
					<p> Botones </p>
				</td>
			</tr>
			<tr>
				<td>
					<?php
					ls();
					?>
				</td>
				<td>
					<p>Crear Carpeta</p>
					<form action="crud.php" method="post">
						<input type="text" name="nombre" size="50">
    				<input type="submit" name="createD" value="Crear Carpeta">
					</form>
					<p>Crear archivo</p>
					<form action="crud.php" method="post">
						<input type="text" name="nombre" size="50">
    				<input type="submit" name="createA" value="Crear archivo">
					</form>
				</td>
			</tr>
	</body>
</html>

<?php
	CRUD();
	function calcularRuta(){
		if (!isset($_SESSION['ruta']) || !$_GET){
	  	$_SESSION['ruta'] = exec('pwd');
			$_SESSION['raiz'] = dirname((string)$_SESSION['ruta']);
		}else{
			$dir = $_GET["dir"];
			if($dir == "..."){
				if($nruta != $_SESSION['raiz']){
					$nruta = dirname((string)$_SESSION['ruta']);
				}else{
					$nruta = $_SESSION['ruta'];
				}
			}else{
				$nruta = (string)$_SESSION['ruta'] ."/". $dir;
				if(!is_dir($nruta)){
					$nruta = $_SESSION['ruta'];
				}
			}
			$_SESSION['ruta'] = $nruta;
			if($_SESSION['ruta'] == $_SESSION['raiz']){
		  	$_SESSION['ruta'] = exec('pwd');
			}
		}
	}

	function ls(){
		$nruta = dirname((string)$_SESSION['ruta']);
		if($_SESSION['raiz'] != $nruta){
			echo "<br><a href='test.php?dir=...'>...</a>\n";
		}
		$ruta = (string)$_SESSION['ruta'];
		exec("ls $ruta -F | grep \/$",$directorios);
		foreach($directorios as $dir){
			echo "<br><a href='test.php?dir=$dir'>$dir</a>\n";
		}
		exec("ls $ruta -p | grep -v /",$archivos);
		foreach($archivos as $arch){
			echo "<br>".$arch;
		}

	}
?>
