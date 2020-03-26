<?php
session_start();
 
if ($_SESSION['usuarioIdntf'] == false) {
        echo "<script>alert('Você deve efetuar login')</script>";
        echo "<script>window.location.href='index.php'</script>";
}

require_once('php_bdConection.php');

$email = $_SESSION['emailUsuario'];

	$consulta =  "SELECT * FROM usuario where login = '{$email}'";	
	$con = $mysqli->query($consulta) or die($mysqli->error);
		
		
		while($dados = $con->fetch_array()){

    		$_SESSION['codUsuario'] = $dados['cod'];
    		$_SESSION['nomeUsuario'] = $dados['nome'];
    		$_SESSION['emailUsuario'] = $dados['login'];
    		$_SESSION['senhaUsuario'] = $dados['senha'];
    		
        }

    $codUsu = $_SESSION['codUsuario'];

    $cultura = "SELECT * FROM cultura WHERE usuario = '{$codUsu}'";  
    $conn = $mysqli->query($cultura) or die($mysqli->error); 

        while ($dadosCult = $conn->fetch_array()) {
            $_SESSION['codCult'] = $dadosCult['cod'];
    		$_SESSION['nomeCult'] = $dadosCult['nome'];
    		$_SESSION['usuarioCult'] = $dadosCult['usuario'];
            $_SESSION['descricaoCult'] = $dadosCult['descricao'];
            $_SESSION['temp_idealCult'] = $dadosCult['temp_ideal'];
            $_SESSION['umi_idealCult'] = $dadosCult['umi_ideal'];
        }
?>

<!DOCTYPE html> 
<html lang="pt-br">
<head>
<!--
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

-->

<?php include("head.html");?>
    
</head>
<body>

<?php include("navbar.html");?>    





<div class="container-fluid">
    <div class="col-sm-12">
        <h4 style="font-size: 20pt;">Olá <?php echo $_SESSION['nomeUsuario'];?>! Confira aqui as informações de sua estufa:</h4>

        <br><br><br><br><br><br><br>

    </div>
</div>




    <div class="container-fluid">	

        <div class="col-sm-12 col-md-6" align="center">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                                                    
                        
                    <tr><th style="text-align:center;" class="align-middle">Cultura em uso</th></tr>
                    <tr><td style="text-align:center;"><?php echo $_SESSION['nomeCult']?></td></tr>

                    <tr><th style="text-align:center;">Última irrigacao efetuada</th></tr>
                    <tr><td style="text-align:center;"> 10:34 - 11/11/11</td></tr>

                    <tr><th style="text-align:center;">Última ventilação efetuada</th></tr>
                    <tr><td style="text-align:center;"> 10:34 - 11/11/11</td></tr>  

                    <tr><th style="text-align:center;">Último aquecimento realizado</th></tr>
                    <tr><td style="text-align:center;"> 10:34 - 11/11/11</td></tr> 

                    <tr><th style="text-align:center;">Acão em execução</th></tr>
                    <tr><td style="text-align:center;"> Irrigação</td></tr>                        
            
            </table>
        </div>

        <div class="col-sm-12 col-md-6" align="center" style=" font-size: 20pt; margin-top: 20px;">
            <p>Umidade do solo (%)<br></p>

            <h1><span id="valorUmidadeSolo"></span></h1>

        </div>

        <div class="col-sm-12 col-md-6" align="center" style="font-size: 20pt; margin-top: 20px;">
            <p>Temperatura do ambiente (°C)</p>
            <h1><span id="valorTemperaturaAr"></span></h1>
        </div>

        <div class="col-sm-12 col-md-6" align="center" style="font-size: 20pt; margin-top: 20px;">
            <p>Umidade do ar (%)</p>
            <h1><span id="valorUmidadeAr"></span></h1>
        </div>

    </div>
    <div>
        <br><br><br><br><br><br><br><br>
    </div>			
 
<footer>
    <?php include("footer.html");?>
</footer>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<!--------------//--------------//--------------//------- Scripts JavaScript do Firebase -------//---------------//---------------//-------------->

<script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-database.js"></script>
<script src="firebase.js"></script>

</body>
</html>
