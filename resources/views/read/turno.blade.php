<?php 
// CONEXÃO COM O BANCO
include_once('../../../public/config.php');

$condition	=	'';
if(isset($_REQUEST['NomeTurno']) and $_REQUEST['NomeTurno']!=""){
  $condition	.=	' AND NomeTurno LIKE "%'.$_REQUEST['NomeTurno'].'%" ';
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

<!doctype html>
<html lang="pt-br">

  <?php include_once('../head.blade.php'); ?>

  <body>
  
    <?php include_once('../header.blade.php'); ?>

    <div class="container-fluid">
      <div class="row flex-xl-nowrap">
        
        <?php include_once('../sidebar/navTurno.blade.php'); ?>

        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-1 bd-content" role="main">      
          <div class="card border-light">
            <h4 class="card-header">Lista de Turnos
              <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../create/turno.blade.php" role="button">Novo cadastro</a>
            </h4>
            <div class="card-body">

              <?php include_once('../../../public/alertMsg.php');?>

              <div class="card-title">
                <!-------- Barra de pesquisa -------->
                <form method="get">
                  <div class="row">
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="NomeTurno">Turno</label>
                        <input type="text" name="NomeTurno" id="NomeTurno" class="form-control" value="<?php echo isset($_REQUEST['NomeTurno'])?$_REQUEST['NomeTurno']:''?>" placeholder="Entra Turno">
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="HoraInicio">Hora início</label>
                        <input type="time" name="HoraInicio" id="HoraInicio" class="form-control" value="<?php echo isset($_REQUEST['HoraInicio'])?$_REQUEST['HoraInicio']:''?>" placeholder="Entra Turno">
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="HoraFim">Hora fim</label>
                        <input type="time" name="HoraFim" id="HoraFim" class="form-control" value="<?php echo isset($_REQUEST['HoraFim'])?$_REQUEST['HoraFim']:''?>" placeholder="Entra Turno">
                      </div>
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
                    <td><?php echo $val['NomeTurno'];?></td>
                    <td><?php 
                      /* Nota: as variáveis de hora, pela configuração do banco, armazenam os segundos também.
                      Para escolha manual, é somente horas e minutos, portanto, a visualização foi alterada 
                      para ficar de acordo com a visualização do usuário.
                      */
                      $varHoraInicio = $val['HoraInicio'];
                      //explode — Split a string by a string. Divide uma string através de um caractere de referência.                      
                      $explHoraInicio = explode(":", $varHoraInicio); 
                      //formato desejado para exibição. Ex  "19:00"
                      $varHoraInicio = $explHoraInicio[0].":".$explHoraInicio[1];
                      echo $varHoraInicio;
                      ?></td>

                    <td><?php 
                      //mesmo esquema
                      $varHoraFim = $val['HoraFim'];
                      $explHoraFim = explode(":", $varHoraFim); 
                      $varHoraFim = $explHoraFim[0].":".$explHoraFim[1];
                      echo $varHoraFim;
                      ?></td>

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