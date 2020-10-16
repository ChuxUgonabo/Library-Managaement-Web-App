<?php

class LoginManager  {

    //This function checks if the user is logged in, if they are not they are redirected to the login page
    static function verifyLogin()   {

        //Check for a session
       
        if(!isset($_SESSION))
        {
            session_start();
        }
        
        if(isset($_SESSION['username']) && isset($_SESSION['password']))
        {
            return true;
        }

    

        else {

            //The user is not logged in
            //Destroy any session just in case
            session_destroy();
            //Send them back to the login pages
            
            header("Location: ../main.php?action=");
            return false;

        }
    }
        
    
}

?>