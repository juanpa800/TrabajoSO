<?php
  session_start();
  if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['create'])){
    $nombre = $_POST["nombre"];
    $nruta =  $_SESSION['ruta']."/".$nombre;
    mkdir($nruta,0777);
    header('Location: test.php');
  }
?>
