<?php

namespace App\Db;
use \PDO;
use PDOException;

class Database{
    /**
     * host do banco de dados
     * @var string
     */
    const HOST = 'localhost';

    /**
     * Nome do banco de dados
     * @var string
     */
    const NAME = 'wdev_vagas';
     /**
     * Usuário do banco de dados
     * @var string
     */
    const USER = 'root';
     /**
     * Senha do banco de dados
     * @var string
     */
    const PASS = '';

    /**
     * Nome da tabela a ser manipulada
     * @var string
     */
    private $table;

    /**
     * Instancia de conexão de banco de dados
     * @var PDO
     */
    private $connection;

    /**
     * Define a tbale e instancia e conexão
     * @var PDO
     */
    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();      
    }

    /**
     * metodo reponsavel por criar uma conexao com o banco de dados
     */
    private function setConnection(){
        try{
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
        }catch(PDOException $e){
            die('ERRO: '.$e->getMessage());
        }
    }

    
    /**
     * Metoddo responsa´vel por executar queries dentro do banco de dados
     *
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query,$params = []){
        try{
            $statemant = $this->connection->prepare($query);
            $statemant ->execute($params);
            return $statemant;       
        }catch(PDOException $e){
            die('ERRO: '.$e->getMessage());
        }
     }

    /**
     * Metodo responsável para inserir no banco
     *
     * @param array $values
     * @return integer
     */
    public function insert($values){
        //dados da query
        $fields = array_keys($values);
        $binds = array_pad([],count($fields),'?');
        
        //monta a query
        $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES('.implode(',',$binds).')';

        $this->execute($query,array_values($values));

        //Retorna o id definido
        return$this->connection->lastInsertId();
    }


     /**
     * Metodo responsável por executar uma consulta no banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*'){
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';


        //Monta query
        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

        return $this->execute($query);
    }

    /**
     * Medoto responsável por executar atualizações no banco de dados
     *
     * @param string $where
     * @param array $values
     * @return boolean
     */
    public function update($where,$values){
        //dados da query
        $fields = array_keys($values);

        //Monta a query
        $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;

        //Executa a query
        $this->execute($query,array_values($values));

        //retorna sucesso
        return true;

    }

    /**
     * Método responsável para excluir dados no banco.
     *
     * @param string $where
     * @return boolean
     */
    public function delete($where)
    {
       
        //Monta a query
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;
        //echo $query;
        //Executa a query
        $this->execute($query);
        
        //exit;
        //retorna sucesso
        return true;
    }

}