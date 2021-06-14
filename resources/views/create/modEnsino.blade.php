<?php 
include_once('../../../public/config.php');

  if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
    extract($_REQUEST);
    if($NomeModalidadeEnsino==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); //msg campo obrigatorio
      exit;
    }elseif($Sigla==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); //msg campo obrigatorio
      exit;
    }else{
      $userCount	=	$db->getQueryCount('modalidadeensino','idModalidadeEnsino'); //users eh a tabela
      $data	=	array(
        'NomeModalidadeEnsino'=> $NomeModalidadeEnsino, //colunas 
        'Sigla'=>$Sigla,
      );
      $insert	=	$db->insert('modalidadeensino',$data);
      if($insert){
        header('location: ../read/modEnsino.blade.php?msg=radd'); //add com sucesso
        exit;
      }else{
        header('location: ../read/modEnsino.blade.php?msg=rerr'); // nao adicionado
        exit;
      }
    }
  }
?>
<?php 
include_once('../../../public/config.php');?>
<!doctype html>
<html lang="pt-br">
  <?php include_once('../header.blade.php'); ?>

  <body>
    <header class="navbar navbar-expand navbar-dark bg-primary flex-column flex-md-row bd-navbar justify-content-between">
      <a class="navbar-brand mr-0 mr-md-2">Merendinha </a>
      <div class="navbar-nav-scroll align-items-end">
        <ul class="navbar-nav bd-navbar-nav flex-row ">
          <li class="nav-item">
            <a class="nav-link" href="#"> Sair </a>
          </li>
        </ul>
      </div>
    </header>

    <div class="container-fluid">
      <div class="row flex-xl-nowrap">
        
        <?php include_once('../navAluno.blade.php'); ?>

        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-1 bd-content" role="main">
            <div class="card border-light">
              <h4 class="card-header">NOVO CADASTRO - Modalidade de ensino 
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/modEnsino.blade.php" role="button">Buscar</a>
              </h4>
              <div class="card-body">
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