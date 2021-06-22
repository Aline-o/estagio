<?php 
// CONEXÃO COM O BANCO
include_once('../../../public/config.php');

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
  extract($_REQUEST);
  if($NomeModalidadeEnsino==""){
    // mensagem de campo obrigatorio
    header('location:'.$_SERVER['PHP_SELF'].'?msg=robr');
    exit;
  }elseif($Sigla==""){
    header('location:'.$_SERVER['PHP_SELF'].'?msg=robr');
    exit;
  }else{
    // se pá pode apagar, não testei sem
    $userCount	=	$db->getQueryCount('modalidadeensino','idModalidadeEnsino');
    // colunas da tabela
    $data	=	array(
      'NomeModalidadeEnsino'=> $NomeModalidadeEnsino,
      'Sigla'=>$Sigla,
    );
    $insert	=	$db->insert('modalidadeensino',$data);
    if($insert){
      // mensagem add com sucesso
      header('location: ../read/modEnsino.blade.php?msg=radd');
      exit;
    }else{
      // mensagem erro
      header('location: ../read/modEnsino.blade.php?msg=rerr');
      exit;
    }
  }
}
?>

<!doctype html>
<html lang="pt-br">

  <?php include_once('../head.blade.php'); ?>

  <body>

    <?php include_once('../header.blade.php'); ?>

    <div class="container-fluid">
      <div class="row flex-xl-nowrap">
        
        <?php include_once('../sidebar/navModEnsino.blade.php'); ?>

        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-1 bd-content" role="main">
          <div class="card border-light">
            <h4 class="card-header">NOVO CADASTRO - Modalidade de ensino 
              <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/modEnsino.blade.php" role="button">Buscar</a>
            </h4>
            <div class="card-body">

              <!-- mensagens de alerta, ex: adicionado com sucesso, deletado com sucesso, etc -->
              <?php include_once('../../../public/alertMsg.php');?>
              
              <div class="card-title">Preencha corretamente o formulário abaixo:</div>
              <form method="POST">
                <div class="row">
                  <div class="form-group col-sm-6">
                    <label for="NomeModalidadeEnsino">Nome da Modalidade de ensino</label>
                    <input type="text" class="form-control" name="NomeModalidadeEnsino" placeholder="Insira o nome da Modalidade"required autofocus>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="Sigla">Sigla da Modalidade de ensino</label>
                    <input type="text" class="form-control" name="Sigla" placeholder="Insira a Sigla"required>
                  </div>
                </div>

                <div class="row">
                  <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">Enviar</button>
                </div>
              </form>
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
  </body>
</html>