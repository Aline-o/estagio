<?php 
// CONEXÃO COM O BANCO
include_once('../../../public/config.php');

$condition	=	'';
if(isset($_REQUEST['Descricao']) and $_REQUEST['Descricao']!=""){
  $condition	.=	' AND Descricao LIKE "%'.$_REQUEST['Descricao'].'%" ';
}
if(isset($_REQUEST['Grupo']) and $_REQUEST['Grupo']!=""){
  $condition	.=	' AND Grupo LIKE "%'.$_REQUEST['Grupo'].'%" ';
}
$condition	.=	' AND Status = 1 ';
$userData	=	$db->getAllRecords('patologia','*',$condition,'ORDER BY idPatologia DESC');
?>

<!doctype html>
<html lang="pt-br">

  <?php include_once('../head.blade.php'); ?>

  <body>

    <?php include_once('../header.blade.php'); ?>

    <div class="container-fluid">
      <div class="row flex-xl-nowrap">
        
        <?php include_once('../sidebar/navPatologia.blade.php'); ?>

        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-1 bd-content" role="main">        
          <div class="card border-light">
            <h4 class="card-header">Lista de Restrição Alimentar
              <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../create/patologia.blade.php" role="button">Novo cadastro</a>
            </h4>
            <div class="card-body">

              <?php include_once('../../../public/alertMsg.php');?>

              <div class="card-title">
                <!-------- Barra de pesquisa -------->
                <form method="get">
                  <div class="row">
                    <div class="form-group col-sm-8">
                      <label for="Descricao">Restrição Alimentar</label>
                      <input type="text" name="Descricao" id="Descricao" class="form-control" value="<?php echo isset($_REQUEST['Descricao'])?$_REQUEST['Descricao']:''?>" placeholder="Entra Restrição Alimentar">
                    </div>
                    <div class="form-group col-sm-4">
                      <label for="Grupo">Grupo</label>
                      <input type="text" name="Grupo" id="Grupo" class="form-control" value="<?php echo isset($_REQUEST['Grupo'])?$_REQUEST['Grupo']:''?>" placeholder="Entra Grupo">
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
                    <th scope="col">Nome da Restrição Alimentar</th>
                    <th scope="col">Grupo</th>
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
                    <td><?php echo $val['Descricao'];?></td> <!-- Precisa ser exatamente como esta no banco -->
                    <td><?php echo $val['Grupo'];?></td> <!-- Precisa ser exatamente como esta no banco -->
                    <td align="center">
                      <a href="../update/patologia.blade.php?editId=<?php echo $val['idPatologia'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
                      <a href="../delete/patologia.php?delId=<?php echo $val['idPatologia'];?>" class="text-danger" onClick="return confirm('Tem certeza que deseja excluir?');"><i class="fa fa-fw fa-trash"></i> Deletar</a>
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