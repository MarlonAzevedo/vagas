<?php 
    $mensagem = '';
    if(isset($_GET['status'])){
        switch($_GET['status']){
            case 'success':
                $mensagem .='<div class="alert alert-success">Ação executada com Sucesso!!!</div>';
            break;
            
            case 'error':
                $mensagem .='<div class="alert alert-danger">Erro ao executar a Ação!!!</div>';
            break;
        }

    }

    $resultados ='';
    foreach($vagas as $vaga){
        $resultados .= '<tr>
                            <td>'.$vaga->id.'</td>
                            <td>'.$vaga->titulo.'</td>
                            <td>'.$vaga->descricao.'</td>
                            <td>'.($vaga->ativo == 's' ? 'Ativo' : 'Inativo').'</td>
                            <td>'.date('d/m/Y à\s H:i:s',strtotime($vaga->data)).'</td>
                            <td>
                                <a href="editar.php?id='.$vaga->id.'">
                                    <button type="button" class="btn btn-primary">Editar</button>
                                </a>
                                <a href="excluir.php?id='.$vaga->id.'">
                                    <button type="button" class="btn btn-danger">Excluir</button>
                                </a>
                            </td>
                        </tr>';
    }
    $resultados = strlen($resultados) ? $resultados : '<tr>
                                                            <td colspan="6" class="text-center">
                                                                Nenhuma vaga encontrada!
                                                            </td>
                                                       </tr>';
    
    unset($_GET['status']);
    unset($_GET['pagina']);
    $gets = http_build_query($_GET);
    //paginação
    $paginacao = '';
    $paginas = $obPaginacao->getPages();
    foreach($paginas as $key=>$pagina)
    {
        $class = $pagina['atual'] ? 'btn-primary' : 'btn-light';
        $paginacao .= '<a href="?pagina='.$pagina['pagina'].'&'.$gets.'">
                            <button type="button" class="btn '.$class.'">'.$pagina['pagina'].'</button>
                        </a>';
    }

?>
<main>
    <?=$mensagem?>
    <section>
        <a href="cadastrar.php">
            <button class="btn btn-success">Nova Vaga</button>
        </a>
    </section>
    <section>
        <form method="get">
            <div class="row mt-4">
                <div class="col">
                    <label>Buscar por titulo</label>
                    <input type="text" name="busca" class="form-control" value="<?=$busca?>">
                </div>
                <div class="col">
                    <label>Status</label>
                    <select name="filtroStatus"class="form-control">
                        <option value="">Ativo/Inativo</option>
                        <option value="s" <?=$filtroStatus=='s'? 'selected' : ''?>>Ativo</option>
                        <option value="n" <?=$filtroStatus=='n'? 'selected' : ''?>>Inativo</option>
                    </select>
                </div>
                <div class="col d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>
    </section>
    <section>
        <table class="table  mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?=$resultados?>
            </tbody>
        </table>
    </section>
    <section>
        <?=$paginacao?>
    </section>
</main>