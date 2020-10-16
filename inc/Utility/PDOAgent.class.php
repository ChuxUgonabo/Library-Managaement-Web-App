<?php

class PDOAgent {
    //connection details 
    private $host =DB_HOST;
    private $dbname = DB_NAME;
    private $user = DB_USER;
    private $password= DB_PASSWORD;


    private $dsn = ""; //data source name
    private $className = ""; // Name of the class we are mapping with the PDO Agent
    private $error = ""; //store any error messages
    private $stmt = ""; // stores the statment instance
    private $pdo = ""; // store the local instatntiation of the PDO

    public function __construct(string $className){
        //store the local class name;
        $this->className = $className;
        //Build the dsn
        $this->dsn = 'mysql:host='.$this->host. ';dbname=' .$this->dbname;
        //set PDO options
        $options = array(
            PDO::ATTR_PERSISTENT => True,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try{
            //instatiate the PDO library inside our wrapper class
            $this->pdo = new PDO($this->dsn, $this->user, $this->password, $options);
        }catch(Exception $ex)
        {
            $this->error = $ex->getMessage();
        }
    }
    //preapre the statement for execution 
    public function query(string $query){
        $this->stmt = $this->pdo->prepare($query);
    }

    //bind the values, select
    public function bind($param, $value, $type = null){  
        if (is_null($type)) {  
            switch (true) {  
                case is_int($value):  
                $type = PDO::PARAM_INT;  
                break;  
                case is_bool($value):  
                $type = PDO::PARAM_BOOL;  
                break;  
                case is_null($value):  
                $type = PDO::PARAM_NULL;  
                break;  
                default:  
                $type = PDO::PARAM_STR;  
            }  
        }  
        $this->stmt->bindValue($param, $value, $type);  
    } 
    
    //execute the statment
    public function execute($data= null){
        if(is_null($data)){
            return $this->stmt->execute();

        }else{
            return $this->stmt->execute($data);
        }
    }

    //return a single result
    public function singleResult(){
        //execute the statement
        $this->stmt->execute();
        //set the fetch mode
        $this->stmt->setFetchMode(PDO::FETCH_CLASS, $this->className);
        //return the result
        return $this->stmt->fetch(PDO::FETCH_CLASS);

    }

    //return multiple results

    public function getResultSet(){
        //execute the statements
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_CLASS, $this->className);


    }

    public function rowCount() : int
    {
        return $this->stmt->rowCount();
    }

    public function lastInsertedId() : int{
        return $this->pdo->lastInsertedId();
    }

    
}

?>