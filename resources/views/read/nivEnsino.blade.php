<?php 
// CONEXÃO COM O BANCO
include_once('../../../public/config.php');

$condition	=	'';
if(isset($_REQUEST['NomeNivelEnsino']) and $_REQUEST['NomeNivelEnsino']!=""){
  $condition	.=	' AND NomeNivelEnsino LIKE "%'.$_REQUEST['NomeNivelEnsino'].'%" ';
}
$condition	.=	' AND Status = 1 ';
$userData	=	$db->getAllRecords('nivelensino','*',$condition,'ORDER BY idNivelEnsino DESC');
?>

<!doctype html>
<html lang="pt-br">

  <?php include_once('../head.blade.php'); ?>

  <body>
  
    <?php include_once('../header.blade.php'); ?>

    <div class="container-fluid">
      <div class="row flex-xl-nowrap">
        
        <?php include_once('../sidebar/navNivEnsino.blade.php'); ?>

        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-1 bd-content" role="main">      
          <div class="card border-light">
            <h4 class="card-header">Lista de Níveis de ensino
              <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../create/nivEnsino.blade.php" role="button">Novo cadastro</a>
            </h4>
            <div class="card-body">

              <?php include_once('../../../public/alertMsg.php');?>

              <div class="card-title">
                <!-------- Barra de pesquisa -------->
                <form method="get">
                  <div class="row">
                    <div class="form-group col-sm-12">
                      <label for="NomeNivelEnsino">Nível de Ensino</label>
                      <input type="text" name="NomeNivelEnsino" id="NomeNivelEnsino" class="form-control" value="<?php echo isset($_REQUEST['NomeNivelEnsino'])?$_REQUEST['NomeNivelEnsino']:''?>" placeholder="Entra Nível de Ensino">
                    </div>
                  </div>

                  <div class="row">
                    <button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Pesquisar</button>
                    <a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn btn-danger offset-md-1"><i class="fa fa-times"></i> Limpar</a>
                  </div>
                </form>
              </div>
              
              <!-------- Tabela -------->
              <table class="table table-striped">
                <thead>
                  <tr class="bg-primary text-white">
                    <th scope="col">Sr#</th>
                    <th scope="col">Nome do Nível de Ensino</th>
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
                    <td><?php echo $val['NomeNivelEnsino'];?></td> <!-- Precisa ser exatamente como esta no banco -->
                    <td align="center">
                      <a href="../update/nivEnsino.blade.php?editId=<?php echo $val['idNivelEnsino'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
                      <a href="../delete/nivEnsino.php?delId=<?php echo $val['idNivelEnsino'];?>" class="text-danger" onClick="return confirm('Tem certeza que deseja excluir?');"><i class="fa fa-fw fa-trash"></i> Deletar</a>
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
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function()
      {
        $('[data-toggle="popover"]').popover();      
      });
    </script>
  </body>
</html>