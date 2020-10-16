<?php

class Page 
{

    static function searchby()
    {
        
        ?>
        <form method ="post" action ="<?php echo $_SERVER['PHP_SELF']?>?action=searchbookorauthor">
        <div class="form-group">
			<label for="exampleInputEmail1">Search Books: </label>
			<input type="text" class="form-control" id="exampleInput" name="searchitem" aria-describedby="emailHelp" placeholder="Enter book name or author's name" class="form-control">
		</div>
        <div class="form-group">
       
        Search By
            <input class="btn btn-search" type="submit" name="submit" value="Bookname">
            <input class="btn btn-search" type="submit" name="submit" value="Author">
        </div>
		</form>
        <?php
    }

    static function viewBooks($books)
    {
			?>	

		<h2>List of Books</h2>
		<table class="table table-borderless">
		<tr>
			<th>Book Name</th>
			<th>Author Name</th>
			<th>Publisher</th>
			<th>Borrow</th>
			<th>Reviews</th>
		</tr>
		<?php 
		foreach($books as $book)
		{
			?>	
				<tr>
				
				<td><?php echo $book->getName(); ?></td>
				<td><?php echo $book->getAuthor(); ?></td>
				<td><?php echo $book->getPublisher(); ?></td>
				<td><a href="?action=itemselected&id=<?php echo $book->getBooksISBN();?>">Borrow</a></td>
				<td><a href="?action=review&id=<?php echo $book->getBooksISBN();?>">Review</a></td>
				</tr>
			<?php } ?>
		</table>
    <?php
    }

    static function logout()
    {
        ?>
            <br />
            <!-- <hr id="lineafterform"> -->
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>?action=logout">
            <button type="submit" class="btn btn-search">Logout</button>
            </form>
        <?php
    }

    static function review($nr)
    {
        ?>
        <hr id="lineafterform">
		<div id="reviews">
            <h4><em>BookReview:<?php echo " " .$nr->getBookISBN() ?></em></h4>
            <em><strong><q><?php echo $nr->getReview() ?></q></strong></em>
		</div>
        <?php
    }

//John's part
    static function returnForm() {?> 

        Return Form: 
        <br />
        <Form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=returnbook" method="POST" enctype ="multipart/form-data">
                <div class="form-group">
                    <input type="text" class="form-control" name="ISBN" placeholder="Enter Book ISBN" class="form-control">
                </div>
        
            
                <div>
                    <button type="submit" name="submit" class="btn-search">Check Book</button>
                </div>
            
           
            </form>
            
                <?php }

static function bookDetails($book)   { ?>

    <TABLE class="table table-borderless">

        <TR>
            <TH>Book ISBN </TH> 
            <TD> <?php echo $book->getBooksISBN() ;?></TD>
         </TR>
         <TR>
            <TH>Name</TH> 
            <TD><?php echo $book->getName() ;?></TD>
         </TR>
         <TR>
            <TH>Author</TH> 
            <TD><?php echo $book->getAuthor() ;?></TD>
         </TR>
         <TR>
            <TH>Publisher</TH> 
            <TD><?php echo $book->getPublisher() ;?></TD>
         </TR>

    </TABLE>

      
        <br> 
        <Form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=userconfirmreturn" method="POST">
            <input type="hidden" class="form-control" name="confirmISBN" value="<?php echo $book->getBooksISBN() ;?>" >

            <button type="submit" name="confirm" value = "edit" class="btn-search">Confirm</button>
        </form>
        

    <?php }

static function thankYou($book) {?> 
    <p id="thanyou"> Thank You! <br> You have successfully returned "<?php echo $book->getName() ;?>"</p>
    
    <?php }

static function issuedBooks($issuedbooks)
{
    ?>
    <TABLE class="table table-borderless">
    <TR>
    <TH>ISBN</TH> 
    <TH>Name</TH> 
    <TH>Author</TH> 
 </TR>
<?php
foreach($issuedbooks as $book)
{
?>
<TR>
    <TD><?php echo $book->getBooksISBN() ;?></TD>
    <TD><?php echo $book->getName() ;?></TD>
    <TD><?php echo $book->getAuthor() ;?></TD> 
</TR>
<?php 
}
?>
</TABLE>

    <?php
}

static function listBooks($books)   { ?>
    <br><h3>Delete/Edit Books:</h3>
    <TABLE class="table table-borderless">
        
            <TR>        
                <TH>Books_ISBN</TH>
                <TH>Name</TH>
                <TH>Author</TH>
                <TH>Publisher</TH>
                <TH>IssuedBookFlag</TH>
                <TH>ReturnBookCount</TH>
                <TH>Delete</TH>
            </TR>
    
            <?php
    
                foreach ($books as $book) {
                    echo '<TR>
                    <TD>'.$book->getBooksISBN().'</TD>
                    <TD>'.$book->getName().'</TD>
                    <TD>'.$book->getAuthor().'</TD>
                    <TD>'.$book->getPublisher().'</TD>
                    <TD>'.$book->getIssuedBookFlag().'</TD>
                    <TD>'.$book->getReturnBookCount().'</TD>
                    <TD><a href="?action=deletebook&id='.$book->getBooksISBN().'">Delete</a></TD>
                    </TR>';
                }
    
            ?>
    
        </TABLE>
        
        <?php }

        static function ManageBook()
        {
            ?>
            <form method ="post" action ="<?php echo $_SERVER['PHP_SELF']?>?action=managebook">
           
            <div class="form-group">
                <input class="btn btn-search" type="submit" name="submit" value="Manage Book">
               
            </div>
            </form>
            <?php
        }

        static function addBookForm()   
    { ?>
            <?php if(!empty(Validation::$error))
            {
            ?>
                    <div class="container">
                    <div id="validation" class ="col-md-offset-4 col-lg-offset-5">
                    <?php echo Validation::$error;?>
                    </div>
                    </div>
            <?php }?>
        <br>
        <br>
        <br>
        <br>
        <h5>Add Book</h5>

            <form  action="<?php echo $_SERVER['PHP_SELF']; ?>?action=addbook" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="bISBN">Books ISBN</label>
                    <input type="text" class="form-control" name="bISBN" id="bISBN" placeholder="Enter books ISBN">
                </div>
                <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter books Name" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="author">Author</label>
                    <input type="text" name="author" id="author" placeholder="Enter Author's Name" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="publisher">Publisher</label>
                    <input type="text" name="publisher" id="publisher" placeholder="Enter Publisher's Name" class="form-control">
                </div>
            </div>
                <div>
                    <input class="btn btn-search" type="submit" name="submit" value="Add to Library">
                </div>
            </form>
    <?php }

        static function AddBook()
        {
            ?>
            <form  action="<?php echo $_SERVER['PHP_SELF']; ?>?action=addbookform" method="post">
     
            <div>
                <input class="btn btn-search" type="submit" name="submit" value="Add a new Book" >
            </div>
            </form>
            <?php
        }

        static function ManageUser()
        {
            ?>
            <form method ="post" action ="<?php echo $_SERVER['PHP_SELF']?>?action=manageuser">
           
            <div class="form-group">
                <input class="btn btn-search" type="submit" name="submit" value="Manage User">
               
            </div>
            </form>
            <?php
        }

        static function listUsers($users)   { ?>

            <br><h3>Delete/Edit Users:</h3>
                <TABLE class="table table-borderless">
                
                    <TR>
                        <TH>User Id</TH>
                        <TH>User Password</TH>
                        <TH>User Status</TH>
                        <TH>Delete</TH>
                        <TH>Edit</TH>
                    </TR>
            
                    <?php
                        foreach ($users as $user) {
                            echo '<TR>
                            <TD>'.$user->getUserID().'</TD>
                            <TD>'.$user->getUserPassword().'</TD>
                            <TD>'.$user->getUserStatus().'</TD>
                            <TD><a href="?userid='.$user->getUserID().'&action=deleteuser"> Delete </a></TD>
                            <TD><a href="?userid='.$user->getUserID().'&action=edituser"> Edit </a></TD>
                            </TR>';
                        }
            
                    ?>
            
                </TABLE>
            
                <?php }

static function editUserForm($user)   
{ ?>
    <br>
    <h5>Add Book</h5>

        <form  action="<?php echo $_SERVER['PHP_SELF']; ?>?action=updateuser" method="post">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="username">Username</label>
                <input type="hidden" name="username" value="<?php echo $user->getUserID() ?>">
                <input type="text" class="form-control" name="disUsername" id="username" placeholder="Username" value="<?php echo $user->getUserID() ?>" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="password">Password</label>
                <input type="text" name="password" id="password" placeholder="Password" class="form-control" value="<?php echo $user->getUserPassword() ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="password">User Status</label>
                <input type="text" name="status" id="status" placeholder="User Status" class="form-control" value="<?php echo $user->getUserStatus() ?>">
            </div>
        </div>
       
            <div>
                <input class="btn btn-search" type="submit" name="submit" value="Add User">
            </div>
        </form>
<?php }

static function addUser()
        {
            ?>
            <form  action="<?php echo $_SERVER['PHP_SELF']; ?>?action=adduserform" method="post">
     
            <div>
                <input class="btn btn-search" type="submit" name="submit" value="Add User" >
            </div>
            </form>
            <?php
        } 
        static function addUserform()   
        { ?>
            <br>
            <br>
            <br>
            <br>
            <h5>Add User</h5>
        
                <form  action="<?php echo $_SERVER['PHP_SELF']; ?>?action=adduser" method="post">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" placeholder="Password" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="status">User Status</label>
                        <input type="text" name="status" id="status" placeholder="User Status" class="form-control">
                    </div>
                </div>
               
                    <div>
                        <input class="btn btn-search" type="submit" name="submit" value="Add User">
                    </div>
                </form>
        <?php }
        
}
?>