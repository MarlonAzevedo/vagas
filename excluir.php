<?php

    require __DIR__.'/vendor/autoload.php';
    use \App\Entity\Vaga;

    if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
        header('location: index.php?status=error');
        exit;
    }

    $objVaga = Vaga::getVaga($_GET['id']);

    if(!$objVaga instanceof Vaga){
        header('location: index.php?status=error');
        exit;
    }


    if(isset($_POST['excluir'])){
        
        $objVaga->excluir();
        header('location: index.php?status=success');
        exit;
    } 
    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/confirma-excluir.php';
    include __DIR__.'/includes/footer.php';
    
?>