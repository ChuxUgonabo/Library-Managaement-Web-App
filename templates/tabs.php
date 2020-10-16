
<section id="tabs">
	<div class="container">
	<div class="row justify-content-end"><?php Page::logout();?></div>
	<?php if(!empty(Validation::$error))
    {
    ?>
            <div class="container">
            <div id="validation" class ="col-md-offset-4 col-lg-offset-5">
            <?php echo Validation::$error;?>
            </div>
            </div>
    <?php }?>
		<h6 class="section-title h1">Library Management System</h6>
		<div class="row">
			<div class="col-md-12 ">
				<nav>
					<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
						<a class="nav-item nav-link active" id="nav-issuedbooks-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Issue Books</a>
						<a class="nav-item nav-link" id="nav-returnbooks-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Return Book</a>
						<a class="nav-item nav-link" id="nav-admin-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Admin</a>
						
					</div>
				</nav>