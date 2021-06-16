<?php 
include_once('../../../public/config.php');
  if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
    extract($_REQUEST);
    if($NomeTurno==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); //msg campo obrigatorio
      exit;
    }elseif($HoraInicio==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); //msg campo obrigatorio
      exit;
    }elseif($HoraFim==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); //msg campo obrigatorio
      exit;
    }else{
      $userCount	=	$db->getQueryCount('turno','idTurno'); //users eh a tabela
      $data	=	array(
        'NomeTurno'=> $NomeTurno, //colunas 
        'HoraInicio'=>$HoraInicio,
        'HoraFim'=>$HoraFim,
      );
      $insert	=	$db->insert('turno',$data);
      if($insert){
        header('location: ../read/turno.blade.php?msg=radd'); //add com sucesso
        exit;
      }else{
        header('location: ../read/turno.blade.php?msg=rerr'); // nao adicionado
        exit;
      }
    }
  }
?>
<?php 
include_once('../../../public/config.php');?>
<!doctype html>
<html lang="pt-br">
  <?php include_once('../head.blade.php'); ?>

  <body>
    <?php include_once('../header.blade.php'); ?>

    <div class="container-fluid">
      <div class="row flex-xl-nowrap">
        
        <?php include_once('../sidebar/navTurno.blade.php'); ?>

        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-1 bd-content" role="main">
            <div class="card border-light">
              <h4 class="card-header">NOVO CADASTRO - Turno 
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/turno.blade.php" role="button">Buscar</a>
              </h4>
              <div class="card-body">
                <?php include_once('../../../public/alertMsg.php');?>
                <div class="card-title">Preencha corretamente o formulário abaixo:</div>
                <form method="POST">
                  <div class="row">
                    <div class="form-group col-sm-4">
                      <label for="NomeTurno">Nome do Turno</label>
                      <input type="text" class="form-control" name="NomeTurno" placeholder="Insira o nome do Turno" required autofocus>
                    </div>
                    <div class="form-group col-sm-4">
                      <label for="HoraInicio">Hora de início</label>
                      <input type="time" class="form-control" name="HoraInicio" placeholder="Insira o horário inicial" required>
                    </div>
                    <div class="form-group col-sm-4">
                      <label for="HoraFim">Hora fim</label>
                      <input type="time" class="form-control" name="HoraFim" placeholder="Insira o horário final" required>
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