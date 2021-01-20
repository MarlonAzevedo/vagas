<?php

namespace App\Db;

class Pagination{
    //numero maximo de registros por pagina
    private $limits;
    // quantidade total de resultados do banco de dados
    private $resultados;
    //quantidade de paginas
    private $paginas;
    //pagina atual
    private $paginaAtual;

    public function __construct($resultados,$paginaAtual = 1,$limits = 5)
    {
        $this->resultados = $resultados;
        $this->limits = $limits;
        $this->paginaAtual = (is_numeric($paginaAtual) and $paginaAtual > 0) ? $paginaAtual : 1;
        $this->calculate();
    }
    private function calculate(){
        // calcula o total de paginas
        $this->paginas = $this-> resultados > 0 ? (ceil($this->resultados / $this->limits)) : 1;
        //verifica se a pagina atual nao ultrapassa o numero de paginas
        $this->paginaAtual = $this->paginaAtual<= $this->paginas ? $this->paginaAtual : $this->paginas;
    }
    public function getLimit(){
        $offset = ($this->limits * ($this->paginaAtual -1));
        return $offset.','.$this->limits;
    }
    public function getPages(){
        if($this->paginas ==1) return [];

        $paginas = [];
        for($i = 1;$i <= $this->paginas; $i++)
        {
            $paginas[] = [
                'pagina' => $i,
                'atual' => $i == $this->paginaAtual
            ];
        }
        return $paginas;
    }

}