<?php

class User
{
    private $UserID;
    private $UserPassword;
    private $UserStatus = 0;
  

    //getters
    function getUserID() : int
    {
        return $this->UserID;
    }
    function getUserPassword(): string
    {
        return $this->UserPassword;
    }
    function getUserStatus(): int
    {
        return $this->UserStatus;
    }

    //setters

    function setUserID($newUserID)
    {
        $this->UserID = $newUserID;
    }
    
    function setUserPassword($newUserPassword)
    {
        $this->UserPassword = $newUserPassword;
    }
    function setUserStatus($newUserStatus)
    {
        $this->userStatus = $newUserStatus;
    }


    function verifyPassword(string $passwordToVerify) {
        //Return a boolean based on verifying if the password given is correct for the current user
        if( password_verify($passwordToVerify, $this->password))
        {
            return true;
        }
        else{
            return false;
        }
        
    }

}
?>