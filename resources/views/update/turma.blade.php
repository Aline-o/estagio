<?php include_once('../../../public/config.php');
  if(isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
    $row	=	$db->getAllRecords(' turma, nivelensino, turno, serie, escola ',' turma.*,
    nivelensino.idNivelEnsino, nivelensino.NomeNivelEnsino, 
    turno.idTurno, turno.NomeTurno,
    serie.idSerie, serie.NomeSerie,
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
      header('location:'.$_SERVER['PHP_SELF'].'?editId='.$_REQUEST['editId'].'&msg=robr');  //msg campo obrigatorio
      exit;
    }elseif($Ano==""){
      header('location:'.$_SERVER['PHP_SELF'].'?editId='.$_REQUEST['editId'].'&msg=robr');  //msg campo obrigatorio
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
      $update	=	$db->update('turma',$data,array('idTurma'=>$editId));
      if($update){
        header('location: ../read/turma.blade.php?msg=ratt'); //add com sucesso
        exit;
      }else{
        header('location: ../read/turma.blade.php?msg=rnna'); // nao adicionado
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
        
        <?php include_once('../sidebar/navTurma.blade.php'); ?>

        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-1 bd-content" role="main">
        
            <div class="card border-light">
              <h4 class="card-header">EDITAR CADASTRO - Turma
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/turma.blade.php" role="button">Buscar</a>
              </h4>
              <div class="card-body">
                <?php include_once('../../../public/alertMsg.php');?>
                <div class="card-title">Preencha corretamente o formulário abaixo:</div>
                <form method="POST">
                  <div class="row">
                    <div class="form-group col-sm-6">
                      <label for="NomeTurma">Nome da turma</label>
                      <input type="text" class="form-control" name="NomeTurma" value="<?php echo $row[0]['NomeTurma']; ?>" placeholder="<?php echo $row[0]['NomeTurma']; ?>"required autofocus>
                    </div>
                    <div class="form-group col-sm-2">
                      <label for="Ano">Ano da turma</label>
                      <input type="text" class="form-control" name="Ano" value="<?php echo $row[0]['Ano']; ?>" placeholder="<?php echo $row[0]['Ano']; ?>"required autofocus>
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
                    $userData	=	$db->getAllRecords('nivelensino','*', $condition,'ORDER BY idNivelEnsino DESC');
                  
                    ?>
                      <div class="form-group col-sm-4">
                        <label for="NivelEnsino_idNivelEnsino">Nível Ensino</label>
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
                </div>

                      
                  <div class="row">
                   
                    <?php 
                      $condition	=	'';
                      if(isset($_REQUEST['NomeTurno']) and $_REQUEST['NomeTurno']!=""){
                        $condition	.=	' AND NomeTurno LIKE "%'.$_REQUEST['NomeTurno'].'%" ';
                      }
                      if(isset($_REQUEST['idTurno']) and $_REQUEST['idTurno']!=""){
                        $condition	.=	' AND idTurno LIKE "%'.$_REQUEST['idTurno'].'%" ';
                      }
                      $condition	.=	' AND Status = 1 ';
                      $userData	=	$db->getAllRecords('turno','*', $condition,'ORDER BY idTurno DESC');
                      
                    ?>

                    <div class="form-group col-sm-3">
                      <label for="Turno_idTurno">Turno</label>
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
                  
                  

                    <?php 

                    $condition	=	'';
                    if(isset($_REQUEST['NomeSerie']) and $_REQUEST['NomeSerie']!=""){
                      $condition	.=	' AND NomeSerie LIKE "%'.$_REQUEST['NomeSerie'].'%" ';
                    }
                    if(isset($_REQUEST['idSerie']) and $_REQUEST['idSerie']!=""){
                      $condition	.=	' AND idSerie LIKE "%'.$_REQUEST['idSerie'].'%" ';
                    }
                    $condition	.=	' AND Status = 1 ';
                    $userData	=	$db->getAllRecords('serie','*', $condition,'ORDER BY idSerie DESC');
                  
                  ?>
                    <div class="form-group col-sm-3">
                      <label for="Serie_idSerie">Série</label>
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
                    if(isset($_REQUEST['NomeEscola']) and $_REQUEST['NomeEscola']!=""){
                      $condition	.=	' AND NomeEscola LIKE "%'.$_REQUEST['NomeEscola'].'%" ';
                    }
                    if(isset($_REQUEST['idEscola']) and $_REQUEST['idEscola']!=""){
                      $condition	.=	' AND idEscola LIKE "%'.$_REQUEST['idEscola'].'%" ';
                    }
                    $condition	.=	' AND Status = 1 ';
                    $userData	=	$db->getAllRecords('escola','*', $condition,'ORDER BY idEscola DESC');
                      
                    ?>

                    <div class="form-group col-sm-6">
                      <label for="Escola_idEscola">Escola</label>
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