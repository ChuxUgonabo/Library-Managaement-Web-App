<?php
require_once("inc/Entities/User.class.php");

class Validation
{

    public static $error="";    
    public static function validate()
    {
        if(empty($_POST["username"]))
        {
            self::$error .= "User Name cannot be blank.<br>";            
        }
        if(empty($_POST["password"]))
        {
            self::$error .= "Password cannot be blank.<br>";            
        }
    }

    public static function validateUserInfo($user)
    {
        if($user instanceof User)
        {
            //Check the password
            if (strcmp($user->getUserPassword(), $_POST['password'] ) == 0)
            {  
                return true;                         
            }
            
        }
        self::$error="User name or password incorrect<br>Try Again!";
        return false;
    }

    public static function ValidateUsername()
    {
        if(filter_var($_POST['username'], FILTER_VALIDATE_INT) == false)
        {
            self::$error.="User name not found in database!";
            return false;
            
        }
        else
        {
            return true;
        }
        
    }

    static function checkIssueForm()
    {
        if(empty($_POST['searchitem']))
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    static function checkaddBook()
    {
        if(empty($_POST["bISBN"]))
        {
            self::$error .= "Book ISBN is empty!<br>";
        }
        if(empty($_POST["name"]))
        {
            self::$error .= "Name field is empty!<br>";
        }
        if(empty($_POST["author"]))
        {
            self::$error .= "Author field is empty!<br>";
            
        }
        if(empty($_POST["publisher"]))
        {
            self::$error .= "Publisher field is empty!";
        }

        return self::$error;

    }

    static function checkUser()
    {
        if(isset($_POST['username']) && empty($_POST['username']))
        {
            self::$error .= "UserId is empty<br>";
        }
        if(isset($_POST['password']) && empty($_POST['password']))
        {
            self::$error .= "User Password is empty<br>";
        }
        if(isset($_POST['status']) && ($_POST['status']) == "")
        {
            self::$error .= "User Status is empty<br>";
        }
        if(filter_var($_POST['username'], FILTER_VALIDATE_INT) == false)
        {
            self::$error .= "UserId should be an integer<br>";
        }
        if((filter_var($_POST['status'], FILTER_VALIDATE_INT) == false) && ($_POST['status'] == ""))
        {
            self::$error .= "User Status should be an integer<br>";
        }

        return self::$error;
    }

}
?>