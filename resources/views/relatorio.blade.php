<?php
// CONEXÃO COM O BANCO
include_once('../../public/config.php');

date_default_timezone_set("America/Sao_Paulo"); 
// echo date("d/m/y G:i:s") . "<br>";

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








$date1="23/06/23 18:30:47";
$date2="23/03/21 10:30:47"; //mid
$date3="23/04/25 11:30:47";


$idate1=date_create_from_format("d/m/y G:i:s", $date1);
$idate2=date_create_from_format("d/m/y G:i:s", $date2);
$idate3=date_create_from_format("d/m/y G:i:s", $date3);

$idate1= date_format($idate1,"y/m/d");
$idate2= date_format($idate2,"y/m/d");
$idate3= date_format($idate3,"y/m/d");


if ($idate3 >= $idate2 && $idate3 <= $idate1)
    echo "$idate3 ta no meio de $idate2 e $idate1";
else
    echo "$idate3 n esta entre $idate2 e $idate1";

    */

    //readfile($arquivo);



//Including PHPExcel library and creation of its object
//require('PHPExcel.php');
$phpExcel = new Spreadsheet();
// Setting font to Arial Black
$phpExcel->getDefaultStyle()->getFont()->setName('Arial Black');
// Setting font size to 14
$phpExcel->getDefaultStyle()->getFont()->setSize(14);
//Setting description, creator and title
$phpExcel ->getProperties()->setTitle("Vendor list");
$phpExcel ->getProperties()->setCreator("Aline");
$phpExcel ->getProperties()->setDescription("Excel SpreadSheet in PHP");
// Creating PHPExcel spreadsheet writer object
// We will create xlsx file (Excel 2007 and above)
//$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");

// When creating the writer object, the first sheet is also created
// We will get the already created sheet
$sheet = $phpExcel ->getActiveSheet();
// Setting title of the sheet
$sheet->setTitle('Relatorio prefeitura');
// Creating spreadsheet header
$sheet ->getCell('A1')->setValue('Prefeitura de Jacareí');
$sheet ->getCell('A2')->setValue('Secretaria de Educação');
$sheet ->getCell('A3')->setValue('CONTROLE MENSAL DE CONSUMO DE MERENDA - CRECHES E MATERNAL');
$sheet ->getCell('A4')->setValue('PARCIAL/INTEGRAL (ALUNOS PRESENTES)');
$sheet ->getCell('A5')->setValue('Escola:');
$sheet ->getCell('A6')->setValue('Mês:');
$sheet ->getCell('A7')->setValue('**Marcação por presença**');

$sheet ->getCell('A8')->setValue('Dia');
$sheet ->getCell('B8')->setValue('C1 (BI - 4 a 5 meses)');
$sheet ->getCell('C8')->setValue('c2 (BI - 6 a 12 meses)');
$sheet ->getCell('D8')->setValue('c3 (BI/BII/BIII e Mat. Integral - 1 a 4 anos)');
$sheet ->getCell('E8')->setValue('c4 (maternal parcial)');
$sheet ->getCell('E9')->setValue('manhã');
$sheet ->getCell('F9')->setValue('tarde');
$sheet ->getCell('G8')->setValue('c5 (lanche complementar)');

// Making headers text bold and larger
$sheet->getStyle('A1:A7')->getFont()->setBold(true)->setSize(20);
// Insert product data

$sheet->mergeCells("A1:G1");
$sheet->mergeCells("A2:G2");
$sheet->mergeCells("A3:G3");
$sheet->mergeCells("A4:G4");
$sheet->mergeCells("A5:G5");
$sheet->mergeCells("A6:G6");
$sheet->mergeCells("A7:G7");
$sheet->mergeCells("E8:F8");
$sheet->getStyle('A:G')->getAlignment()->setHorizontal('center');

// Autosize the columns
$sheet->getColumnDimension('A')->setAutoSize(false);
$sheet->getColumnDimension('B')->setAutoSize(false);
$sheet->getColumnDimension('C')->setAutoSize(false);
$sheet->getColumnDimension('D')->setAutoSize(false);
$sheet->getColumnDimension('E')->setAutoSize(false);
$sheet->getColumnDimension('F')->setAutoSize(false);
$sheet->getColumnDimension('G')->setAutoSize(false);

//testar depois, mudar acima pra falso
$value =  $sheet->getCell('A8')->getValue();
$width = mb_strwidth ($value); //Return the width of the string
$sheet->getColumnDimension('A')->setWidth($width+1);

$value =  $sheet->getCell('B8')->getValue();
$width = mb_strwidth ($value); //Return the width of the string
$sheet->getColumnDimension('B')->setWidth($width);

$value =  $sheet->getCell('C8')->getValue();
$width = mb_strwidth ($value); //Return the width of the string
$sheet->getColumnDimension('C')->setWidth($width);

$value =  $sheet->getCell('D8')->getValue();
$width = mb_strwidth ($value); //Return the width of the string
$sheet->getColumnDimension('D')->setWidth($width-5);

$value =  $sheet->getCell('E8')->getValue();
$width = mb_strwidth ($value); //Return the width of the string
$sheet->getColumnDimension('E')->setWidth($width/2);
$sheet->getColumnDimension('F')->setWidth($width/2);

$value =  $sheet->getCell('G8')->getValue();
$width = mb_strwidth ($value); //Return the width of the string
$sheet->getColumnDimension('G')->setWidth($width);

/*
AA - Alpha component [0..255] of the color
RR - Red component [0..255] of the color
GG - Green component [0..255] of the color
BB - Blue component [0..255] of the color

100% - FF
95% - F2
90% - E6
85% - D9
80% - CC
75% - BF
70% - B3
65% - A6
60% - 99
55% - 8C
50% - 80
45% - 73
40% - 66
35% - 59
30% - 4D
25% - 40
20% - 33
15% - 26
10% - 1A
5% - 0D
0% - 00

EXEMPLOS:
BLACK = 'FF000000'
BLUE = 'FF0000FF'
RED = 'FFFF0000'

*/
$sheet->getStyle('A8:G8')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
$sheet->getStyle('A8:G8')
    ->getFill()->getStartColor()->setARGB('ffbdbdbd');
$sheet->getStyle('A9:G9')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
$sheet->getStyle('A9:G9')
    ->getFill()->getStartColor()->setARGB('ffbdbdbd');

    $styleArray = [
      'font' => [
          'bold' => true,
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
      ],
      'borders' => [
          'top' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => [
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
          'rotation' => 90,
          'startColor' => [
              'argb' => 'FFA0A0A0',
          ],
          'endColor' => [
              'argb' => 'FFFFFFFF',
          ],
      ],
  ];
  $sheet->getStyle('A10:A40')->applyFromArray($styleArray);  

  for($i=1; $i<=31; $i++){   
    $sheet ->getCell('A'.($i+9))->setValue($i);
  //$sheet ->getCell('A6')->setValue('Mês:');
  }
  $sheet ->getCell('A41')->setValue('Subtotal:');
  $sheet ->getCell('A42')->setValue('Total:');



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

                  <div class="row">
                    <div class="form-group col-sm-6">
                      <label for="Escola_idEscola">Escola</label>
                      <select class="form-control" id="Escola_idEscola" name="Escola_idEscola" required>
                        <option selected disabled value="">Escolha uma opção...</option>
                        
                        <?php 
                        $condition	=	'';
                        if(isset($_REQUEST['NomeEscola']) and $_REQUEST['NomeEscola']!=""){
                          $condition	.=	' AND NomeEscola LIKE "%'.$_REQUEST['NomeEscola'].'%" ';
                        }
                        if(isset($_REQUEST['idEscola']) and $_REQUEST['idEscola']!=""){
                          $condition	.=	' AND idEscola LIKE "%'.$_REQUEST['idEscola'].'%" ';
                        }
                        // Status 1 para valores não "deletados" pelo usuario
                        $condition	.=	' AND Status = 1 ';
                        $userData	=	$db->getAllRecords('escola','*', $condition,'ORDER BY idEscola DESC');
                      
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

                    <div class="form-group col-sm-4">
                      <label for="datah">Data</label>
                      <select class="form-control" id="datah" name="datah" required>
                        <option selected disabled value="">Escolha uma opção...</option>
                        
                        <?php 

                        // read na tabela consumo,lista mais recente pro menos, split datahora, remove duplicatas
                        $condition	=	'';
                        if(isset($_REQUEST['DataHora']) and $_REQUEST['DataHora']!=""){
                          $condition	.=	' AND DataHora LIKE "%'.$_REQUEST['DataHora'].'%" ';
                        }
                        $condition	.=	' AND Status = 1 ';
                        $userData	=	$db->getAllRecords('consumo','DataHora, Status',$condition,'ORDER BY DataHora DESC');

                        
                        if(count($userData)>0){
                          $s	=	'';
                          foreach($userData as $val){
                            $s++;

                            //explode — Split a string by a string. Divide uma string através de um caractere de referência.                      
                            $exploData = str_split($val['DataHora']); 
                            //formato desejado para exibição. Ex  "19:00"
                            $varData = $exploData[0]."/".$exploData[1];
                        ?>
                        
                        <option value=""> <?php 
                          
                          echo $exploData[0];
                          
                          print_r($exploData);
                          if (str_contains($val['DataHora'], "/")) {
                            echo "Check";
                          }
                          
                          ?> </option>
                        
                        <?php 
                          }
                        }
                        ?>
                      </select>
                    </div>
                    
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