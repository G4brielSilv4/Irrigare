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

      <div class="col-sm-12 col-md-5" align="center">

        <form method="post" action="php_cadastroCult.php">

          <div class="form-group">
            <label>Nome: </label>
            <input type="text" name="nome" class="form-control" placeholder="ex: alface">
          </div>

          <div class="form-group">
            <label>Descrição: </label>
            <input type="text" name="descricao" class="form-control" placeholder="ex: folhas verdes e grandes">
          </div>

          <div class="form-group">
            <label>Temperatura ideal (°C): </label>
            <input type="float" name="temp_ideal" class="form-control" placeholder="ex: 27">
          </div>

          <div>
            <label>Umidade ideal(%): </label>
            <input type="float" name="umi_ideal" class="form-control" placeholder="60"></br>
          </div>

          <button type="submit" class="btn btn-success" id="submit">Cadastrar</button>

        </form>

      </div>

      <div class="col-sm-12 col-md-2"></div>

      <div class="col-sm-12 col-md-5" align="center">

        <form>
          <div class="form-group">
            <label>temperatura ideal (°C)</label>
            <input type="text" class="form-control" name="tempIdealInput" placeholder="ex: 27">
          </div>

          <div class="form-group">
            <label>umidade ideal (%)</label>
            <input type="text" class="form-control" name="umiIdealInput" placeholder="ex: 80">
          </div>

          <button type="submit" class="btn btn-success">Alterar</button>
        </form>

      </div>

    </div>
<script>
  function mudaValor(temp, umi ) {
  firebase.database().ref('users/' + userId).set({
    username: name,
    email: email,
    profile_picture : imageUrl
  });
}
</script>
    <br><br><br><br><br><br><br><br><br><br>

    <footer>
      <?php include("footer.html"); ?>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>

</html>