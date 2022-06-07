<?php
    require __DIR__.'/vendor/autoload.php';

    
    use \App\Entity\Vaga;
    use \App\Db\Pagination;




    //busca
    $busca= filter_input(INPUT_GET,'busca',FILTER_SANITIZE_STRING);

    //filtro status
    $filtroStatus = filter_input(INPUT_GET,'status',FILTER_SANITIZE_STRING);

    $filtroStatus = in_array($filtroStatus,['s','n']) ? $filtroStatus : '';

    //condiçoes sql
    $condicoes = [
        strlen($busca) ? 'titulo LIKE "%'.str_replace(' ','%',$busca).'%"' : null,
        strlen($filtroStatus) ? 'ativo = "'.$filtroStatus.'"' : null
    ];

    //remove posiçoes vazias na query
    $condicoes = array_filter($condicoes);

    //Clausula where
    $where = implode(' AND ',$condicoes);
    

    //Paginação
    $obPagination = new Pagination();

    $vagas = Vaga::getVagas($where);

    
    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listagem.php';
    include __DIR__.'/includes/footer.php';