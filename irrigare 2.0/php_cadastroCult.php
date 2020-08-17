<?php
require_once('php_bdConection.php');
session_start();

$erro = 0;

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$temp_ideal = $_POST['temp_ideal'];
$umi_ideal = $_POST['umi_ideal'];

if (empty($nome)) {
    $_SESSION['placeName'] = "O campo Nome é obrigatorio!";
    $erro =1;
} if (strlen($nome) > 50) {
    $_SESSION['placeName']="O nome da cultura não pode exceder 50 caracteres!";
    $erro =1;
} if (strlen($descricao) > 200) {
    $_SESSION['placeDesc'] = "A descrição não pode exceder 200 caracteres!";
    $erro =1;
} if (empty($temp_ideal)) {
    $_SESSION['placeTemp'] = "O campo Temperatura ideal é obrigatorio!";
    $erro =1;
} if (!is_numeric($temp_ideal)) {
    $_SESSION['placeTemp'] = "A temperatura ideal da cultura precisa ser um número!";
    $erro =1;
} if ($temp_ideal < 0) {
    $_SESSION['placeTemp'] = "A temperatura ideal da cultura não pode ser um valor negativo!";
    $erro =1;
} if ($temp_ideal > 100) {
    $_SESSION['placeTemp'] = "A temperatura ideal da cultura não pode exceder 100°C!";
    $erro =1;
} if (empty($umi_ideal)) {
    $_SESSION['placeUmi'] = "O campo Umidade ideal é obrigatorio";
    $erro =1;
} if (!is_numeric($umi_ideal)) {
    $_SESSION['placeUmi'] = "A umidade ideal da cultura precisa ser um número!";
    $erro =1;
} if ($umi_ideal > 100) {
    $_SESSION['placeUmi'] = "A umidade ideal da cultura não pode exceder 100%!";
    $erro =1;
} if ($umi_ideal < 10) {
    $_SESSION['placeUmi'] = "A umidade ideal da cultura não pode ser menor que 10%!";
    $erro =1;
} if($erro==0){

    //A linha da tabela que esse set esta alterando é a da cod = 9 e a linha usada pelo Arduino é a cod = 8

    $sql = "UPDATE cultura SET nome ='$nome',descricao='$descricao',umi_ideal='$umi_ideal',temp_ideal='$temp_ideal' WHERE cod=9";
    $query = $mysqli->query($sql) or die($mysqli->error);

    if (!$query) {
        echo "<script>alert('erro!')</script>";
        header("Location: home.php");
    } else {
        echo "tope";
        header("Location: home.php");
    }

}else{
    header("Location: novaPlantacao.php");
}