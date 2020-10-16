<?php
class UserDAO{
    
    private static $db;

    static function init()
    {
        //initailize the PDO Agent for our DAO class
        try{
            self::$db = new PDOAgent("User");

        }catch(Exception $ex){
            echo $ex->getMessage();
            error_log("ERROR: ".date("F j, Y, g:i a ").": ".$ex->getMessage()."\r\n", 3, "logs/errorLog.txt");
        }
    }

    static function getUser($userName)  {
        
        //Query!
        $sqlQuery = "SELECT * FROM Users where UserID =:UserID;";
        self::$db->query($sqlQuery);
        //Bind!
        self::$db->bind(':UserID',$userName);
        //Execute!
        self::$db->execute();
        //Return the reuslts!
        return self::$db->singleResult();
        

    }

    static function checkUserorAdmin($id)
    {
        $sqlQuery = "SELECT * FROM Users where UserID =:UserID;";
        self::$db->query($sqlQuery);
        //Bind!
        self::$db->bind(':UserID',$id);
        //Execute!
        self::$db->execute();
        //Return the reuslts!
        return self::$db->singleResult();
    }

    static function getUsers():array  {
        
        //Query!
        $sqlQuery = "SELECT * FROM Users;";
        self::$db->query($sqlQuery);
        //Execute!
        self::$db->execute();
        //Return the reuslts!
        return self::$db->getResultSet();
        

    }

    static function deleteUser($id)
    {
        $sqlQuery ="DELETE FROM Users where UserID =:UserID;";
        self::$db->query($sqlQuery);
        self::$db->bind(':UserID',$id);
        self::$db->execute();
    }

    static function updateUser($id)
    {
        $sqlQuery ="UPDATE Users set UserPassword = :UserPassword, UserStatus=:UserStatus where UserID =:UserID;";
        self::$db->query($sqlQuery);
        self::$db->bind(':UserID',$id);
        self::$db->bind(':UserPassword',$_POST['password']);
        self::$db->bind(':UserStatus',$_POST['status']);
        self::$db->execute();
    }

    static function addUser(User $user)
    {
        $sqlQuery ="INSERT INTO Users(UserID, UserPassword, UserStatus) VALUES(:UserID, :UserPassword, :UserStatus);";
        self::$db->query($sqlQuery);
        self::$db->bind(':UserID',$user->getUserID());
        self::$db->bind(':UserPassword',$user->getUserPassword());
        self::$db->bind(':UserStatus',$user->getUserStatus());
        self::$db->execute();
    }
   
}

?>