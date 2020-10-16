
<?php include "header.php" ?>
<body>
    <?php if(!empty(Validation::$error))
    {
    ?>
            <div class="container">
            <div id="validation" class ="col-md-offset-4 col-lg-offset-5">
            <?php echo Validation::$error;?>
            </div>
            </div>
    <?php }?>
    <div id="login">
        
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                    
                        <form id="login-form" class="form" action="<?php echo $_SERVER['PHP_SELF'] ?>?action=loginCheck" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group login-button">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Log in">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include "footer.php" ?>
