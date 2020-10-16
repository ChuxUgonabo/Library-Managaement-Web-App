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
    <h2 style ="color:white">Book Issued</h2>
    <table class="table" style="color:white">

            <tr><th>Bookname: </th><td><?php echo $book->getName()?></td></tr>
            <tr><th>Author: </th><td><?php echo $book->getAuthor()?></td></tr>
            <tr><th>Publisher: </th><td><?php echo $book->getPublisher()?></td></tr>
            
                
            
       
    </table>
    <i>Have a nice read! Return in 14 days</i>
    <br />
    <br />
    <a class="button" href="Ravenclaw.php?action=userhome">Home</a>

</div>

<?php include "templates/footer.php" ?>