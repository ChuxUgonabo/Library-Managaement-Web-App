<?php
class IssuedBookDAO{
    
    private static $db;

    static function init()
    {
        //initailize the PDO Agent for our DAO class
        try{
            self::$db = new PDOAgent("IssuedBook");

        }catch(Exception $ex){
            echo $ex->getMessage();
            error_log("ERROR: ".date("F j, Y, g:i a ").": ".$ex->getMessage()."\r\n", 3, "logs/errorLog.txt");
        }
    }

    static function insertBook($bookid, $custid, $date)
    {
        $sqlQuery = "INSERT INTO IssuedBooks (Books_ISBN, CustomerID, dateTime) VALUES(:Books_ISBN, :CustomerID, :dateTime);";
        self::$db->query($sqlQuery);
        self::$db->bind(':Books_ISBN',$bookid);
        self::$db->bind(':CustomerID',$custid);
        self::$db->bind(':dateTime',$date);
        self::$db->execute();
    }
   
    static function selectBook($BookISBN){
        
        
            $sqlBook = "SELECT * FROM IssuedBooks WHERE Books_ISBN = :Books_ISBN;";
            self::$db->query($sqlBook);
            self::$db->bind(':Books_ISBN', $BookISBN);
            self::$db->execute();
        if(self::$db->singleResult() == null)
        {
            return false;
        }
        else
        {
            return self::$db->singleResult();
        }

    }
    
    static function deleteBook($BookISBN) {
        
        $sqlDelete = "DELETE FROM IssuedBooks WHERE Books_ISBN = :Books_ISBN;";
        self::$db->query($sqlDelete);
        self::$db->bind(':Books_ISBN', $BookISBN);
        self::$db->execute();
    }

    
}

?>