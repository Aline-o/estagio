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
        <?php include_once('../navTurma.blade.php'); ?>



        
        <?php
          $condition	=	'';
          /*
          esse bloco é para a pesquisa do nome da turma.
          */
          if(isset($_REQUEST['NomeTurma']) and $_REQUEST['NomeTurma']!=""){
            $condition	.=	' AND NomeTurma LIKE "%'.$_REQUEST['NomeTurma'].'%" ';
          }
          if(isset($_REQUEST['Ano']) and $_REQUEST['Ano']!=""){
            $condition	.=	' AND Ano LIKE "%'.$_REQUEST['Ano'].'%" ';
          }

          /*
          esse bloco é para a esquisa da modalidade de ensino.
          como é tabela diferente e usa-se chave estrangeira, se feito da mesma forma que o nomeescola,
          teria que pesquisar o id da modalidade, mas isso não e viável, portanto, há um primeiro
          select para achar o nome da modEnsino na tabela, e depois é buscado na escola com o id correspondente
          */
          if(isset($_REQUEST['NomeNivelEnsino']) and $_REQUEST['NomeNivelEnsino']!=""){
            $condition5='';
            $condition5	.=	' AND NomeNivelEnsino LIKE "%'.$_REQUEST['NomeNivelEnsino'].'%" ';
            $userData5	=	$db->getAllRecords('nivelensino','*',$condition5,'ORDER BY idNivelEnsino DESC');
            
            if(count($userData5)>0){ //se retornar algum valor do select...
              $contador=0;
              foreach($userData5 as $valMod){ //para cada valor encontrado...

                if($contador == 0) //primeira vez, primeiro resultado da pesquisa
                {
                  $condition	.=	' AND NivelEnsino_idNivelEnsino LIKE '.$valMod['idNivelEnsino'].' ';
                  $contador++;
                }else{
                  $condition	.=	' OR NivelEnsino_idNivelEnsino LIKE '.$valMod['idNivelEnsino'].' ';
                }
              }
            }
          }

          if(isset($_REQUEST['NomeTurno']) and $_REQUEST['NomeTurno']!=""){
            $condition5='';
            $condition5	.=	' AND NomeTurno LIKE "%'.$_REQUEST['NomeTurno'].'%" ';
            $userData5	=	$db->getAllRecords('turno','*',$condition5,'ORDER BY idTurno DESC');
            
            if(count($userData5)>0){ //se retornar algum valor do select...
              $contador=0;
              foreach($userData5 as $valMod){ //para cada valor encontrado...

                if($contador == 0) //primeira vez, primeiro resultado da pesquisa
                {
                  $condition	.=	' AND Turno_idTurno LIKE '.$valMod['idTurno'].' ';
                  $contador++;
                }else{
                  $condition	.=	' OR Turno_idTurno LIKE '.$valMod['idTurno'].' ';
                }
              }
            }
          }
          if(isset($_REQUEST['NomeSerie']) and $_REQUEST['NomeSerie']!=""){
            $condition5='';
            $condition5	.=	' AND NomeSerie LIKE "%'.$_REQUEST['NomeSerie'].'%" ';
            $userData5	=	$db->getAllRecords('serie','*',$condition5,'ORDER BY idSerie DESC');
            
            if(count($userData5)>0){ //se retornar algum valor do select...
              $contador=0;
              foreach($userData5 as $valMod){ //para cada valor encontrado...

                if($contador == 0) //primeira vez, primeiro resultado da pesquisa
                {
                  $condition	.=	' AND Serie_idSerie LIKE '.$valMod['idSerie'].' ';
                  $contador++;
                }else{
                  $condition	.=	' OR Serie_idSerie LIKE '.$valMod['idSerie'].' ';
                }
              }
            }
          }
          if(isset($_REQUEST['NomeEscola']) and $_REQUEST['NomeEscola']!=""){
            $condition5='';
            $condition5	.=	' AND NomeEscola LIKE "%'.$_REQUEST['NomeEscola'].'%" ';
            $userData5	=	$db->getAllRecords('escola','*',$condition5,'ORDER BY idEscola DESC');
            
            if(count($userData5)>0){ //se retornar algum valor do select...
              $contador=0;
              foreach($userData5 as $valMod){ //para cada valor encontrado...

                if($contador == 0) //primeira vez, primeiro resultado da pesquisa
                {
                  $condition	.=	' AND Escola_idEscola LIKE '.$valMod['idEscola'].' ';
                  $contador++;
                }else{
                  $condition	.=	' OR Escola_idEscola LIKE '.$valMod['idEscola'].' ';
                }
              }
            }
          }
          

          $condition	.=	' AND Status = 1 ';
          $userData	=	$db->getAllRecords('turma','*',$condition,'ORDER BY idTurma DESC');
        ?>


        <div class="tab-content">
          
          <div id="home" class="container tab-pane active"><br>
            <div class="card border-light">
              <h4 class="card-header">Lista de Turmas
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../create/turma.blade.php" role="button">Novo cadastro</a>
              </h4>
              <div class="card-body">

                <?php include_once('../../../public/alertMsg.php');?>

                <div class="card-title">
                    <form method="get">
                      <div class="row">
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Turma</label>
                            <input type="text" name="NomeTurma" id="NomeTurma" class="form-control" value="<?php echo isset($_REQUEST['NomeTurma'])?$_REQUEST['NomeTurma']:''?>" placeholder="Entra Turma">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Ano</label>
                            <input type="text" name="Ano" id="Ano" class="form-control" value="<?php echo isset($_REQUEST['Ano'])?$_REQUEST['Ano']:''?>" placeholder="Entra Ano">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Nível de ensino</label>
                            <input type="text" name="NomeNivelEnsino" id="NomeNivelEnsino" class="form-control" value="<?php echo isset($_REQUEST['NomeNivelEnsino'])?$_REQUEST['NomeNivelEnsino']:''?>" placeholder="Entra Niv. de ensino">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Turno</label>
                            <input type="text" name="NomeTurno" id="NomeTurno" class="form-control" value="<?php echo isset($_REQUEST['NomeTurno'])?$_REQUEST['NomeTurno']:''?>" placeholder="Entra Turno">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Serie</label>
                            <input type="text" name="NomeSerie" id="NomeSerie" class="form-control" value="<?php echo isset($_REQUEST['NomeSerie'])?$_REQUEST['NomeSerie']:''?>" placeholder="Entra Serie">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Escola</label>
                            <input type="text" name="NomeEscola" id="NomeEscola" class="form-control" value="<?php echo isset($_REQUEST['NomeEscola'])?$_REQUEST['NomeEscola']:''?>" placeholder="Entra Turma">
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
                      <th scope="col">Nível de ensino</th>
                      <th scope="col">Turno</th>
                      <th scope="col">Série</th>
                      <th scope="col">Escola</th>
                      <th scope="col" class="text-center">Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(count($userData)>0){
                        $s	=	'';
                        foreach($userData as $val){
                          $s++;

                          $convNivEns	=	$db->getAllRecords2('nivelensino',' idNivelEnsino, NomeNivelEnsino ','idNivelEnsino ='.$val['NivelEnsino_idNivelEnsino'].' ');
                          foreach($convNivEns as $val2){}
                          $convTurno	=	$db->getAllRecords2('turno',' idTurno, NomeTurno ','idTurno ='.$val['Turno_idTurno'].' ');
                          foreach($convTurno as $val3){}
                          $convSerie	=	$db->getAllRecords2('serie',' idSerie, NomeSerie ','idSerie ='.$val['Serie_idSerie'].' ');
                          foreach($convSerie as $val4){}
                          $convEscola	=	$db->getAllRecords2('escola',' idEscola, NomeEscola ','idEscola ='.$val['Escola_idEscola'].' ');
                          foreach($convEscola as $val5){}
                          /*
                          NomeNivelEnsino / NivelEnsino_idNivelEnsino
                          NomeTurno / Turno_idTurno
                          NomeSerie / Serie_idSerie
                          NomeEscola / Escola_idEscola
                          */
                    ?>
                    <tr>
                      <td><?php echo $s;?></td>
                      <td><?php echo $val['NomeTurma'];?></td> <!-- Precisa ser exatamente como esta no banco -->
                      <td><?php echo $val['Ano'];?></td>
                      <td><?php echo $val2['NomeNivelEnsino'];?></td>
                      <td><?php echo $val3['NomeTurno'];?></td>
                      <td><?php echo $val4['NomeSerie'];?></td>
                      <td><?php echo $val5['NomeEscola'];?></td>
                      <td align="center">
                        <a href="../update/turma.blade.php?editId=<?php echo $val['idTurma'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
                        <a href="../delete/turma.php?delId=<?php echo $val['idTurma'];?>" class="text-danger" onClick="return confirm('Tem certeza que deseja excluir?');"><i class="fa fa-fw fa-trash"></i> Deletar</a>
                      </td>
                    </tr>
                    <?php 
                        }
                      }else{
                    ?>
                    <tr><td colspan="8" align="center">No Record(s) Found!</td></tr>
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