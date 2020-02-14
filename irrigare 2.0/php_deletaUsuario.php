<?php

require_once('php_bdConection.php');
session_start();
       
    $cod = $_SESSION['codUsuario'];
    
    $sql = "DELETE FROM usuario WHERE cod = '$cod'";
    $query = $mysqli->query($sql)or die($mysqli->error);

    if(!$query){
        echo "<script>alert('erro!')</script>";
        echo "<script>window.location.href='telaInicial.php'</script>";

    }else{
        echo "<script>alert('Registro excluido com sucesso!')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }

?>