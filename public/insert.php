<?php
$nomeAluno = $_POST['nomealuno'];
$nascimentoAluno = $_POST['nascimentoaluno'];
//$patologia = $_POST['patologia'];

//$nomeCardapio = $_POST['nomecardapio'];
//$siglaCardapio = $_POST['siglacardapio'];
//$descricaoCardapio = $_POST['descricaocardapio'];
//$valorCardapio = $_POST['valorcardapio'];

$nomeEscola = $_POST['nomeescola'];

$nomeModalidade = $_POST['nomemodalidade'];
$siglaModalidade = $_POST['siglamodalidade'];

$nomeNivelEnsino = $_POST['nomenivelensino'];

//$descricaoPatologia = $_POST['descricaopatologia'];
//$grupoPatologia = $_POST['grupopatologia'];

//$perfilTitulo = $_POST['perfiltitulo'];

$nomeSerie = $_POST['nomeserie'];

$nomeTurma = $_POST['nometurma'];
$anoTurma = $_POST['anoturma'];

$nomeTurno = $_POST['nometurno'];
$horaInicio = $_POST['horainicio'];
$horaFim = $_POST['horafim'];

//$usuarioCpf = $_POST['usuariocpf'];
//$usuarioLogin = $_POST['usuariologin'];
//$usuarioSenha = $_POST['usuariosenha'];

if(!empty($nomeAluno) || !empty($nascimentoAluno) ||
 !empty($nomeEscola) ||
 !empty($nomeModalidade) || !empty($siglaModalidade) ||
 !empty($nomeNivelEnsino) ||
 !empty($nomeSerie) ||
 !empty($nomeTurma) || !empty($anoTurma) ||
 !empty($nomeTurno) || !empty($horaInicio) || !empty($horaFim)){

    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "MerendaPrefeitura";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if(mysqli_connect_error()){
        die('err de conexao '.mysqli_connect_errno().'eeee'.mysqli_connect_error());
    } else {

        if(!empty($nomeAluno) || !empty($nascimentoAluno)){
            $INSERT = "INSERT Into aluno (Nome, DataNascimento) values(?,?)";

            $statement = $conn->prepare($INSERT);
            $statement->bind_param("ss", $nomeAluno, $nascimentoAluno);
            $statement->execute();
            header("Location: ../resources/views/confirma.blade.php");
        } 
        if(!empty($nomeEscola)){
            $INSERT = "INSERT Into escola (NomeEscola) values(?)";

            $statement = $conn->prepare($INSERT);
            $statement->bind_param("s", $nomeEscola);
            $statement->execute();
            header("Location: ../resources/views/confirma.blade.php");
        }
        if(!empty($nomeModalidade) || !empty($siglaModalidade)){
            $INSERT = "INSERT Into modalidadeensino (NomeModalidadelEnsino, Sigla) values(?,?)";

            $statement = $conn->prepare($INSERT);
            $statement->bind_param("ss", $nomeModalidade, $siglaModalidade);
            $statement->execute();
            header("Location: ../resources/views/confirma.blade.php");
        }
        if(!empty($nomeNivelEnsino)){
            $INSERT = "INSERT Into nivelensino (NomeNivelEnsino) values(?)";

            $statement = $conn->prepare($INSERT);
            $statement->bind_param("s", $nomeNivelEnsino);
            $statement->execute();
            header("Location: ../resources/views/confirma.blade.php");
        }
        if(!empty($nomeSerie)){
            $INSERT = "INSERT Into serie (NomeSerie) values(?)";

            $statement = $conn->prepare($INSERT);
            $statement->bind_param("s", $nomeSerie);
            $statement->execute();
            header("Location: ../resources/views/visualizar.blade.php");
        }
        if(!empty($nomeTurma) || !empty($anoTurma)){
            $INSERT = "INSERT Into turma (NomeTurma, Ano) values(?,?)";

            $statement = $conn->prepare($INSERT);
            $statement->bind_param("ss", $nomeTurma, $anoTurma);
            $statement->execute();
            header("Location: ../resources/views/confirma.blade.php");
        } 
        if(!empty($nomeTurno) || !empty($horaInicio) || !empty($horaFim)){
            $INSERT = "INSERT Into turno (NomeTurno, HoraInicio, HoraFim) values(?,?,?)";

            $statement = $conn->prepare($INSERT);
            $statement->bind_param("sss", $nomeTurno, $horaInicio, $horaFim);
            $statement->execute();
            header("Location: ../resources/views/confirma.blade.php");
        } 
    }
    $statement->close();
    $conn->close();   
}else {
            echo "Nenhum dado foi inserido! Volte para a página e preencha os campos necessários!";
            die();
        }


    
?>