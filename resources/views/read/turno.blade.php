<?php include_once('../../../public/config.php');?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Merenda prefeitura</title>

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
        <?php include_once('../navTurno.blade.php'); ?>
        
        <?php
          $condition	=	'';
          if(isset($_REQUEST['nomeTurno']) and $_REQUEST['nomeTurno']!=""){
            $condition	.=	' AND nomeTurno LIKE "%'.$_REQUEST['nomeTurno'].'%" ';
          }
          if(isset($_REQUEST['HoraInicio']) and $_REQUEST['HoraInicio']!=""){
            $condition	.=	' AND HoraInicio LIKE "%'.$_REQUEST['HoraInicio'].'%" ';
          }
          if(isset($_REQUEST['HoraFim']) and $_REQUEST['HoraFim']!=""){
            $condition	.=	' AND HoraFim LIKE "%'.$_REQUEST['HoraFim'].'%" ';
          }
          $condition	.=	' AND Status = 1 ';
          $userData	=	$db->getAllRecords('turno','*',$condition,'ORDER BY idTurno DESC');
        ?>


        <div class="tab-content">
          
          <div id="home" class="container tab-pane active"><br>
            <div class="card border-light">
              <h4 class="card-header">Lista de Turnos
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../create/Turno.blade.php" role="button">Novo cadastro</a>
              </h4>
              <div class="card-body">

                <?php include_once('../../../public/alertMsg.php');?>

                <div class="card-title">
                    <form method="get">
                      <div class="row">
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Turno</label>
                            <input type="text" name="nomeTurno" id="nomeTurno" class="form-control" value="<?php echo isset($_REQUEST['nomeTurno'])?$_REQUEST['nomeTurno']:''?>" placeholder="Entra Turno">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Hora início</label>
                            <input type="time" name="HoraInicio" id="HoraInicio" class="form-control" value="<?php echo isset($_REQUEST['HoraInicio'])?$_REQUEST['HoraInicio']:''?>" placeholder="Entra Turno">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Hora fim</label>
                            <input type="time" name="HoraFim" id="HoraFim" class="form-control" value="<?php echo isset($_REQUEST['HoraFim'])?$_REQUEST['HoraFim']:''?>" placeholder="Entra Turno">
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
                      <th scope="col">Nome do Turno</th>
                      <th scope="col">Hora início</th>
                      <th scope="col">Hora fim</th>
                      <th scope="col" class="text-center">Ação</th>
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
                      <td><?php echo $val['NomeTurno'];?></td> <!-- Precisa ser exatamente como esta no banco -->
                      <td><?php echo $val['HoraInicio'];?></td>
                      <td><?php echo $val['HoraFim'];?></td>
                      <td align="center">
                        <a href="../update/turno.blade.php?editId=<?php echo $val['idTurno'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
                        <a href="../delete/turno.php?delId=<?php echo $val['idTurno'];?>" class="text-danger" onClick="return confirm('Tem certeza que deseja excluir?');"><i class="fa fa-fw fa-trash"></i> Deletar</a>
                      </td>
                    </tr>
                    <?php 
                        }
                      }else{
                    ?>
                    <tr><td colspan="5" align="center">No Record(s) Found!</td></tr>
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