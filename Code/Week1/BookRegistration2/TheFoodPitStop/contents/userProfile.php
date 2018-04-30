<?php
session_start();
  //echo $_SESSION['username']; 
?>

<main class="page login-page">
    <section class="clean-block clean-form dark" style="background-color:rgba(184,156,132,0.28);">
        <div class="container">
            <div class="block-heading" style="margin-top:-38px;">
                <h1 style="color:#608e3a;">User Profile</h1>
                <p>Welcome <?php/* echo $_SESSION['username']*/ ?>  <a href='logout.php'>Logout</a> </p> 
            </div>
            
        </div>
    </section>
</main>
