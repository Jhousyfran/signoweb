<?php

namespace Signo\Http;
use \PDO;

// use App\Database\ConexaoBD;

class Model {
    
    //Atributos necessarios
    protected $table;        #Nome da tabela
    protected $primaryKey;   #Chave primaria da tabela
    protected $data;
    
    ####### SUJEITO A MODIFICAÇÕES

    public function __construct(){
        $this->setPDO();
    }

    private $_pdo;
    private function setPDO(){
        $config_file = RAIZ.'/env.ini';
        
        #Uma verificação simples para saber se o arquivo foi carregado, se não, é lançado uma exceção
        $config = parse_ini_file($config_file,TRUE);
        if(!$config)
            throw new \Exception('Não foi possivel ler '.$config.'.');

        $db = $config['database'];
        try {
            $this->_pdo = new PDO("mysql:host={$db['host']};port={$db['port']};dbname={$db['name']}", $db['user'], $db['password']);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    
    
    /**
    * Este é o método para INSERT
    * armazena o objeto na tabela
    */
    public function save(array $columns_and_values)
    {
        $columns = array_keys($columns_and_values);
        $values_array = array_values($columns_and_values);

        $insert_campos = implode(",", $columns);
        $insert_values = implode("','", $values_array);

        try {
            $insert = $this->_pdo->prepare("INSERT INTO {$this->table} ({$insert_campos}) VALUES ('{$insert_values}')");
            if($insert->execute()) return $this->_pdo->lastInsertId();
        } catch (Exception $e) {
            return print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. <br>".$e->getCode() . " Mensagem: " . $e->getMessage();
        }
    }
            
    public function update(array $columns_and_values, $id, $column = false)
    {   
        $sql_text_array = array();
        foreach($columns_and_values as $column =>$value){
            array_push($sql_text_array, "{$column}= '{$value}'");
        }

        $sql_text = implode(",", $sql_text_array);

        // try {
            if($column){
                $update = $this->_pdo->prepare("UPDATE {$this->table} SET {$sql_text} WHERE {$column} = {$id}");                
            }else{
                $update = $this->_pdo->prepare("UPDATE {$this->table} SET {$sql_text} WHERE {$this->primaryKey} = {$id}");
            }
            // $sql = "INSERT INTO $this->table ($insert_campos) VALUES ('$insert_values')";        
            return $update->execute();
        // } catch (Exception $e) {
            // return print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. <br>".$e->getCode() . " Mensagem: " . $e->getMessage();
        // }
    }
    
    public function delete($id, $columnDoDelete){
         try {
            if($columnDoDelete){
                $sql = "DELETE FROM {$this->table} WHERE {$columnDoDelete} = {$id};";
            }else{
                $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = {$id};";
            }
            $delete = $this->_pdo->query($sql);
            // print_r($result);
            return $delete;
        } catch(PDOException $e ){
            return print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. <br>".$e->getCode() . " Mensagem: " . $e->getMessage();            
        }
            return false;
    }


        
    public function find($id){
        try {
            $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey}={$id};";
            $find = $this->_pdo->prepare($sql);
            $find->execute();
            $result = $find->fetch();
            // print_r($result);
            return $result;
        } catch(PDOException $e ){
            return print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. <br>".$e->getCode() . " Mensagem: " . $e->getMessage();            
        }
        
    }
    
    public  function all(){
        try {
            $sql = "SELECT * FROM {$this->table};";
            $all = $this->_pdo->query($sql);
            $result = $all->fetchAll(\PDO::FETCH_CLASS);
            // print_r($result);
            return $result;
        } catch(PDOException $e ){
            return print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. <br>".$e->getCode() . " Mensagem: " . $e->getMessage();            
        }
    }

    public function where($column, $value){
        try {
            $sql = "SELECT * FROM {$this->table} WHERE {$column}={$value};";
            $find = $this->_pdo->prepare($sql);
            $find->execute();
            $result = $find->fetchall();
            // print_r($result);
            return $result;
        } catch(PDOException $e ){
            return print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. <br>".$e->getCode() . " Mensagem: " . $e->getMessage();            
        }
    }

    public function count($column = false, $value = false){
        try {
            if(!$column && !$value){
                $sql = "SELECT COUNT(*) FROM {$this->table}";                
            }else{
                $sql = "SELECT COUNT(*) FROM {$this->table} WHERE {$column} = {$value}";                
            }
            $total = $this->_pdo->query($sql);
            $total->execute();
            $result = $total->fetch();
        } catch(PDOExecption $e ){
            return print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. <br>".$e->getCode() . " Mensagem: " . $e->getMessage();                        
        }

        return $result;
    }

    
}