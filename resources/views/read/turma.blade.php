<?php include_once('../../../public/config.php');?>
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
        <?php include_once('../navNivEnsino.blade.php'); ?>

        <?php
          $condition	=	'';
          if(isset($_REQUEST['nomeTurma']) and $_REQUEST['nomeTurma']!=""){
            $condition	.=	' AND nomeTurma LIKE "%'.$_REQUEST['nomeTurma'].'%" ';
          }
          if(isset($_REQUEST['Ano']) and $_REQUEST['Ano']!=""){
            $condition	.=	' AND Ano LIKE "%'.$_REQUEST['Ano'].'%" ';
          }
          if(isset($_REQUEST['NivelEnsino_idNivelEnsino']) and $_REQUEST['NivelEnsino_idNivelEnsino']!=""){
            $condition	.=	' AND NivelEnsino_idNivelEnsino LIKE "%'.$_REQUEST['NivelEnsino_idNivelEnsino'].'%" ';
          }
          if(isset($_REQUEST['Turno_idTurno']) and $_REQUEST['Turno_idTurno']!=""){
            $condition	.=	' AND Turno_idTurno LIKE "%'.$_REQUEST['Turno_idTurno'].'%" ';
          }
          if(isset($_REQUEST['Serie_idSerie']) and $_REQUEST['Serie_idSerie']!=""){
            $condition	.=	' AND Serie_idSerie LIKE "%'.$_REQUEST['Serie_idSerie'].'%" ';
          }
          if(isset($_REQUEST['Escola_idEscola']) and $_REQUEST['Escola_idEscola']!=""){
            $condition	.=	' AND Escola_idEscola LIKE "%'.$_REQUEST['Escola_idEscola'].'%" ';
          }
          $userData	=	$db->getAllRecords('Turma','*',$condition,'ORDER BY idTurma DESC');
        ?>


        <div class="tab-content">
          
          <div id="home" class="container tab-pane active"><br>
            <div class="card border-light">
              <h4 class="card-header">Lista de Turmas
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../create/Turma.blade.php" role="button">Novo cadastro</a>
              </h4>
              <div class="card-body">

                <?php include_once('../../../public/alertMsg.php');?>

                <div class="card-title">
                    <form method="get">
                      <div class="row">
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Turma</label>
                            <input type="text" name="nomeTurma" id="nomeTurma" class="form-control" value="<?php echo isset($_REQUEST['nomeTurma'])?$_REQUEST['nomeTurma']:''?>" placeholder="Entra Turma">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Ano</label>
                            <input type="text" name="Ano" id="Ano" class="form-control" value="<?php echo isset($_REQUEST['Ano'])?$_REQUEST['Ano']:''?>" placeholder="Entra Turma">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Nível de ensino</label>
                            <input type="text" name="NivelEnsino_idNivelEnsino" id="NivelEnsino_idNivelEnsino" class="form-control" value="<?php echo isset($_REQUEST['NivelEnsino_idNivelEnsino'])?$_REQUEST['NivelEnsino_idNivelEnsino']:''?>" placeholder="Entra Turma">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Turno</label>
                            <input type="text" name="Turno_idTurno" id="Turno_idTurno" class="form-control" value="<?php echo isset($_REQUEST['Turno_idTurno'])?$_REQUEST['Turno_idTurno']:''?>" placeholder="Entra Turma">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Serie</label>
                            <input type="text" name="Serie_idSerie" id="Serie_idSerie" class="form-control" value="<?php echo isset($_REQUEST['Serie_idSerie'])?$_REQUEST['Serie_idSerie']:''?>" placeholder="Entra Turma">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Escola</label>
                            <input type="text" name="Escola_idEscola" id="Escola_idEscola" class="form-control" value="<?php echo isset($_REQUEST['Escola_idEscola'])?$_REQUEST['Escola_idEscola']:''?>" placeholder="Entra Turma">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Search</button>
                        <a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn btn-danger"><i class="fa fa-times"></i> Clear</a>
                      </div>    
                    </form>
                </div>
                <table class="table table-striped">
                  <thead>
                    <tr class="bg-primary text-white">
                      <th scope="col">Sr#</th>
                      <th scope="col">Nome da Turma</th>
                      <th scope="col">Ano</th>
                      <th scope="col">Nivel de ensino</th>
                      <th scope="col">Turno</th>
                      <th scope="col">Serie</th>
                      <th scope="col">Escola</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(count($userData)>0){
                        $s	=	'';
                        foreach($userData as $val){
                          $s++;
                    ?>
                    <tr>
                      <td><?php echo $s;?></td>
                      <td><?php echo $val['NomeTurma'];?></td> <!-- Precisa ser exatamente como esta no banco -->
                      <td><?php echo $val['Ano'];?></td>
                      <td><?php echo $val['NivelEnsino_idNivelEnsino'];?></td>
                      <td><?php echo $val['Turno_idTurno'];?></td>
                      <td><?php echo $val['Serie_idSerie'];?></td>
                      <td><?php echo $val['Escola_idEscola'];?></td>
                      <td align="center">
                        <a href="../update/Turma.blade.php?editId=<?php echo $val['idTurma'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Edit</a> | 
                        <a href="../delete/Turma.php?delId=<?php echo $val['idTurma'];?>" class="text-danger" onClick="return confirm('Are you sure to delete this user?');"><i class="fa fa-fw fa-trash"></i> Delete</a>
                      </td>
                    </tr>
                    <?php 
                        }
                      }else{
                    ?>
                    <tr><td colspan="3" align="center">No Record(s) Found!</td></tr>
                    <?php 
                      }
                    ?>
                  </tbody>
                </table>
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