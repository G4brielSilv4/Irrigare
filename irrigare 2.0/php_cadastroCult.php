<?php
require_once('php_bdConection.php');
session_start();

$nome = $_POST['nome']; 
$descricao = $_POST['descricao'];
$temp_ideal = $_POST['temp_ideal'];
$umi_ideal = $_POST['umi_ideal'];
$codUsuario = $_SESSION['codUsuario'];


if (empty($nome)) {
    echo "<script>alert('A cultura precisa de um nome!')</script>";
    echo "<script>window.location.href='formularioCult.php'</script>";
}elseif (strlen($nome)>50) {
    echo "<script>alert('O nome da cultura não deve exceder 50 caracteres!')</script>";
    echo "<script>window.location.href='formularioCult.php'</script>";
}


if (strlen($descricao)>200) {
    echo "<script>alert('A descrição não pode exceder 200 caracteres!')</script>";
    echo "<script>window.location.href='formularioCult.php'</script>";
}


if (empty($temp_ideal)) {
    echo "<script>alert('O campo Temperatura ideal é obrigatório')</script>";
    echo "<script>window.location.href='formularioCult.php'</script>";
}elseif (!is_numeric($temp_ideal)) {
    echo "<script>alert('Formato de temperatura inválido')</script>";
    echo "<script>window.location.href='formularioCult.php'</script>";
}elseif ($temp_ideal<0) {
    echo "<script>alert('A temperatura informada é muito baixa')</script>";
    echo "<script>window.location.href='formularioCult.php'</script>";
}elseif ($temp_ideal>100) {
    echo "<script>alert('A temperatura informada é muito alta')</script>";
    echo "<script>window.location.href='formularioCult.php'</script>";
}


if (empty($umi_ideal)) {
    echo "<script>alert('O campo Umidade ideal é obrigatorio')</script>";
    echo "<script>window.location.href='formularioCult.php'</script>";
}elseif (!is_numeric($umi_ideal)) {
    echo "<script>alert('Formato de umidade inválido')</script>";
    echo "<script>window.location.href='formularioCult.php'</script>";
}elseif ($umi_ideal>100) {
    echo "<script>alert('A umidade não pode ser maior que 100%')</script>";
    echo "<script>window.location.href='formularioCult.php'</script>";
}elseif ($umi_ideal<10) {
    echo "<script>alert('A umidade não pode ser menor que 10%')</script>";
    echo "<script>window.location.href='formularioCult.php'</script>";
}

   

    $sql = "insert into cultura(nome, descricao, temp_ideal, umi_ideal, usuario) values ('$nome','$descricao','$temp_ideal','$umi_ideal','$codUsuario')";
    $query = $mysqli->query($sql)or die($mysqli->error);;

    if(!$query){
        echo "<script>alert('erro!')</script>";
        header("Location: home.php");
    }else{
        echo "<script>alert('Cultura cadastrada com sucesso!')</script>";
        header("Location: home.php");
    }


?>