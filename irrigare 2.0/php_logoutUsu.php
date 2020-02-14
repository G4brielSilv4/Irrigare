<?php
	session_start();
	$_SESSION['usuarioIdntf'] = false;
	$_SESSION['erroLogin']=" ";
	

    		unset($_SESSION['codUsuario']);
    		unset($_SESSION['nomeUsuario']);
    		unset($_SESSION['emailUsuario']);
    		unset($_SESSION['senhaUsuario']);


	if($_SESSION['usuarioIdntf'] == false)
	{
		header("Location: index.php");
	}
?>