<?php
class ReviewDAO{
    
    private static $db;

    static function init()
    {
        //initailize the PDO Agent for our DAO class
        try{
            self::$db = new PDOAgent("Review");

        }catch(Exception $ex){
            echo $ex->getMessage();
            error_log("ERROR: ".date("F j, Y, g:i a ").": ".$ex->getMessage()."\r\n", 3, "logs/errorLog.txt");
        }
    }

    
    static function getReviews(): array
    {
        $sqlQuery = "SELECT * FROM Review;";

        self::$db->query($sqlQuery);
       
        self::$db->execute();

        return self::$db->getResultSet();
    }

    static function getReview($bookid)
    {
        $sqlQuery = "SELECT * FROM Review where BookISBN =:BookISBN;";

        self::$db->query($sqlQuery);
        self::$db->bind(':BookISBN',$bookid);
        self::$db->execute();

        return self::$db->singleResult();
    }
    
}

?>