<?php
require_once('php_bdConection.php');
session_start();

if ($_SESSION['usuarioIdntf'] == false) {
        echo "<script>alert('Você deve efetuar login')</script>";
        echo "<script>window.location.href='index.php'</script>";
}

$resultUsu = "SELECT * FROM usuario WHERE cod = '".$_SESSION['codUsuario']."'";
$resultadoUsu = mysqli_query($mysqli, $resultUsu);
$linhaUsu = mysqli_fetch_assoc($resultadoUsu);
?>

<!DOCTYPE html> 
<html lang="pt-br">
<head>

    <?php include("head.html");?>

</head>

<body>
    
    <?php include("navbar.html");?>
    
    <div class="container-fluid">

        <h1>Perfil </h1>
        <div class="col-sm-12">
            <div class="col-sm-12 col-md-3">
            </div>    
                <div class="col-sm-12 col-md-6" align="center">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="tabelaUsuario">

                            <tr><th colspan="2" style="text-align: center; font-size: 20pt;"  class="col-sm-12 col-md-12">Informações da conta</th></tr>

                            <tr>
                                <td style="text-align:center; font-size: 14pt; font-weight: bold; word-break:break-word;" class="col-sm-12 col-md-4">Nome de usuario</td>
                                <td class="col-sm-12 col-md-8" style="word-break:break-word;"><?php  echo $linhaUsu['nome'];?></td>
                            </tr>      


                            <tr>
                                <td style="text-align:center; font-size: 14pt; font-weight: bold; word-break: break-word;"class="col-sm-4">Email cadastrado</td>
                                <td class="col-sm-8" style="word-break:break-word;"><?php  echo $linhaUsu['login'];?></td>
                            </tr>


                            <tr>
                                <td style="text-align:center; font-size: 14pt; font-weight: bold; word-break: break-word;"class="col-sm-4">Senha</td>
                                <td class="col-sm-8" style="word-break:break-word;"><?php  echo $linhaUsu['senha'];?></td>
                            </tr>                     

                    </table>
                </div>  
        </div>    
        <div class="col-sm-12" align="center">

            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalEditar">Editar perfil</button>
                <!--Começo do modal-->
                  <div class="modal fade" id="modalEditar" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-md">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" style="font-weight: bold; ">Editar perfil</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body" align="left">


                          <form method="POST" action="php_editarUsuario.php">
                            <input id="codUsu" type="hidden" name="codUsu" value="<?php echo $linhaUsu['cod']; ?>">
                              <div class="col-sm-5" style="font-weight: bold;" align="center">
                                  
                                  <div style="margin-top: 3px; margin-bottom:3px;">Nome: </div>
                                  <div style="margin-top: 9px;">Email: </div>
                                  <div style="margin-top: 9px;">Senha: </div>
                                  <div style="margin-top: 9px;">Confirmação senha: </div>
                              
                              </div>    
                                          
                              <div class="col-sm-7" align="center">
                                <input type="text" name="nomeEdit" placeholder="Digite seu novo nome" style="margin-bottom: 3px;" width="120%" value="<?php echo $linhaUsu['nome'];?>">
                                <input type="email" name="emailEdit" placeholder="Digite seu novo email" style="margin-bottom: 3px;" value="<?php echo $linhaUsu['login'];?>">  
                                <input type="text" name="senhaEdit" placeholder="Digite seu nova senha" style="margin-bottom: 3px;" value="<?php echo $linhaUsu['senha'];?>">
                                <input type="text" name="confirmSenhaEdit" placeholder="Confirme sua nova senha" style="margin-bottom: 3px;" value="<?php echo $linhaUsu['senha']?>">
                              </div>
                                 
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-info">Editar</button>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
            <!--Fim do modal-->         


                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalExcluir">Excluir conta</button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="ModalExcluir" role="dialog">
                <div class="modal-dialog">

                <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Confirmar exclusão</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Essa ação é irreversível!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <a class="btn btn-danger" href="php_deletaUsuario.php" role="button">Excluir</a>
                        </div>
                    </div>
                </div>
            </div>
    </div> 

    <div>
        <br><br><br><br><br><br><br><br><br><br><br>
    </div>

    <footer>
        <?php include("footer.html");?>
    </footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>