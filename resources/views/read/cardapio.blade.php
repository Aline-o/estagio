<?php 
// CONEXÃO COM O BANCO
include_once('../../../public/config.php');

$condition	=	'';
if(isset($_REQUEST['Nome']) and $_REQUEST['Nome']!=""){
  $condition	.=	' AND Nome LIKE "%'.$_REQUEST['Nome'].'%" ';
}
if(isset($_REQUEST['Sigla']) and $_REQUEST['Sigla']!=""){
  $condition	.=	' AND Sigla LIKE "%'.$_REQUEST['Sigla'].'%" ';
}
if(isset($_REQUEST['Descricao']) and $_REQUEST['Descricao']!=""){
  $condition	.=	' AND Descricao LIKE "%'.$_REQUEST['Descricao'].'%" ';
}
if(isset($_REQUEST['Valor']) and $_REQUEST['Valor']!=""){
  
  $valor_inicial = $_REQUEST['Valor'];
  $valor_final = str_replace(",",".", $valor_inicial);
  
  $condition	.=	' AND Valor LIKE "%'.$valor_final.'%" ';
}
$condition	.=	' AND Status = 1 ';
$userData	=	$db->getAllRecords('cardapio','*',$condition,'ORDER BY idCardapio DESC');
?>

<!doctype html>
<html lang="pt-br">
  
  <?php include_once('../head.blade.php'); ?>

  <body>
  
    <?php include_once('../header.blade.php'); ?>

    <div class="container-fluid">
      <div class="row flex-xl-nowrap">
        
        <?php include_once('../sidebar/navCardapio.blade.php'); ?>

        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-1 bd-content" role="main">
          <div class="card border-light">
            <h4 class="card-header">Lista de Cardápios
              <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../create/cardapio.blade.php" role="button">Novo cadastro</a>
            </h4>
            <div class="card-body">

              <?php include_once('../../../public/alertMsg.php');?>

              <div class="card-title">
                <!-------- Barra de pesquisa -------->
                <form method="get">
                    <div class="row">
                      <div class="form-group col-sm-3">
                        <label for="Nome">Cardápio</label>
                        <input type="text" name="Nome" id="Nome" class="form-control" value="<?php echo isset($_REQUEST['Nome'])?$_REQUEST['Nome']:''?>" placeholder="Entra Cardápio">
                      </div>
                      <div class="form-group col-sm-2">
                        <label for="Sigla">Sigla</label>
                        <input type="text" name="Sigla" id="Sigla" class="form-control" value="<?php echo isset($_REQUEST['Sigla'])?$_REQUEST['Sigla']:''?>" placeholder="Entra Sigla">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="Descricao">Descrição</label>
                        <input type="text" name="Descricao" id="Descricao" class="form-control" value="<?php echo isset($_REQUEST['Descricao'])?$_REQUEST['Descricao']:''?>" placeholder="Entra Descrição">
                      </div>
                      <div class="form-group col-sm-2">
                        <label for="Valor">Valor</label>
                        <input type="text" name="Valor" id="Valor" class="form-control" value="<?php echo isset($_REQUEST['Valor'])?$_REQUEST['Valor']:''?>" placeholder="Entra Valor">
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
                    <th scope="col">Nome do Cardápio</th>
                    <th scope="col">Sigla</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Valor (R$)</th>
                    <th scope="col" class="text-center">Ação</th>
                  </tr>
                </thead>
                <tbody>

                  <?php 
                  if(count($userData)>0){
                    $s	=	'';
                    foreach($userData as $val){
                      $s++;

                      $valor_inicial = $val['Valor'];
                      $valor_replace = str_replace(".",",", $valor_inicial);
                  ?>

                  <tr>
                    <td><?php echo $s;?></td>
                    <td><?php echo $val['Nome'];?></td>
                    <td><?php echo $val['Sigla'];?></td>
                    <td><?php echo $val['Descricao'];?></td>
                    <td><?php echo $valor_replace;?></td>
                    <td align="center">
                      <a href="../update/cardapio.blade.php?editId=<?php echo $val['idCardapio'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
                      <a href="../delete/cardapio.php?delId=<?php echo $val['idCardapio'];?>" class="text-danger" onClick="return confirm('Tem certeza que deseja excluir?');"><i class="fa fa-fw fa-trash"></i> Deletar</a>
                    </td>
                  </tr>

                  <?php 
                    }
                  }else{
                  ?>
                  
                  <tr><td colspan="6" align="center">No Record(s) Found!</td></tr>
                  
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