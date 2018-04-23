<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h2>GET Method</h2>
        <p>You entered 
            <?php echo $_GET['username']; ?> as the User Name and 
            <?php echo $_GET['password']; ?> as the Password.</p>
        <?php
        // put your code here
        /*
            $username = $_GET['username'];
            $password = $_GET['password'];
            echo '<div>';              
            echo '<h2>Result of GET method</h2>';
            echo '<p>User name is ' . $username . '<br/>';
            echo '<p>Password name is ' . $password . '<br/>';
            echo '</div>';
         
         */
        ?>
    </body>
</html>
