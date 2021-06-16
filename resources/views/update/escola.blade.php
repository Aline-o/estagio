<?php include_once('../../../public/config.php');
  if(isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
    $row	=	$db->getAllRecords('escola, modalidadeensino','escola.NomeEscola, escola.idEscola, 
    modalidadeensino.Sigla, modalidadeensino.idModalidadeEnsino',
    ' AND idEscola="'.$_REQUEST['editId'].'" AND idModalidadeEnsino=ModalidaEnsino_idModalidadeEnsino');
  }

  if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
    extract($_REQUEST);
    if($NomeEscola==""){
      header('location:'.$_SERVER['PHP_SELF'].'?editId='.$_REQUEST['editId'].'&msg=robr');  //msg campo obrigatorio
      exit;
    }elseif($ModalidaEnsino_idModalidadeEnsino==""){
      header('location:'.$_SERVER['PHP_SELF'].'?editId='.$_REQUEST['editId'].'&msg=robr');  //msg campo obrigatorio
      exit;
    }

    $data	=	array(
        'NomeEscola'=> $NomeEscola, //colunas    
        'ModalidaEnsino_idModalidadeEnsino'=>$ModalidaEnsino_idModalidadeEnsino
      );
    $update	=	$db->update('escola',$data,array('idEscola'=>$editId));
    if($update){
      header('location: ../read/escola.blade.php?msg=ratt'); #<!-- success -->
      exit;
    }else{
      header('location: ../read/escola.blade.php?msg=rnna'); #<!-- nao teve alteracao -->
      exit;
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
        
        <?php include_once('../sidebar/navEscola.blade.php'); ?>

        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-1 bd-content" role="main">
        
            <div class="card border-light">
              <h4 class="card-header">EDITAR CADASTRO - Escola
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/escola.blade.php" role="button">Buscar</a>
              </h4>
              <div class="card-body">
                <?php include_once('../../../public/alertMsg.php');?>
                <div class="card-title">Preencha corretamente o formulário abaixo:</div>
                <form method="POST">

                  <?php 
                    $condition	=	'';
                    if(isset($_REQUEST['Sigla']) and $_REQUEST['Sigla']!=""){
                      $condition	.=	' AND Sigla LIKE "%'.$_REQUEST['Sigla'].'%" ';
                    }
                    if(isset($_REQUEST['idModalidadeEnsino']) and $_REQUEST['idModalidadeEnsino']!=""){
                      $condition	.=	' AND idModalidadeEnsino LIKE "%'.$_REQUEST['idModalidadeEnsino'].'%" ';
                    }
                    $condition	.=	' AND Status = 1 ';
                    $userData	=	$db->getAllRecords('modalidadeensino','*', $condition,'ORDER BY idModalidadeEnsino DESC');
                  ?>  

                  <div class="row">
                    <div class="form-group col-sm-6">
                      <label for="NomeEscola">Nome da escola</label>
                      <input type="text" class="form-control" name="NomeEscola" value="<?php echo $row[0]['NomeEscola']; ?>" placeholder="<?php echo $row[0]['NomeEscola']; ?>"required autofocus>
                    </div>                    
                    <div class="form-group col-sm-4">
                      <label for="ModalidaEnsino_idModalidadeEnsino">Modalidade de ensino</label>
                      <select class="form-control" name="ModalidaEnsino_idModalidadeEnsino" id="ModalidaEnsino_idModalidadeEnsino" required>
                        <option selected value="<?php echo $row[0]['idModalidadeEnsino']; ?>"><?php echo $row[0]['Sigla']; ?></option>
                        
                        <?php                         
                        if(count($userData)>0){
                          $s	=	'';
                          foreach($userData as $val){
                            $s++;
                            //$Mod_idModalidadeEnsino.= (int)$val['idModalidadeEnsino'];
                        ?>
                        
                        <option value="<?php echo (int)$val['idModalidadeEnsino'];?>"> <?php echo $val['Sigla'];?> </option>
                        
                        <?php 
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <input type="hidden" name="editId" id="editId" value="<?php echo $_REQUEST['editId']?>">
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