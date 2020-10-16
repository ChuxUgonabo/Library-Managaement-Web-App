<?php 

$flag = LoginManager::verifyLogin();
if($flag == true)
{
?> 

<?php include "header.php" ?>
<?php include "usertabs.php" ?>

<!-- Tabs -->

<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
<!-- Issued Books Tab -->
<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-issuedbooks-tab">
	<?php
		Page::searchby();
		if(isset($_GET['action']) && $_GET['action']=="searchbookorauthor")
		{
			Page::viewBooks($books);
		}
		if(isset($_GET['action']) && $_GET['action'] == "review")
		{
			if($jReview == false)
			{
				error_log("ERROR: ".date("F j, Y, g:i a ").": No review found.\r\n", 3, "logs/errorLog.txt");
				?>
				<hr id="lineafterform">
				<div id="reviews">
					<h4><em>BookReview:<?php echo " " .$_GET['id'] ?></em></h4>
					<em><strong><q><?php echo "No reviews yet!"?></q></strong></em>
				</div>
				<?php
			}
			else
			{
				Page::review($nr);
			}
			
		}
		
	?>

</div>
<!-- Return Books -->
	<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-returnbooks-tab">
		
		<?php
		Page::returnForm();
		
		?>

	</div>
							
<!-- ./Tabs -->
<?php include "footer.php" ?>
<?php
}
?>