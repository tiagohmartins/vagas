<?php

namespace App\Db;

class Pagination{

    /**
     * número máximo de registro por página
     *
     * @var integer
     */
    private $limit;

    /**
     * Quantidade total de resultados do banco
     *
     * @var integer
     */
    private $results;

    /**
     * Quantidade de paginas
     *
     * @var un
     */
    private $pages;

    /**
     * Pagina atual
     *
     * @var integer
     */
    private $currentPage;


    /**
     * Construtor da classe
     *
     * @param integer $results
     * @param integer $currentPage
     * @param integer $limit
     */
    public function __construct($results,$currentPage = 1, $limit = 10)
    {
        $this->results = $results;
        $this->limit = $limit;
        $this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;

    }

    /**
     * Metodo responsável por calcular a paginação
     *
     */
    private function calculate(){
        //cakcyka i titak de páginas
        $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

        //verifica se a pagina atual não excede o numero de paginas
        $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
    }

    

}