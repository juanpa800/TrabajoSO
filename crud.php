<?php
  session_start();
  if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['createD'])){
    $nombre = $_POST["nombre"];
    $nruta =  $_SESSION['ruta']."/".$nombre;
    mkdir($nruta,0777);
    header('Location: test.php');
  }else if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['createA'])){
    $nombre = $_POST["nombre"];
    $nruta =  $_SESSION['ruta']."/".$nombre;
    exec("touch $nruta");
    header('Location: test.php');
  }
?>
