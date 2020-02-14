<?php

session_start();

require_once('php_bdConection.php');


    $cod = $_SESSION['codUsuario']; 
    $nome = $_POST['nomeEdit'];
    $email = $_POST['emailEdit'];
    $senha = $_POST['senhaEdit'];
    $confirmSenha = $_POST['confirmSenhaEdit'];
        
    $resultUsu = "SELECT * FROM usuario WHERE login = '".$email."'";
    $resultadoUsu = mysqli_query($mysqli, $resultUsu);
    $linhaUsu = mysqli_num_rows($resultadoUsu);
    $dadosUsu = mysqli_fetch_assoc($resultadoUsu);
    

    if($senha==$confirmSenha){
    if ($linhaUsu > 0) {
        if ($dadosUsu['cod'] == $cod) {
           
            $sql = "UPDATE usuario set nome = '$nome', senha='$senha', login='$email' WHERE cod = '$cod'";
            $query = $mysqli->query($sql)or die($mysqli->error);

            if(!$query){
                echo "<script>alert('erro!')</script>";

            }
                else{
                    echo "<script>alert('Cadastro atualizado!')</script>";
                    echo "<script>window.location.href='perfilUsuario.php'</script>";
                }     
        
        }else {
            echo "<script>alert('Email já cadastrado!')</script>";
            echo "<script>window.location.href='perfilUsuario.php'</script>";
        }
    }else{                
        $sql = "UPDATE usuario set nome = '$nome', senha='$senha', login='$email' WHERE cod = '$cod'";
        $query = $mysqli->query($sql)or die($mysqli->error);

        if(!$query){
                echo "<script>alert('erro!')</script>";

        }
            else{
                echo "<script>alert('Cadastro atualizado!')</script>";
                echo "<script>window.location.href='home.php'</script>";
            }

    }
}else{
    echo "<script>alert('As senhas não coincidem!')</script>";
    echo "<script>window.location.href='perfilUsuario.php'</script>"; 
}


?>