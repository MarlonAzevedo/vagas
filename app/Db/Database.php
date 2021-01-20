<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database{
    const HOST = 'localhost';
    const NAME = 'vagas';
    const USER = 'root';
    const PASS = '';

    private $tabela;
    private $connection;

    public function __construct($tabela=null){
        $this->tabela = $tabela;
        $this->setConnection();
    }

    private function setConnection(){
        try{
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die ('ERROR: '.$e->getMessage());
        }
    }

    public function execute($query,$params=[]){
        try{
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        }catch(PDOException $e){
            die ('ERROR: '.$e->getMessage());
        }
    }

    public function insert($values){

        $fields = array_keys($values);
        $binds = array_pad([],count($fields),'?');
        
        $query = 'INSERT INTO '.$this->tabela.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';
        
        $this->execute($query,array_values($values));

        return $this->connection->lastInsertId();

    }
    public function select($where = null, $order = null, $limit = null, $fields = '*'){

        $where = strlen($where) ? 'WHERE '.$where : '' ;
        $order = strlen($order) ? 'ORDER BY '.$order : '' ;
        $limit = strlen($limit) ? 'LIMIT '.$limit : '' ;

        $query = 'SELECT '.$fields.' FROM '.$this->tabela.' ' .$where.' '.$order.' '.$limit;

        return $this->execute($query);
    }
    public function update($where,$values)
    {
        $fields = array_keys($values);
        $query =  'UPDATE '.$this->tabela.' SET '.implode('=?,',$fields).'=? WHERE '.$where; 
        $this->execute($query,array_values($values));
        return true;
    }
    public function delete($where)
    {
        $query = 'DELETE FROM '.$this->tabela.' WHERE '.$where;
        $this->execute($query);
        return true;
    }
}