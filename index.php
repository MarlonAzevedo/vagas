<?php

    require __DIR__.'/vendor/autoload.php';

    use \App\Entity\Vaga;
    use \App\Db\Pagination;

    // filtrando buscas
    $busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);

    $filtroStatus = filter_input(INPUT_GET, 'filtroStatus', FILTER_SANITIZE_STRING);
    $filtroStatus = in_array($filtroStatus,['s','n']) ? $filtroStatus : '';

    //condições da busca
    $condicoes = [
        strlen($busca) ? 'titulo LIKE "%'.str_replace(' ','%',$busca).'%"' : null,
        strlen($filtroStatus) ? 'ativo = "'.$filtroStatus.'"' : null
    ];

    //retira espaços vagos dentro da array
    $condicoes = array_filter($condicoes);
    $where = implode(' AND ', $condicoes);

    //quantidade todal de vagas
    $quantidadeVagas = Vaga::getQuantidadeVagas($where);

    $obPaginacao = new Pagination($quantidadeVagas, $_GET['pagina'] ?? 1, 5);

    // echo "<pre>";
    // print_r($obPaginacao);
    // echo "</pre>";
    // exit;

    $vagas = Vaga::getVagas($where,null,$obPaginacao->getLimit());
    
    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listagem.php';
    include __DIR__.'/includes/footer.php';
    
?>