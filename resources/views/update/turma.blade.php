<!--falta chaves estrangeiras-->
<?php include_once('../../../public/config.php');
  if(isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
    $row	=	$db->getAllRecords(' turma, NivelEnsino, Turno, Serie, Escola ',' turma.*,
    NivelEnsino.idNivelEnsino, NivelEnsino.NomeNivelEnsino, 
    Turno.idTurno, Turno.NomeTurno,
    Serie.idSerie, Serie.NomeSerie,
    escola.idEscola, escola.NomeEscola ',
    ' AND idTurma="'.$_REQUEST['editId'].'" 
    AND idNivelEnsino=NivelEnsino_idNivelEnsino 
    AND idTurno=Turno_idTurno 
    AND idSerie=Serie_idSerie 
    AND idEscola=Escola_idEscola ');
  }

  if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
    extract($_REQUEST);
    if($NomeTurma==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); //msg campo obrigatorio
      exit;
    }elseif($Ano==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); //msg campo obrigatorio
      exit;
    }else{
      $data	=	array(
        'NomeTurma'=> $NomeTurma, //colunas    
        'Ano'=>$Ano,
        'NivelEnsino_idNivelEnsino'=>$NivelEnsino_idNivelEnsino,
        'Turno_idTurno'=>$Turno_idTurno,
        'Serie_idSerie'=>$Serie_idSerie,
        'Escola_idEscola'=>$Escola_idEscola,
      );
      $update	=	$db->update('Turma',$data,array('idTurma'=>$editId));
      if($update){
        header('location: ../read/Turma.blade.php?msg=ratt'); //add com sucesso
        exit;
      }else{
        header('location: ../read/Turma.blade.php?msg=rnna'); // nao adicionado
        exit;
      }
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Aqui, aline</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.0/cerulean/bootstrap.min.css" integrity="sha384-b+jboW/YIpW2ZZYyYdXczKK6igHlnkPNfN9kYAbqYV7rNQ9PKTXlS2D6j1QZIATW" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="../scss/style.scss" rel="stylesheet"> <!--estilização personalizada-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
    </script>
  </head>


  <body>
    <nav class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Merenda</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">

        <?php include_once('../navTurma.blade.php'); ?>
        
        <div class="tab-content">

          <div id="cadTurma" class="tab-pane active"><br>
            <div class="card border-light">
              <h4 class="card-header">NOVO CADASTRO - Turma
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/Turma.blade.php" role="button">Buscar</a>
              </h4>
              <div class="card-body">
                <?php include_once('../../../public/alertMsg.php');?>
                <div class="card-title">Preencha corretamente o formulário abaixo:</div>
                <form method="POST">
                  <div class="row">
                    <div class="col-sm-6">
                      <label>Nome da turma</label>
                    </div>
                    <div class="col-sm-6">
                      <label>Ano da turma</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-sm-6">
                      <input type="text" class="form-control" name="NomeTurma" value="<?php echo $row[0]['NomeTurma']; ?>" placeholder="<?php echo $row[0]['NomeTurma']; ?>"required autofocus>
                    </div>
                    <div class="form-group col-sm-6">
                      <input type="text" class="form-control" name="Ano" value="<?php echo $row[0]['Ano']; ?>" placeholder="<?php echo $row[0]['Ano']; ?>"required autofocus>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <label>Série</label>
                    </div>
                    <div class="col-sm-6">
                      <label>Turno</label>
                    </div>
                  </div>
                   <?php 

                    $condition	=	'';
                    if(isset($_REQUEST['NomeSerie']) and $_REQUEST['NomeSerie']!=""){
                      $condition	.=	' AND NomeSerie LIKE "%'.$_REQUEST['NomeSerie'].'%" ';
                    }
                    if(isset($_REQUEST['idSerie']) and $_REQUEST['idSerie']!=""){
                      $condition	.=	' AND idSerie LIKE "%'.$_REQUEST['idSerie'].'%" ';
                    }
                    $condition	.=	' AND Status = 1 ';
                    $userData	=	$db->getAllRecords('Serie','*', $condition,'ORDER BY idSerie DESC');
                  
                  ?>
                  <div class="row">
                    <div class="form-group col-sm-6">
                      <select class="form-control" id="Serie_idSerie" name="Serie_idSerie" required>
                        <option selected value="<?php echo $row[0]['idSerie']; ?>"><?php echo $row[0]['NomeSerie']; ?></option>
                        <?php 
                        
                        if(count($userData)>0){
                          $s	=	'';
                          foreach($userData as $val){
                            $s++;
                        ?>
                        
                        <option value="<?php echo (int)$val['idSerie'];?>"> <?php echo $val['NomeSerie'];?> </option>
                        
                        <?php 
                          }
                        }
                        ?>
                      </select>
                    </div>

                    <?php 
                      $condition	=	'';
                      if(isset($_REQUEST['NomeTurno']) and $_REQUEST['NomeTurno']!=""){
                        $condition	.=	' AND NomeTurno LIKE "%'.$_REQUEST['NomeTurno'].'%" ';
                      }
                      if(isset($_REQUEST['idTurno']) and $_REQUEST['idTurno']!=""){
                        $condition	.=	' AND idTurno LIKE "%'.$_REQUEST['idTurno'].'%" ';
                      }
                      $condition	.=	' AND Status = 1 ';
                      $userData	=	$db->getAllRecords('Turno','*', $condition,'ORDER BY idTurno DESC');
                      
                    ?>

                    <div class="form-group col-sm-6">
                      <select class="form-control" id="Turno_idTurno" name="Turno_idTurno" required>
                        <option selected value="<?php echo $row[0]['idTurno']; ?>"><?php echo $row[0]['NomeTurno']; ?></option>

                        <?php                         
                        if(count($userData)>0){
                          $s	=	'';
                          foreach($userData as $val){
                            $s++;
                        ?>
                        
                        <option value="<?php echo (int)$val['idTurno'];?>"> <?php echo $val['NomeTurno'];?> </option>
                        
                        <?php 
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <label>Nível Ensino</label>
                    </div>
                    <div class="col-sm-6">
                      <label>Escola</label>
                    </div>
                  </div>
                  
                  <?php 
                  $condition	=	'';
                  if(isset($_REQUEST['NomeNivelEnsino']) and $_REQUEST['NomeNivelEnsino']!=""){
                    $condition	.=	' AND NomeNivelEnsino LIKE "%'.$_REQUEST['NomeNivelEnsino'].'%" ';
                  }
                  if(isset($_REQUEST['idNivelEnsino']) and $_REQUEST['idNivelEnsino']!=""){
                    $condition	.=	' AND idNivelEnsino LIKE "%'.$_REQUEST['idNivelEnsino'].'%" ';
                  }
                  $condition	.=	' AND Status = 1 ';
                  $userData	=	$db->getAllRecords('NivelEnsino','*', $condition,'ORDER BY idNivelEnsino DESC');
                
                  ?>

                  <div class="row">
                    <div class="form-group col-sm-6">
                      <select class="form-control" id="NivelEnsino_idNivelEnsino" name="NivelEnsino_idNivelEnsino" required>
                        <option selected value="<?php echo $row[0]['idNivelEnsino']; ?>"><?php echo $row[0]['NomeNivelEnsino']; ?></option>

                        <?php 
                        if(count($userData)>0){
                          $s	=	'';
                          foreach($userData as $val){
                            $s++;
                        ?>
                        
                        <option value="<?php echo (int)$val['idNivelEnsino'];?>"> <?php echo $val['NomeNivelEnsino'];?> </option>
                        
                        <?php 
                          }
                        }
                        ?>
                      </select>
                    </div>
                    
                    <?php 
                    $condition	=	'';
                    if(isset($_REQUEST['NomeEscola']) and $_REQUEST['NomeEscola']!=""){
                      $condition	.=	' AND NomeEscola LIKE "%'.$_REQUEST['NomeEscola'].'%" ';
                    }
                    if(isset($_REQUEST['idEscola']) and $_REQUEST['idEscola']!=""){
                      $condition	.=	' AND idEscola LIKE "%'.$_REQUEST['idEscola'].'%" ';
                    }
                    $condition	.=	' AND Status = 1 ';
                    $userData	=	$db->getAllRecords('Escola','*', $condition,'ORDER BY idEscola DESC');
                      
                    ?>

                    <div class="form-group col-sm-6">
                      <select class="form-control" id="Escola_idEscola" name="Escola_idEscola" required>
                        <option selected value="<?php echo $row[0]['idEscola']; ?>"><?php echo $row[0]['NomeEscola']; ?></option>

                        <?php 
                        if(count($userData)>0){
                          $s	=	'';
                          foreach($userData as $val){
                            $s++;
                        ?>
                        
                        <option value="<?php echo (int)$val['idEscola'];?>"> <?php echo $val['NomeEscola'];?> </option>
                        
                        <?php 
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">Editar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
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