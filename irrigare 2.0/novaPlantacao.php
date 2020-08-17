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

</head>

<body>

  <?php include("navbar.html"); ?>

  <header>
    <h1>Cadastro cultura</h1>
  </header>

  <body>

    <br><br><br><br>
    <div class="container">
      <div>
        <form>
          <div class="form-row align-items-center">
            <div class="col-auto my-1">
              <select class="custom-select mr-sm-4" id="inlineFormCustomSelect">
                <option selected>Escolher...</option>
                <option value="1">Um</option>
                <option value="2">Dois</option>
                <option value="3">Três</option>
              </select>
            </div>
            <div class="col-auto my-1">
              <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
          </div>
        </form>
      </div>

      <div class="col-sm-12 col-md-5" align="center">

        <form method="post" action="php_cadastroCult.php">

          <div class="form-group">
            <label>Nome: </label>
            <input type="text" name="nome" class="form-control" placeholder="<?php echo $placeNome; ?>">
          </div>

          <div class="form-group">
            <label>Descrição: </label>
            <input type="text" name="descricao" class="form-control" placeholder="<?php echo $placeDesc; ?>">
          </div>

          <div class="form-group">
            <label>Temperatura ideal (°C): </label>
            <input type="float" name="temp_ideal" class="form-control" placeholder="<?php echo $placeTemp; ?>">
          </div>

          <div>
            <label>Umidade ideal(%): </label>
            <input type="float" name="umi_ideal" class="form-control" placeholder="<?php echo $placeUmi; ?>"></br>
          </div>

          <button type="submit" class="btn btn-success" id="submit">Cadastrar</button>

        </form>

      </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br>

    <footer>
      <?php include("footer.html"); ?>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>

</html>