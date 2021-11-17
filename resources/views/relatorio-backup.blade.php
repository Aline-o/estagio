<?php
// CONEXÃO COM O BANCO
include_once('../../public/config.php');

  if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){

    // output headers so that the file is downloaded rather than displayed
    header('Content-Encoding: UTF-8');
    header('Content-type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="demo.csv"');
    echo "\xEF\xBB\xBF"; // UTF-8 BOM
    
    // do not cache the file. Não funcion no site do 000host la
    // header('Pragma: no-cache');
    // header('Expires: 0');
    
    // create a file pointer connected to the output stream
    $file = fopen('php://output', 'w');
    
    // send the column headers
    fputcsv($file, array('Prefeitura de Jacareí'));
    fputcsv($file, array('Secretaria de Educação'));
    fputcsv($file, array('Controle mensal de consumo de merenda','Creches e maternal'),';');
    fputcsv($file, array('Parcial/integral (alunos presentes)'));
    fputcsv($file, array('Escola:'));
    fputcsv($file, array('Mês:'));
    fputcsv($file, array('**Marcação por presença**'));
    
    // Sample data. This can be fetched from mysql too
    $data = array(
        array(
            'dia'=>'Dia',
            'campo1'=> 'C1 (BI - 4 a 5 meses)',
            'campo2'=> 'c2 (BI - 6 a 12 meses)',
            'campo3'=> 'c3 (BI/BII/BIII e Mat. Integral - 1 a 4 anos)',
            'campo4'=> 'c4 (maternal parcial) manhã',
            'campo5'=> 'c4 (maternal parcial) tarde',
            'campo6'=> 'c5 (lanche complementar)',
        ),
        array(
            'dia'=>'data 10',
            'campo1'=> 'data 11',
            'campo2'=> 'data 12',
            'campo3'=> 'data 13',
            'campo4'=> 'data 14',
            'campo5'=> 'data 15',
            'campo6'=> 'data 16',
        ),
        array(
            'dia'=>'data 20',
            'campo1'=> 'data 21',
            'campo2'=> 'data 22',
            'campo3'=> 'data 23',
            'campo4'=> 'data 24',
            'campo5'=> 'data 25',
            'campo6'=> 'data 26',
        )
      );
    
    
    // output each row of the data
    foreach ($data as $row)
    {
    fputcsv($file, $row, ';');
    }
        
    fclose($file);
    // nao funciona pq  redireciona a página antes de download. Sleep() não resolve.
    //header('location:' .$_SERVER['PHP_SELF'].'?msg=ratt'); #<!-- success -->
    exit();

  }


?>
<!doctype html>
<html lang="pt-br">
  <?php include_once('head.blade.php'); ?>

  <body>
    <?php include_once('header.blade.php'); ?>

    <div class="container-fluid">
      <div class="row flex-xl-nowrap">
        
        <?php include_once('sidebar/navRelatorio.blade.php'); ?>

        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-1 bd-content" role="main">
        
          <?php include_once('../../public/alertMsg.php');?>
        
            <div class="card border-light">
              <h4 class="card-header text-center">Teste relatório</h4>
              <div class="card-body text-justify">      
                <form method="POST">          
                  <div class="card-title">Teste de download de arquivo csv com dados fictícios.</div>
                  <div class="col-sm-12">
                    
                    <!-- justify-content-end --->


                  </div>
                  <div class="row ">
                    <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">Download</button>
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