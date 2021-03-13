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
        <?php include_once('../navEscola.blade.php'); ?>

        <?php
          $condition	=	'';
          /*
          esse bloco é para a pesquisa do nome da escola.
          */
          if(isset($_REQUEST['NomeEscola']) and $_REQUEST['NomeEscola']!=""){
            $condition	.=	' AND NomeEscola LIKE "%'.$_REQUEST['NomeEscola'].'%" ';
          }

          /*
          esse bloco é para a esquisa da modalidade de ensino.
          como é tabela diferente e usa-se chave estrangeira, se feito da mesma forma que o nomeescola,
          teria que pesquisar o id da modalidade, mas isso não e viável, portanto, há um primeiro
          select para achar o nome da modEnsino na tabela, e depois é buscado na escola com o id correspondente
          */
          if(isset($_REQUEST['NomeModalidadeEnsino']) and $_REQUEST['NomeModalidadeEnsino']!=""){
            $condition5='';
            $condition5	.=	' AND NomeModalidadeEnsino LIKE "%'.$_REQUEST['NomeModalidadeEnsino'].'%" ';
            $userData5	=	$db->getAllRecords('modalidadeensino','*',$condition5,'ORDER BY idModalidadeEnsino DESC');
            
            if(count($userData5)>0){ //se retornar algum valor do select...
              $contador=0;
              foreach($userData5 as $valMod){ //para cada valor encontrado...

                if($contador == 0) //primeira vez, primeiro resultado da pesquisa
                {
                  $condition	.=	' AND ModalidaEnsino_idModalidadeEnsino LIKE '.$valMod['idModalidadeEnsino'].' ';
                  $contador++;
                }else{
                  $condition	.=	' OR ModalidaEnsino_idModalidadeEnsino LIKE '.$valMod['idModalidadeEnsino'].' ';
                }
                //echo "<span>  ".$valMod['idModalidadeEnsino']." \br </span>";

              }
            }
          }

          $condition	.=	' AND Status = 1 ';
          $userData	=	$db->getAllRecords('escola','*',$condition,'ORDER BY idEscola DESC');
          
        ?>


        <div class="tab-content">
          
          <div id="home" class="container tab-pane active"><br>
            <div class="card border-light">
              <h4 class="card-header">Lista de Escolas
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../create/Escola.blade.php" role="button">Novo cadastro</a>
              </h4>
              <div class="card-body">

                <?php include_once('../../../public/alertMsg.php');?>

                <div class="card-title">
                    <form method="get">
                      <div class="row">
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Escola</label>
                            <input type="text" name="NomeEscola" id="NomeEscola" class="form-control" value="<?php echo isset($_REQUEST['NomeEscola'])?$_REQUEST['NomeEscola']:''?>" placeholder="Entra Escola">
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Modalidade de ensino</label>
                            <input type="text" name="NomeModalidadeEnsino" id="NomeModalidadeEnsino" class="form-control" value="<?php echo isset($_REQUEST['NomeModalidadeEnsino'])?$_REQUEST['NomeModalidadeEnsino']:''?>" placeholder="Entra Modalidade de ensino">
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
                      <th scope="col">Nome da Escola</th>
                      <th scope="col">Modalidade de ensino</th>
                      <th scope="col" class="text-center">Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(count($userData)>0){
                        $s	=	'';
                        foreach($userData as $val){
                          $s++;

                          //aqui converte modalidade de ensino
                          // getAllRecords($tableName, $fields='*', $cond='', $orderBy='', $limit='')
                          //"SELECT $fields FROM $tableName WHERE 1 ".$cond." ".$orderBy." ".$limit


                          $convModEns	=	$db->getAllRecords2('modalidadeensino',' idModalidadeEnsino, NomeModalidadeEnsino ','idModalidadeEnsino ='.$val['ModalidaEnsino_idModalidadeEnsino'].' ');
                        foreach($convModEns as $val2){}


                    ?>
                    <tr>
                      <td><?php echo $s;?></td>
                      <td><?php echo $val['NomeEscola'];?></td> <!-- Precisa ser exatamente como esta no banco -->
                      <td><?php echo $val2['NomeModalidadeEnsino'];?></td>
                      <td align="center">
                        <a href="../update/Escola.blade.php?editId=<?php echo $val['idEscola'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
                        <a href="../delete/escola.php?delId=<?php echo $val['idEscola'];?>" class="text-danger" onClick="return confirm('Tem certeza que deseja excluir?');"><i class="fa fa-fw fa-trash"></i> Deletar</a>
                      </td>
                    </tr>
                    <?php 
                        }
                      }else{
                    ?>
                    <tr><td colspan="4" align="center">No Record(s) Found!</td></tr>
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