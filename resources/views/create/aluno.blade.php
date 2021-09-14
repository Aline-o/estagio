<?php 
// CONEXÃO COM O BANCO
include_once('../../../public/config.php'); 
//fuso-horario. Caso esteja no periodo noturno, pode dar diferenca de 1 dia em alunoespecial
date_default_timezone_set("America/Sao_Paulo"); 

/*
Aluno: 
  Matricula(CP), DataNascimento, Nome, Patologia(tinyint), Turma_idTurma
AlunoEspecial:
  Aluno_Matricula(CP), Patologia_idPatologia(CP), DataPatologia
Patologia:
  idPatologia, Descricao, Grupo
*/

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
  extract($_REQUEST);

  #=========================================#
  #============= Sem patologia =============#
  #=========================================#
  if(!isset($Patologia) || $Patologia==""){
    // Checkbox sem seleção envia valor nulo, portanto, zero precisa ser definido.
    $Patologia=0;

    if($Matricula==""){
      // mensagem de campo obrigatorio
      header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); 
      exit;
    }elseif($Nome==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=robr');
      exit;
    }elseif($DataNascimento==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=robr');
      exit;
    }elseif($Turma_idTurma==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=robr');
      exit;
    }else{
      // se pá pode apagar, não testei sem
      $userCount	=	$db->getQueryCount('aluno','Matricula');
      // colunas da tabela
      $data	=	array(
        'Matricula'=>$Matricula,
        'Nome'=> $Nome,          
        'DataNascimento'=> $DataNascimento,
        'Patologia'=>$Patologia,
        'Turma_idTurma'=>$Turma_idTurma,
      );
      $insert	=	$db->insert('aluno',$data);
      if($insert){
        // mensagem add com sucesso
        header('location: ../read/aluno.blade.php?msg=radd');
        exit;
      }else{
        // mensagem erro
        header('location: ../read/aluno.blade.php?msg=rerr'); 
        exit;
      }
    }

  #=========================================#
  #============= Com patologia =============#
  #=========================================#
  }else{
    if($Matricula==""){
      // mensagem de campo obrigatorio
      header('location:'.$_SERVER['PHP_SELF'].'?msg=robr');
      exit;
    }elseif($Nome==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=robr');
      exit;
    }elseif($DataNascimento==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=robr');
      exit;
    }elseif($Turma_idTurma==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=robr');
      exit;
    }else{
      $userCount	=	$db->getQueryCount('aluno','Matricula');
      $data	=	array(
        'Matricula'=>$Matricula,
        'Nome'=> $Nome,       
        'DataNascimento'=> $DataNascimento,
        'Patologia'=>$Patologia,
        'Turma_idTurma'=>$Turma_idTurma,
      );
      $insert	=	$db->insert('aluno',$data);

      #---------- ALUNO ESPECIAL ----------#
      $userCount2	=	$db->getQueryCount('alunoespecial','Aluno_Matricula');
      $Aluno_Matricula = $Matricula;
      // Hora atual
      $DataPatologia = date('Y-m-d');
      $data2	=	array(
        'Aluno_Matricula'=>$Aluno_Matricula,
        'Patologia_idPatologia'=>$Patologia_idPatologia,       
        'DataPatologia'=>$DataPatologia,
      );
      $insert2	=	$db->insert('alunoespecial',$data2);

      if($insert){
        // mensagem add com sucesso
        header('location: ../read/aluno.blade.php?msg=radd');
        exit;
      }elseif($insert && $insert2){
        header('location: ../read/aluno.blade.php?msg=radd');
        exit;
      }else{
        // mensagem nao adicionado
        header('location: ../read/aluno.blade.php?msg=rerr');
        exit;
      }
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
        
        <?php include_once('../sidebar/navAluno.blade.php'); ?>

        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-1 bd-content" role="main">
      
          <div class="card border-light">
            <h4 class="card-header">NOVO CADASTRO - Aluno
              <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/aluno.blade.php" role="button">Buscar</a>
            </h4>
            <div class="card-body">
              
              <!-- mensagens de alerta, ex: adicionado com sucesso, deletado com sucesso, etc -->
              <?php include_once('../../../public/alertMsg.php'); ?>

              <div class="card-title">Preencha corretamente o formulário abaixo:</div>
              <form method="POST">
                <div class="row">
                  <div class="form-group col-sm-8">
                    <label for="Nome">Nome Completo</label>
                    <input type="text" class="form-control" name="Nome" placeholder="Insira o Nome Completo do Aluno" required autofocus>
                  </div>
                  <div class="form-group col-sm-4">
                    <label for="Matricula">Matrícula</label>
                    <input type="text" class="form-control" name="Matricula" placeholder="Insira o número da Matrícula" required>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-sm-3">
                    <label for="DataNascimento">Data de nascimento do aluno</label>
                    <input type="date" class="form-control" name="DataNascimento" id="DataNascimento" placeholder="Insira a Data de nascimento do Aluno" required>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="Turma_idTurma">Turma</label>
                    <select class="form-control" id="Turma_idTurma" name="Turma_idTurma" required><!--//php buscando id-->
                      <option selected disabled value="">Escolha uma opção...</option>
                      
                      <?php 
                      $condition	=	'';
                      if(isset($_REQUEST['NomeTurma']) and $_REQUEST['NomeTurma']!=""){
                        $condition	.=	' AND NomeTurma LIKE "%'.$_REQUEST['NomeTurma'].'%" ';
                      }
                      if(isset($_REQUEST['idTurma']) and $_REQUEST['idTurma']!=""){
                        $condition	.=	' AND idTurma LIKE "%'.$_REQUEST['idTurma'].'%" ';
                      }
                      // Status 1 para valores não "deletados" pelo usuario
                      $condition	.=	' AND Status = 1 ';
                      $userData	=	$db->getAllRecords('turma','*', $condition,'ORDER BY idTurma DESC');
                    
                      if(count($userData)>0){
                        $s	=	'';
                        foreach($userData as $val){
                          $s++;
                      ?>
                      
                      <option value="<?php echo (int)$val['idTurma']; ?>"> <?php echo $val['NomeTurma']; ?> </option>
                      
                      <?php 
                        }
                      }
                      ?>
                    </select>
                  </div>
                
                  <div class="form-group col-sm-3">
                    <label for="Patologia">Restrição Alimentar? </label>
                    <div class="form-check" data-toggle="collapse" data-target="#patologiaTable">
                      <input class="form-check-input" type="checkbox" value=1 name="Patologia" id="Patologia">
                      <label class="form-check-label" for="Patologia">
                        Sim
                      </label>
                    </div>
                  </div>
                </div>              

                <div class="row collapse" id="patologiaTable">
                  <div class="form-group col-sm-4">
                    <label for="Patologia_idPatologia">Restrição Alimentar</label>
                    <select class="form-control" name="Patologia_idPatologia" id="Patologia_idPatologia" required>
                      <option selected disabled value="">Escolha uma opção...</option>
                      
                      <?php 
                      // exibir Grupo (requisição da Emilly da prefeitura)
                      $condition	=	'';
                      if(isset($_REQUEST['Grupo']) and $_REQUEST['Grupo']!=""){
                        $condition	.=	' AND Grupo LIKE "%'.$_REQUEST['Grupo'].'%" ';
                      }
                      if(isset($_REQUEST['idPatologia']) and $_REQUEST['idPatologia']!=""){
                        $condition	.=	' AND idPatologia LIKE "%'.$_REQUEST['idPatologia'].'%" ';
                      }
                      $condition	.=	' AND Status = 1 ';
                      $userData	=	$db->getAllRecords('patologia','*', $condition,'ORDER BY idPatologia DESC');
                    
                      if(count($userData)>0){
                        $s	=	'';
                        foreach($userData as $val){
                          $s++;
                      ?>
                      
                      <option value="<?php echo (int)$val['idPatologia'];?>"> <?php echo $val['Grupo'];?> </option>
                      
                      <?php 
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="row">
                  <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">Enviar</button>
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