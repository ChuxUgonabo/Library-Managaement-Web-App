<?php
require_once("inc/config.inc.php");
require_once("inc/Entities/Book.class.php");
require_once("inc/Entities/IssuedBook.class.php");
require_once("inc/Entities/User.class.php");
require_once("inc/Entities/Review.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/BookDAO.class.php");
require_once("inc/Utility/IssuedBookDAO.class.php");
require_once("inc/Utility/UserDAO.class.php");
require_once("inc/Utility/ReviewDAO.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/RestClient.class.php");
require_once("inc/Utility/Page.class.php");
require_once("inc/Utility/Validation.class.php");
$action = isset($_GET['action'])? $_GET['action']: "";

switch($action)
{
    case "loginCheck":         loginCheck();
                               break;
    case "adminentry":         adminentrypage();
                               break;
    case "logout" :            logout();
                               break;
    case "itemselected":       borrow();
                               break;
    case "userhome":           userhome();
                               break;
    case "searchbookorauthor": searchbookorauthor();
                               break;
    case "review":             review();
                               break;
    case "returnbook":         returnBook();
                               break;
    case "userconfirmreturn" : confirmReturn();
                               break;
    case "deletebook":         deleteBook();
                               break;
    case "addbookform":        addBookForm();
                               break;
    case "managebook":         manageBook();
                               break;
    case "addbook":            addBook();
                               break;
    case "deleteuser":         deleteUser();
                               break;
    case "edituser":           editUser();
                               break;
    case "manageuser":         manageUser();
                               break;
    case "updateuser":         updateUser();
                               break;
    case "adduserform":        addUserForm();
                               break;
    case "adduser":            addUser();
                               break;
    default : homepage();
              break;
}

function homepage()
{
    include "templates/loginform.php";
}

function loginCheck()
{
    
    if(isset($_POST['submit']) && ((empty($_POST['username'])) || (empty($_POST['password']))))
    {
        Validation::validate();
        include "templates/loginform.php";
    }
    else if(!empty($_POST['username']))
    {
       if(!Validation::ValidateUsername())
       {
           
           include "templates/loginform.php";
       }
       else
       {
            UserDAO::init();
            //Get the current user 
            
            $authUser = UserDAO::getUser($_POST['username']);
            //Check the DAO returned an object of type user
            
            if($authUser == false)
            {
               Validation::$error .="User name not found in database!";
               error_log("ERROR: ".date("F j, Y, g:i a ").": The user ".$_POST['username']." doesn't exist.\r\n", 3, "logs/errorLog.txt");
               include "templates/loginform.php";
            }
            else
            {

                    if(Validation::validateUserInfo($authUser))
                    {
                
                        //Check the password
                    
                            
                            //Start the session
                            session_start();
                            //Set the user to logged in
                            $_SESSION['username'] = $authUser->getUserID();
                            $_SESSION['password'] = $authUser->getUserPassword();
                            $_SESSION['status'] = $authUser->getUserStatus();
                            
                            //setting error to empty string after logged in
                            Validation::$error = "";
                            //Send the user to the user managment page Lab09SHi_56789-updateaccount.php
                            if($authUser->getUserStatus() == 0)
                            {
                                
                                include "templates/usertabbed.php"; 
                            }
                            else
                            {
                                include "templates/tabbedpane.php"; 
                            }
                    }
                    else
                    {
                        error_log("ERROR: ".date("F j, Y, g:i a ").": The password entered is incorrect.\r\n", 3, "logs/errorLog.txt");
                        include "templates/loginform.php";
                    }
            }
        }
        
        }
  
}

function logout()
{
   session_start();
   session_destroy();
   include "templates/loginform.php";
}

function borrow()
{
    session_start();
    BookDAO::init();
    IssuedBookDAO::init();
    BookDAO::updateBooks($_GET['id']);
    $date = date('Y-m-d', time());
    // $date = new DateTime();
    // $result = $date->format('Y-m-d');
    // var_dump($result);
    IssuedBookDAO::insertBook($_GET['id'], $_SESSION['username'],$date);
    $book = BookDAO::getBook($_GET['id']);

    include "templates/bookIssued.php";
}

function userhome()
{
    session_start();
    UserDAO::init();
    $user = UserDAO::checkUserorAdmin($_SESSION['username']);
    if($user->getUserStatus() == 0)
    {
        include "templates/usertabbed.php";
    }
    else
    {
        include "templates/tabbedpane.php";
    }
    
}

function searchbookorauthor()
{
    BookDAO::init();
    $books = array();
    if(Validation::checkIssueForm() == false)
    {
        Validation::$error .= "You did not enter anything, displaying full list!";
    }
    if($_POST['submit']== "Bookname" || $_POST['submit'] == "Author")
    {
        if($_POST['submit'] == "Bookname")
        {
            
            $books = BookDAO::getBooks($_POST['searchitem']);
            
        }
        else
        {
        
            $books = BookDAO::getBooksByAuthor($_POST['searchitem']);
        }
        session_start();
        UserDAO::init();
        $user = UserDAO::checkUserorAdmin($_SESSION['username']);
        if(Validation::checkIssueForm() == true)
        {
            //setting error message to null after use
            Validation::$error = ""; 
        }
        if($user->getUserStatus() == 0)
        {
            include "templates/usertabbed.php";
        }
        else
        {
            include "templates/tabbedpane.php";
        }
    }
    
}

function review()
{
    if(!empty($_GET['action']) && ($_GET['action'] == "review"))
    {
        $jReview = json_decode(RestClient::call("GET",array('id'=>$_GET['id'])));
        if($jReview == false)
        {
            session_start();
            UserDAO::init();
            $user = UserDAO::checkUserorAdmin($_SESSION['username']);
            if($user->getUserStatus() == 0)
            {
                include "templates/usertabbed.php";
            }
            else
            {
                include "templates/tabbedpane.php";
            }
        }
        else
        {
            $nr = new Review();
            $nr->setBookISBN($jReview->isbn);
            $nr->setReview($jReview->review);
            session_start();
            UserDAO::init();
            $user = UserDAO::checkUserorAdmin($_SESSION['username']);
            if($user->getUserStatus() == 0)
            {
                include "templates/usertabbed.php";
            }
            else
            {
                include "templates/tabbedpane.php";
            }
            }
        
        
    }
}

function returnBook()
{
    if(isset($_POST["submit"])) 
    {
        IssuedBookDAO::init();
        BookDAO::init();
        $issuedbook = IssuedBookDAO::selectBook($_POST["ISBN"]);
        if($issuedbook == false)
        {
            session_start();
            if($_SESSION["status"]==0)
            {           
                $issuedbooks = BookDAO::getIssuedBooksForSpecificUser($_SESSION["username"]);           
            }
            
            if($_SESSION["status"]==1) 
            {           
                $issuedbooks = BookDAO::getIssuedBooks();
            }
            error_log("ERROR: ".date("F j, Y, g:i a ").": The ISBN: ".($_POST["ISBN"]==""?"'blank'":$_POST["ISBN"])."  is not currently issued.\r\n", 3, "logs/errorLog.txt");
            include "templates/nobookselected.php";
        }
        else
        {
            if($issuedbook instanceof IssuedBook) 
            {
                $book = BookDAO::getBook($issuedbook->getBooksISBN());
                include "templates/returnbook.php";
            }
        }     
     }
}

function confirmReturn()
{
    IssuedBookDAO::init();
    BookDAO::init();
    if(isset($_POST["confirm"])) {
        $book = BookDAO::getBook($_POST["confirmISBN"]);
        BookDAO::updateIssuedBook($book);
        IssuedBookDAO::deleteBook($book->getBooksISBN());
        include "templates/returnbook.php";
    }
}

function deleteBook()
{
    BookDAO::init();
    $flag = BookDAO::deleteBook($_GET['id']);
    if($flag == false)
    {
        Validation::$error = "This cannot be deleted. Book Issued!";
    }
    else
    {
        Validation::$error= "";
    }
    $books = BookDAO::listBooks();
    include "templates/adminlibrary.php";
    
}

function manageBook()
{
    BookDAO::init();
    $books = BookDAO::listBooks();
    include "templates/adminlibrary.php";
}

function addBookForm()
{
   
    include "templates/adminlibrary.php";
    
}

function addBook()
{
        if(!empty(Validation::checkaddBook()))
        {
            $_GET['action'] = "addbookform";
            include "templates/adminlibrary.php";
           // header("Location: Ravenclaw.php?action=addbookform");
        }
        else
        {
            BookDAO::init();
            $nb = new Book();
            $nb->setBooksISBN($_POST["bISBN"]);
            $nb->setName($_POST["name"]);
            $nb->setAuthor($_POST["author"]);
            $nb->setPublisher($_POST["publisher"]);
            $nb->setIssuedBookFlag(0);
            $nb->setReturnBookCount(0);
            BookDAO::createBook($nb);
            $books = BookDAO::listBooks();
            include "templates/adminlibrary.php";
        }
        
        
   
    
}

function deleteUser()
{
    UserDAO::init();
    UserDAO::deleteUser($_GET['userid']);
    $users = UserDAO::getUsers();
    include "templates/adminlibrary.php";
}

function manageUser()
{
    UserDAO::init();
    $users = UserDAO::getUsers();
    include "templates/adminlibrary.php";
}

function editUser()
{
    UserDAO::init();
    $user = UserDAO::getUser($_GET["userid"]);  
    include "templates/adminlibrary.php";
}

function updateUser()
{
    if(!empty(Validation::checkUser()))
    {
        UserDAO::init();
        $user = UserDAO::getUser($_POST["username"]); 
        $_GET['action'] = "edituser";
        include "templates/adminlibrary.php";
      
    }
    else
    {
        UserDAO::init();
        UserDAO::updateUser($_POST['username']);
        $users = UserDAO::getUsers();
        include "templates/adminlibrary.php";
    }
    
}

function  addUserForm()
{
    include "templates/adminlibrary.php";
}

function addUser()
{
    if(!empty(Validation::checkUser()))
    {
        $_GET['action'] = "adduserform";
        include "templates/adminlibrary.php";
       
    }
    else
    {
        UserDAO::init();
        $us = new User();
        $us->setUserID($_POST['username']);
        $us->setUserPassword($_POST['password']);
        $us->setUserStatus($_POST['status']);
        UserDAO::addUser($us);
        $users = UserDAO::getUsers();
        include "templates/adminlibrary.php";
    }
    
}



?>