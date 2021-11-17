<?php
// CONEXÃO COM O BANCO
include_once('../../public/config.php');

require '../../vendor/autoload.php';
//require('../../PHPExcel.php');


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

  if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
    //$arquivo = 'mimecont.xlsx';

   // echo 'teste garai';

    // Configurações header para forçar o download 
    //header('Content-Description: File Transfer');
   // header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    //header("Content-Disposition: attachment; filename=teste.xlsx");
    //header("Content-Transfer-Encoding: binary");
    //header("Expires: 0");
    //header("Pragma: public");
    //header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    //header('Content-Length: ' . filesize($arquivo)); //Remove
    //echo 'teste garai2';
    
    /*$html='';
    $html.='<table border="1">';
      $html.='<tr>';
        $html.='<td colspan="5">planilhaa teste brabo</td>';
      $html.='</tr>';

      $html.='<tr>';
        $html.='<td><b>ID</b></td>';
        $html.='<td><b>Nome</b></td>';
        $html.='<td><b>E-mail</b></td>';
        $html.='<td><b>Assunto</b></td>';
        $html.='<td><b>Data</b></td>';
      $html.='</tr>';
      
      $html.='<tr>';
        $html.='<td>1</td>';
        $html.='<td>Aline</td>';
        $html.='<td>aline@aline.com</td>';
        $html.='<td>11teste de arquivo</td>';
        $html.='<td>29/10/2021</td>';
      $html.='</tr>';

      $html.='<tr>';
        $html.='<td>2</td>';
        $html.='<td>Aline2</td>';
        $html.='<td>aline@aline.com</td>';
        $html.='<td>22teste de arquivo</td>';
        $html.='<td>29/10/2021</td>';
      $html.='</tr>';

      $html.='<tr>';
        $html.='<td>3</td>';
        $html.='<td>Aline3</td>';
        $html.='<td>aline@aline.com</td>';
        $html.='<td>33teste de arquivo</td>';
        $html.='<td>29/10/2021</td>';
      $html.='</tr>';

    $html.='</table>';s
    */

    //readfile($arquivo);

/*
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');
*/


//Including PHPExcel library and creation of its object
//require('PHPExcel.php');
$phpExcel = new Spreadsheet();
// Setting font to Arial Black
$phpExcel->getDefaultStyle()->getFont()->setName('Arial Black');
// Setting font size to 14
$phpExcel->getDefaultStyle()->getFont()->setSize(14);
//Setting description, creator and title
$phpExcel ->getProperties()->setTitle("Vendor list");
$phpExcel ->getProperties()->setCreator("Robert");
$phpExcel ->getProperties()->setDescription("Excel SpreadSheet in PHP");
// Creating PHPExcel spreadsheet writer object
// We will create xlsx file (Excel 2007 and above)
//$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");

// When creating the writer object, the first sheet is also created
// We will get the already created sheet
$sheet = $phpExcel ->getActiveSheet();
// Setting title of the sheet
$sheet->setTitle('My product list');
// Creating spreadsheet header
$sheet ->getCell('A1')->setValue('Prefeitura de Jacareí');
$sheet ->getCell('A2')->setValue('Secretaria de Educação');
$sheet ->getCell('A3')->setValue('CONTROLE MENSAL DE CONSUMO DE MERENDA - CRECHES E MATERNAL');
$sheet ->getCell('A4')->setValue('PARCIAL/INTEGRAL (ALUNOS PRESENTES)');
$sheet ->getCell('A4')->setValue('Escola:');
$sheet ->getCell('A4')->setValue('Mês:');
$sheet ->getCell('A4')->setValue('**Marcação por presença**');
// Making headers text bold and larger
$sheet->getStyle('A1:A4')->getFont()->setBold(true)->setSize(14);
// Insert product data

$sheet->mergeCells("A1:C1");
$sheet->mergeCells("A2:C2");
$sheet->mergeCells("A3:C3");
$sheet->mergeCells("A4:C4");
$sheet->getStyle('A:B')->getAlignment()->setHorizontal('center');

// Autosize the columns
$sheet->getColumnDimension('A')->setAutoSize(false);
$sheet->getColumnDimension('B')->setAutoSize(false);
$sheet->getColumnDimension('C')->setAutoSize(false);

//testar depois, mudar acima pra falso
$value =  $sheet->getCell('A3')->getValue();
$width = mb_strwidth ($value); //Return the width of the string
$sheet->getColumnDimension('A')->setWidth($width);

// Save the spreadsheet
$writer = new Xlsx($phpExcel);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="testeM.xlsx"');
        $writer->save('php://output');

//$writer->save('products.xlsx');
    exit;

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