<?php

session_start();

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
	<link rel="stylesheet"  href="CSS/cadastrarUsuario.css">
	<link rel="shortcut icon" href="CSS/imagens/favicon.png">

</head>

<body>
<div class="container"  align="center">
	<div id="corpo-form">
		<img src="CSS/imagens/logoFormularios4.png" alt="irrigare">
		<div id="coisasEscritas">
			<h2>Cadastre-se</h2>
			<form class="" method="post" action="php_cadastro.php">


					<i class="fas fa-user" id="iconNome"></i><input type="text" name="usuario" placeholder="Nome de usuario"> 
					
					

					<i class="fa fa-envelope fa-lg" id="iconLogin"></i><input type="text" name="login" placeholder="Email">

					
					


					<i class="fas fa-lock" id="iconSenha"></i><input type="password" name="senha" placeholder="Senha">
					

					

				
					<i class="fas fa-lock" id="iconSenha2"></i><input type="password" name="senhaConfirm" placeholder="Confirme  a senha">
				

				<br><br><br>
			
				<input type="submit" name="submit" value="Cadastrar">
			</form>
            <br>
                <a href="index.php">	
					<button class="btn btn-default">Já é cadastrado?</button>
				</a>

			
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>