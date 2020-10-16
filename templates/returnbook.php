<?php include "templates/header.php" ?>
<style>
.bookIssued a, .bookIssued a:hover, .bookIssued a:active
{
    padding: 12px;
    border-radius: 6px;
    background-color: #eee;
    color: black;
    font-size: 18px;
    text-decoration: none;
}
i
{
    color:white;
}
</style>
<div class="container bookIssued">
    <br />
    <h2 style ="color:white">Book Return</h2>
    <?php
    if(isset($_GET['action']) && $_GET['action']=="returnbook")
		{
			Page::bookDetails($book);
        }
    if(isset($_GET['action']) && $_GET['action']=="userconfirmreturn")
    {
        Page::thankYou($book);
    }
    ?>
    <br />
    <br />
    <a class="button" href="Ravenclaw.php?action=userhome">Home</a>
</div>

<?php include "templates/footer.php" ?>