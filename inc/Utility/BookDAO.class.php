<?php
class BookDAO{
    
    private static $db;

    static function init()
    {
        //initailize the PDO Agent for our DAO class
        try{
            self::$db = new PDOAgent("Book");

        }catch(Exception $ex){
            echo $ex->getMessage();
            error_log("ERROR: ".date("F j, Y, g:i a ").": ".$ex->getMessage()."\r\n", 3, "logs/errorLog.txt");

        }
    }

    static function getBook($id)
    {
        $sqlQuery = "SELECT * FROM Books where Books_ISBN = :Books_ISBN;";

        self::$db->query($sqlQuery);
        self::$db->bind(':Books_ISBN',$id);
        self::$db->execute();

        return self::$db->singleResult();
    }

    static function getBooks($bookname): array
    {
        $sqlQuery = "SELECT * FROM Books where Name LIKE :Name AND IssuedBookFlag = :flag;";

        self::$db->query($sqlQuery);
        self::$db->bind(':Name',$bookname."%");
        self::$db->bind(':flag',0);
        self::$db->execute();

        return self::$db->getResultSet();
    }
   
    
    
    static function getBooksByAuthor($author): array
    {
        $sqlQuery = "SELECT * FROM Books where Author LIKE :Author AND IssuedBookFlag = :flag;";

        self::$db->query($sqlQuery);
        self::$db->bind(':Author',$author."%");
        self::$db->bind(':flag',0);
        self::$db->execute();

        return self::$db->getResultSet();
    }

    static function updateBooks($id)
    {
        $sqlQuery = "UPDATE Books SET IssuedBookFlag = :IssuedBookFlag where Books_ISBN = :Books_ISBN;";
        self::$db->query($sqlQuery);
        self::$db->bind(':Books_ISBN',$id);
        self::$db->bind(':IssuedBookFlag',1);
        self::$db->execute();
    }

    static function updateIssuedBook(Book $book) {

        $sqlUpdate = "UPDATE Books SET IssuedBookFlag=:IssuedBookFlag, ReturnBookCount = :ReturnBookCount WHERE Books_ISBN = :Books_ISBN;";

        self::$db->query($sqlUpdate);

        self::$db->bind(':Books_ISBN', $book->getBooksISBN());
        self::$db->bind(':IssuedBookFlag', 0);
        self::$db->bind(':ReturnBookCount',  ($book->getReturnBookCount()+1) );

        self::$db->execute();
    }

    
    static function getIssuedBooks(): array
    {
        $sqlQuery = "SELECT * FROM Books where IssuedBookFlag = :flag;";

        self::$db->query($sqlQuery);
        self::$db->bind(':flag',1);
        self::$db->execute();

        return self::$db->getResultSet();
    }

    static function getIssuedBooksForSpecificUser($custId): array
    {
        $sqlQuery = "SELECT * FROM Books where Books_ISBN IN 
        (select Books_ISBN from issuedbooks where CustomerID = :CustomerID);";

        self::$db->query($sqlQuery);
        self::$db->bind(':CustomerID',$custId);
        self::$db->execute();

        return self::$db->getResultSet();
    }

    static function listBooks(): array
    {
        $sqlQuery = "SELECT * FROM Books;";

        //query
        self::$db->query($sqlQuery);
        
        //execute
        self::$db->execute();

        //return resultset
        return self::$db->getResultSet();
    }   

    static function deleteBook($id)
    {
        $sqlQuery ="DELETE FROM Books where Books_ISBN =:Books_ISBN AND IssuedBookFlag=:IssuedBookFlag";
        self::$db->query($sqlQuery);
        self::$db->bind(':Books_ISBN',$id);        
        self::$db->bind(':IssuedBookFlag',0);
        self::$db->execute();

        if(self::$db->rowCount() <= 0)
        {
            return false;
        }
        else
        {
            return true;
        }

    }

    static function createBook(Book $nb)    {

        $sqlInsert = "INSERT INTO Books (Books_ISBN,Name,Author,Publisher,IssuedBookFlag,ReturnBookCount)
        VALUES(:Books_ISBN, :Name, :Author, :Publisher, :IssuedBookFlag, :ReturnBookCount);";
    
        //Query!
        self::$db->query($sqlInsert);
    
        //Bind!
    
        self::$db->bind(':Books_ISBN', $nb->getBooksISBN());
        self::$db->bind(':Name', $nb->getName());
        self::$db->bind(':Author', $nb->getAuthor());
        self::$db->bind(':Publisher', $nb->getPublisher());
        self::$db->bind(':IssuedBookFlag', $nb->getIssuedBookFlag());
        self::$db->bind(':ReturnBookCount', $nb->getReturnBookCount());
    
        //Execute
        self::$db->execute();
    
    }
}

?>