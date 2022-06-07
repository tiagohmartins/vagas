<?php

namespace App\Entity;

use App\Db\Database;
use \PDO;

class Vaga{
    /**
     * identificador unico da vaga
     * @var integer
     */
    public $id;

    /**
     * Titulo da vaga
     * @var string
     */
    public $titulo;

    /**
     * Descrição da vaga (pode conter html)
     * @var string
     */
    public $descricao;
    
    /**
     * Define se a vaga esta ativa
     * @var string(s/n)
     */
    public $ativo;

    /**
     * Data de publicação da vaga
     * @var string
     */
    public $data;


    /**
     * Método responsável por cadastrar uma nova vaga
     * @return boolean
     */
    public function cadastrar(){
        //DEFINIR A DATA
        $this->data = date('Y-m-d H:i:s');

        //INSERIR A VAGA NO BANCO
        $obDatabase =  new Database('vagas');
        $obDatabase->id=$obDatabase->insert([
                                                'titulo' => $this->titulo,
                                                'descricao' => $this->descricao,
                                                'ativo' => $this->ativo,
                                                'data' => $this->data
                                            ]);
        //retornar sucesso                                    
        return true;

    }

    /**
     * Metodo responsável para atualizar vaga no banco de dados
     *
     * @return boolean
     */
    public function atualizar(){
        return(new Database('vagas'))->update('id = '.$this->id,[
                                                                    'titulo' => $this->titulo,
                                                                    'descricao' => $this->descricao,
                                                                    'ativo' => $this->ativo,
                                                                    'data' => $this->data
                                                                ]);
    }

    /**
     * Metodo responsável por excluir a vaga do banco de dados
     *
     * @return Boolean
     */
    public function excluir()
    {
        return (new Database('vagas'))->delete('id = '.$this->id);
    }

    /**
     * Metodo responsável por obter as vagas do banco de dados
     * @param string
     * @param string
     * @param string
     * @return array
     */
    public static function getVagas($where = null, $order = null, $limit = null){
        return(new Database('vagas'))->select($where,$order,$limit)
                                     ->fetchAll(PDO::FETCH_CLASS,self::class);
    }       

    
    /**
     * Metodo responsável por buscar uma vaga com base no seu ID
     *
     * @param integer $id
     * @return Vaga
     */
    public static function getVaga($id){
        return(new Database('vagas'))->select('id = '.$id) 
                                     ->fetchObject(self::class);
    }


}

