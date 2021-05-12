<?php
  include_once('../../public/config.php');
 if(isset($_POST["Import"])){
    
    $filename=$_FILES["file"]["tmp_name"];    
     if($_FILES["file"]["size"] > 0)
     {
        $file = fopen($filename, "r");
          while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
           {
             /* campos da tabela consumo:
              * idConsumo => $getData[0]
              * Aluno_Matricula => $getData[1]
              * Cardapio_idCardapio => $getData[2]
              * ValorCobrado [aqui recebe o idCardapio para facilitar a busca 
              do Valor na tabela cardapio. Registrar Valor]
              * DataHora
              * Periodo [aqui recebe somente horario, compara com ifelse de
               horainicio e horafim da tabela turno. Registrar NomeTurno]
              * Status
              */

              $idcardapio = $getData[3]; //valor
              $condition	=	'';
              $condition	.=	' AND idCardapio LIKE "%'.$idcardapio.'%" ';
              $cardapioDados	=	$db->getAllRecords('cardapio','idCardapio, Valor',$condition,'ORDER BY idCardapio DESC');
              $getData[3] = $cardapioDados[0]['Valor'];

              $periodo = $getData[5]; //periodo
              $turnoDados	=	$db->getAllRecords('turno','*',' AND Status = 1 ','ORDER BY idTurno DESC');
              /* cardapio nao tem erro pq a busca eh feita com o id, mas o turno pode ocorrer erro se 
              houver algum turno "apagado" para o user, mas com registro no Banco...
              Portanto, é importante que ele apenas considere os turnos ativos, vulgo status 1.
              */
              foreach($turnoDados as $val){
                $h_Inicio = $val['HoraInicio'];
                $h_Fim = $val['HoraFim'];
                if($periodo>=$h_Inicio && $periodo<=$h_Fim){
                  if(strcasecmp($val['NomeTurno'],"integral")){ //If this function returns 0, the two strings are equal.
                    $getData[5] = $val['NomeTurno'];
                  }
                }
              }
              if($periodo==$getData[5]){//caso nao tenha turnos correspondentes
                $getData[5] = 'Indefinido ('.$getData[5].')';
              }

              $data	=	array(
                  'Aluno_Matricula'=> $getData[1], //colunas
                  'Cardapio_idCardapio'=> $getData[2],                       
                  'ValorCobrado'=> $getData[3],                       
                  'DataHora'=> $getData[4],                       
                  'Periodo'=> $getData[5],                       
                  'Status'=> $getData[6],                       
              );
              $insert	=	$db->insert('consumo',$data);

              if(!isset($insert))
              {
                echo "<script type=\"text/javascript\">
                alert(\"Arquivo Inválido:Por favor, envie um arquivo CSV.\");
                window.location = \"arquivo.blade.php\"
                </script>";    
              }
              else {
                echo "<script type=\"text/javascript\">
                alert(\"Arquivo CSV importado com successo.\");
                window.location = \"arquivo.blade.php\"
                </script>";
              }
           }
      
           fclose($file);  
     }
  }   

?>