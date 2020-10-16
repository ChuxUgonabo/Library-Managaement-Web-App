<?php include "templates/header.php" ?>
<style>
.bookIssued a, .bookIssued a:hover, .bookIssued a:active
{
    
    background-color: #eee;
    color: black;
    font-size: 18px;
    text-decoration: none;
}
.bookIssued table{
    font-size:15px;
}
#home{
    padding: 12px;
    border-radius: 6px;
}
i
{
    color:white;
}
</style>
<div class="container bookIssued">
<?php if(!empty(Validation::$error))
    {
    ?>
            <div class="container">
            <div id="validation" class ="col-md-offset-4 col-lg-offset-5">
            <?php echo Validation::$error;?>
            </div>
            </div>
    <?php }?>
    <br />
    <h2 style ="color:white">Administrator Page</h2>
    <?php
    if(isset($_GET) && $_GET['action']=="managebook" || $_GET['action']=="deletebook" || $_GET['action']=="addbook")
    {
        Page::listBooks($books);
        ?> <hr><?php
        Page::AddBook();
        ?> <hr><?php
        Page::ManageUser();
        ?><hr><?php
		Page::ManageUser();
    }
   
    if(isset($_GET) && $_GET['action']=="addbookform")
    {
        Page::addBookForm();
        ?> <hr><?php
        Page::ManageBook();
        ?> <hr><?php
        Page::ManageUser();
        ?><hr><?php
		Page::ManageUser();
    }

    if(isset($_GET) && $_GET['action']=="manageuser" || $_GET['action']=="deleteuser")
    {
        Page::listUsers($users);
        ?> <hr><?php
        Page::addUser();
        ?> <hr><?php
        Page::ManageBook();
        ?> <hr><?php
        Page::AddBook();
    }

    if(isset($_GET) && $_GET['action']=="edituser" || $_GET['action'] == "updateuser" || $_GET['action'] == "adduserform" || $_GET['action'] == "adduser")
    {
        if($_GET['action'] == "edituser")
        {
            Page::editUserForm($user);
            ?> <hr><?php
            Page::ManageBook();
            ?> <hr><?php
            Page::ManageUser();
            ?><hr><?php
		    Page::ManageUser();
          
        }
        
        if($_GET['action'] == "updateuser" || $_GET['action'] == "adduser")
        {
            Page::listUsers($users);
            ?> <hr><?php
            Page::addUser();
            ?> <hr><?php
            Page::ManageBook();
            ?> <hr><?php
            Page::AddBook();
        }
        if($_GET['action'] == "adduserform")
        {
            Page::addUserform();
            ?> <hr><?php
            Page::ManageUser();
            ?> <hr><?php
            Page::ManageBook();
            ?><hr><?php
    		Page::ManageUser();
        }

    }
    ?>



    <br />
    <br />
    <a id="home"class="button" href="Ravenclaw.php?action=userhome">Home</a>
</div>

<?php include "templates/footer.php" ?>