<?php
 session_start();
 require_once('php_bdConection.php');

if(isset($_POST['login'])){
	$email = $_POST['email'];
	$senha = $_POST['senha'];


$_SESSION['usuarioIdntf'] = false;
$_SESSION['erroLogin']="";


$sql = $mysqli->query("SELECT * FROM usuario where login = '{$email}' and senha = '{$senha}'");
$linhas = mysqli_num_rows($sql);


	if($linhas > 0){ 

		  $_SESSION['emailUsuario']=$email;
		  
  		$_SESSION['usuarioIdntf'] = true;
  		header("Location: home.php");

	}else{
  		$_SESSION['erroLogin']="Login ou senha incorretos!";
  		$_SESSION['usuarioIdntf']= false;
  		header("Location: index.php");
	}

}
?>