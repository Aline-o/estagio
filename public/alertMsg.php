<?php
    if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="un"){
        echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Preencha todos os campos obrigatórios!</div>';
    }elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){
        echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Adicionado com sucesso!</div>';
    }elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rds"){
        echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Deletado com sucesso!</div>';
    }elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rus"){
        echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Atualizado com sucesso!</div>';
    }elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rnu"){
        echo	'<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Você não fez nenhuma alteração!</div>';
    }elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){
        echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> There is some thing wrong <strong>Please try again!</strong></div>';
    }
?>