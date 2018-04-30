

<?php
/**
 * login.php
 * 
 * content for the login page
 * 
 * @version 1.0 2018-04-19
 * @package The Food Pit Stop
 * @copyright (c) 2018, Anita Mirshahi, Suim Park, Valini Rangasamy
 * @license 
 * @since Release 1.0
 */

?>


<main class="page login-page">
    <section class="clean-block clean-form dark" style="background-color:rgba(184,156,132,0.28);">
        <div class="container">
            <div class="block-heading" style="margin-top:-38px;">
                <h1 style="color:#608e3a;">Log in</h1>
                <p>Please log in with your username and password.</p>
                <p> <?php 
                $login_fail = 0;
                if (isset($_GET['msg'])){
                    $login_fail = 1;
                    echo $_GET['msg'];
                }
                ?> </p>
            </div>
            <form style="border-top:2px solid #608e3a" method = "post"  action="includes/process_login.php">
                <div class="form-group"><label for="email">Email</label><input class="form-control item" type="text" placeholder="example@domain.com" 
                    <?php 
                    if($login_fail && isset($_GET['useremail'])){
                        echo 'value="' . $_GET['useremail'] . '"';
                    }
                    ?> id="email" name="email" required></div>
                <div class="form-group"><label for="password">Password</label><input class="form-control" type="password" id="password" name="password" required></div>
                <div class="form-group">
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="checkbox"><label class="form-check-label" for="checkbox">Remember me</label></div>
                    <div style="text-align:right;"><a href="index.php?content=registration">Create new account</a></div>
                </div><button class="btn btn-primary btn-block" type="submit" name="submit" style="background-color:#608e3a;">Log In</button></form>
        </div>
    </section>
</main>