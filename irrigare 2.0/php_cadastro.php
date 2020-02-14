<?php

require_once('php_bdConection.php');#Arquivo que contém a conexao com o banco de dados sql

session_start();


$email = $_POST['login']; 
$senha = $_POST['senha'];
$usuario = $_POST['usuario'];


# Nesta etapa o cadastro do usuario é validado, é verificado se todos os campos estao preenchidos, as senhas são iguais e etc, caso o cadastro passe pela valisdação a variavel erro continuará com valor 0 e cadastro será efetuado ,a variavel é apenas uma garantia, caso não passe pela validação será exibida a mensagem de erro equivalente e o usuario sera redirecionado a pagina de cadastro.

$erro = 0;
  
    if (empty($_POST["usuario"])) {  
        echo "<script>alert('Todos os campos devem ser prenchidos!')</script>";
        echo "<script>window.location.href='cadastrarUsuario.php'</script>";
        $erro = 1;
    } 
    elseif (strlen($_POST["usuario"])>50) {
        echo "<script>alert('O nome de usuario não pode exceder 50 caracteres!')</script>";
        echo "<script>window.location.href='cadastrarUsuario.php'</script>";
            $erro=1;
        }
    
               
   
    if (empty($_POST["login"])) {
        echo "<script>alert('Todos os campos devem ser prenchidos')</script>";
        echo "<script>window.location.href='cadastrarUsuario.php'</script>";            
        $erro=1;
    }
    elseif (!filter_var($_POST["login"], FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Formato de email inválido!')</script>";
        echo "<script>window.location.href='cadastrarUsuario.php'</script>";
        $erro=1;
        }
    
        
    $testaEmail = $mysqli->query("SELECT COUNT(*) FROM usuario where login= '{$email}'");
    $linha = $testaEmail->fetch_row(); 

    if ($linha[0] > 0) {
        echo "<script>alert('Este email já esta sendo usado!')</script>";
        echo "<script>window.location.href='cadastrarUsuario.php'</script>";           
        $erro=1; 
    }



    if (empty($_POST["senha"])) {
        echo "<script>alert('Todos os campos devem ser prenchidos')</script>";
        echo "<script>window.location.href='cadastrarUsuario.php'</script>";          
        $erro=1;
    }

    if (empty($_POST['senhaConfirm'])) {
       echo "<script>alert('Todos os campos devem ser prenchidos')</script>";
        echo "<script>window.location.href='cadastrarUsuario.php'</script>";           
        $erro=1;
    }

    if ((!empty($_POST['senha']))and(!empty($_POST['senhaConfirm']))) {
        if(($_POST["senha"])!=($_POST["senhaConfirm"])){
           echo "<script>alert('As senhas informadas não são iguais!')</script>";
        echo "<script>window.location.href='cadastrarUsuario.php'</script>";
            $erro=1;
        } 
    } 
    

if ($erro==0) {
   #Aqui é realizado o cadastro

        $sql = "insert into usuario(nome, senha, login) values ('$usuario','$senha','$email')";
        $query = $mysqli->query($sql)or die($mysqli->error);;

        if(!$query){
            echo "<script>alert('erro!')</script>";
            header("Location: index.php");
        }else{
            $_SESSION["nomeEr"] = $_SESSION["loginEr"] = $_SESSION["senhaEr"] = " ";
            header("Location: index.php");
        }

}
?>