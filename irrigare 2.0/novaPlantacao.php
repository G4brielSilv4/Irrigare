<?php
require_once('php_bdConection.php');
session_start();

if ($_SESSION['usuarioIdntf'] == false) {
  echo "<script>alert('Você deve efetuar login')</script>";
  echo "<script>window.location.href='index.php'</script>";
}

$usu = $_SESSION['codUsuario'];

if (isset($_SESSION['placeName'])) {
  $placeNome = $_SESSION['placeName'];
} else {
  $placeNome = "Ex: Alface roxo";
}

if (isset($_SESSION['placeDesc'])) {
  $placeDesc = $_SESSION['placeDesc'];
} else {
  $placeDesc = "Ex: Saudavel e levemente crocante";
}

if (isset($_SESSION['placeTemp'])) {
  $placeTemp = $_SESSION['placeTemp'];
} else {
  $placeTemp = "Ex: 29";
}

if (isset($_SESSION['placeUmi'])) {
  $placeUmi = $_SESSION['placeUmi'];
} else {
  $placeUmi = "Ex: 65";
}

#---/---/---/---/---/---/---/---/---/---/---/---/---/---/---/---/---/---/---/---/

$sql = $mysqli->query("SELECT nome FROM cultura");
$linhas = mysqli_num_rows($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

  <?php include("head.html"); ?>
  <link rel="stylesheet" type="text/css" href="CSS/cultura.css">
</head>

<body>

  <?php include("navbar.html"); ?>

  <style>
        .row-titulo {
            margin-top: 20px;
            font-size: 18pt;
        }
    </style>


  <br><br>
  
  <div class="container">
        <div class="row row-titulo">
            <div class="col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php" style="color: dimgray;">Home</a></li>
                    <li class="breadcrumb-item active">Cadastro de cultura</li>
                </ol>

                <hr>
            </div>
        </div>
    </div>
  
  <br><br>
  <div class="container">
    <div class="col-sm-3"></div>

    <div class="col-sm-6">

      <form method="post" action="php_cadastroCult.php" id="corpo">

        <div class="form-group">
          <label style="font-size: 20px;">Nome da cultura</label>
          <input type="text" name="nome" class="form-control" placeholder="<?php echo $placeNome; ?>">

        </div>

        <div class="form-group">
          <label style="font-size: 20px;">Descrição</label>
          <input type="text" name="descricao" class="form-control" placeholder="<?php echo $placeDesc; ?>">
        </div>

        <div class="form-group">
          <label style="font-size: 20px;">Temperatura ideal (°C)</label>
          <input type="float" name="temp_ideal" class="form-control" placeholder="<?php echo $placeTemp; ?>">
        </div>

        <div class="form-group">
          <label style="font-size: 20px;">Umidade ideal (%)</label>
          <input type="float" name="umi_ideal" class="form-control" placeholder="<?php echo $placeUmi; ?>"></br>
        </div>

        <input type="submit" id="submit" value="Cadastrar">

      </form>


    </div>
  </div>
  <div class="col-sm-3"></div>
  <br><br><br><br><br>

  <footer>
    <?php include("footer.html"); ?>
  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>