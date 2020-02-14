<?php 
require_once('php_bdConection.php');
session_start();

if ($_SESSION['usuarioIdntf'] == false) {
        echo "<script>alert('Você deve efetuar login')</script>";
        echo "<script>window.location.href='index.php'</script>";
}

$usu = $_SESSION['codUsuario'];

#---/---/---/---/---/---/---/---/---/---/---/---/---/---/---/---/---/---/---/---/


$sql = $mysqli->query("SELECT nome FROM cultura");
$linhas = mysqli_num_rows($sql);


#---/---/---/---/---/---/---/---/---/---/---/---/---/---/---/---/---/---/---/---/


$consulta =  "SELECT * FROM cultura";	
$con = $mysqli->query($consulta) or die($mysqli->error);
	
	while($dados = $con->fetch_array()){
		$vetor1 = [$dados['nome'],$dados['descricao'],$dados['temp_ideal'],$dados['umi_ideal']];

	}
	var_dump($vetor1); 
?>



<!DOCTYPE html> 
<html lang="pt-br">
<head>

    <?php include("head.html");?>

</head>

<body>
    
    <?php include("navbar.html");?>
	
	<header>
  		<h1>Cadastro cultura</h1>
	</header>

<body>


	<br><br><br><br>
	<div class="btn-group">
  <button type="button" class="btn btn-primary">Sony</button>
  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
    <span class="caret"></span>
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">Tablet</a>
    <a class="dropdown-item" href="#">Smartphone</a>
  </div>
</div>
	<form method="post" action="php_cadastroCult.php">


	<label>Nome: </label><input type="text" name="nome" placeholder="ex: alface"><br>
	<label>Descrição: </label><input type="text" name="descricao" placeholder="ex: folhas verdes e grandes"><br>
	<label>Temperatura ideal (°C): </label><input type="float" name="temp_ideal" placeholder="ex: 27"><br>
	<label>Umidade ideal(%): </label><input type="float" name="umi_ideal" placeholder="60"><br>

	<input type="submit" name="submit" value="Cadastrar">	

	</form>

<br><br><br><br><br><br><br><br><br><br><br><br><br>
    <footer>
        <?php include("footer.html");?>
    </footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>