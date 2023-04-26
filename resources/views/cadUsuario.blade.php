<?php 
// CONEXÃO COM O BANCO
include_once('../../public/config.php');

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
  extract($_REQUEST);
  /*
  if($NomeSerie==""){
    // mensagem de campo obrigatorio
    header('location:'.$_SERVER['PHP_SELF'].'?msg=robr');
    exit;
  }else{
    // se pá pode apagar, não testei sem
    $userCount	=	$db->getQueryCount('serie','idSerie');
    // colunas da tabela
    $data	=	array(
      'NomeSerie'=> $NomeSerie, //colunas                        
    );
    $insert	=	$db->insert('serie',$data);
    if($insert){
      // mensagem add com sucesso
      header('location: read/serie.blade.php?msg=radd');
      exit;
    }else{
      // mensagem erro
      header('location: read/serie.blade.php?msg=rerr');
      exit;
    }
  }*/
}
?>

<!doctype html>
<html lang="pt-br">
  
  <?php include_once('head.blade.php'); ?>

  <body>
  
    <?php include_once('header.blade.php'); ?>

    <div class="container-fluid">
      <div class="tab-content">

        <main  class="container tab-pane active" role="main"><br>
            <div class="mx-auto" style="width: 600px;">
          <div class="card border-light  align-content-center">
            <h4 class="card-header">CADASTRAR NOVO USUÁRIO 
              <a class="btn btn-primary my-2 my-sm-0 btn-sm pull-right" href="login.blade.php" role="button">Já tenho cadastro</a>
            </h4>
            <div class="card-body">

              <!-- mensagens de alerta, ex: adicionado com sucesso, deletado com sucesso, etc -->
              <?php include_once('../../public/alertMsg.php');?>
              
              <div class="card-title">Preencha corretamente o formulário abaixo:</div>
              <form method="POST">
                <div class="row">
                  <div class="form-group col-sm-12">
                    <label for="Cpf">Insira seu CPF</label>
                    <input type="text" maxlength="11" pattern="[0-9]{11}" placeholder="Somente números" title="Insira somente números (11 dígitos), sem pontos, traços ou espaços."
                    class="form-control" name="Cpf" required autofocus>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-12">
                    <label for="Login">Login</label>
                    <input type="text" maxlength="25" class="form-control" name="Login" placeholder="Insira seu Login"required autofocus>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-12">
                    <label for="Senha">Senha</label>
                    <input type="password" minlength="6"maxlength="15" onclick="mostraCampo()" class="form-control" name="Senha" placeholder="Insira sua senha"required autofocus>
                  </div>
                </div>
                <div class="row d-none" id="confirmasenha">
                  <div class="form-group col-sm-12">
                    <label class="text-danger" for="ConfirmaSenha">Insira novamente sua senha*</label>
                    <input type="password" minlength="6"maxlength="15" class="form-control" name="ConfirmaSenha" placeholder="Insira sua senha novamente"required autofocus>
                  </div>
                </div>                  

                <div class="row">
                  <div class="col-md-4">
                    <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">Enviar</button>
                    <button type="reset" name="reset" value="reset" id="reset" class="btn">Limpar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script>
      function mostraCampo() {
        document.getElementById("confirmasenha").setAttribute("class", "row"); 
      }
      </script>
  </body>
</html>