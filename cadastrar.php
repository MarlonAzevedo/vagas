<?php

    require __DIR__.'/vendor/autoload.php';

    define('TITLE','Cadastrar Vaga');
    
    use \App\Entity\Vaga;
    $objVaga = new Vaga;
    //validação do post
    if(isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])){
        $objVaga = new Vaga;
        $objVaga -> titulo = $_POST['titulo'];
        $objVaga -> descricao = $_POST['descricao'];
        $objVaga -> ativo = $_POST['ativo'];
        $objVaga->cadastrar();

        // echo "<pre>"; print_r($objVaga);echo "</pre>";exit;

        header('location: index.php?status=success');
        exit;
    } 
    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/formularios.php';
    include __DIR__.'/includes/footer.php';
    
?>