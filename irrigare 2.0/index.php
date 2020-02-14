<?php

session_start(); 

if (isset($_SESSION['erroLogin'])) {
	$loginErr = $_SESSION['erroLogin'];
 }else{
 	$loginErr = " ";
 }   
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

	<title>irrigare</title>

	<link href="CSS/boot/bootstrap-social.css" type="text/css" rel="stylesheet" >
	<link rel="stylesheet"  href="CSS/index.css">
	<link rel="shortcut icon" href="CSS/imagens/favicon.png">
	

</head>
<body>
	<br><br><br>
<div class="container" align="center" >

	<div class="col-sm-10 col-md-8" id="corpo-form">
		<div id="componentPainel">	
			<img src="CSS/imagens/logoFormularios4.png">
			<div id="coisaEscrita">
				<h2>Login</h2>
				<form method="post" action="php_login.php">
					<div class="email">
					<i class="fa fa-envelope fa-lg" id="iconEnvelope"></i>
					<input type="text" name="email" placeholder="Email">
				</div>
				<br>
				<div class="senha" id="campoSenha">
					<i class="fas fa-lock" id="iconCadeado"></i>
					<input type="password" name="senha" placeholder="Senha">
				</div>
				
				

				<div id="erroLogin">
					<?php if (isset($loginErr)) {
						echo $loginErr;	
						$_SESSION['erroLogin']= " ";
					}  
					?>
				</div>	
				<br>
				
				<input type="submit" name="login" value="Entrar">
					<br>
					<br>
					<!--<p>Não tem o seu cadastro? <a href="formularioUsu.php">Cadastre-se!</a> </p>-->
				</form>	
				<a href="cadastrarUsuario.php">	
					<button class="btn btn-default">Cadastrar-se</button>
				</a>
			</div>
		</div>	
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>