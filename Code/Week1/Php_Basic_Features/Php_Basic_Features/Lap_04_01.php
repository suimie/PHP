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
        <h2>Using $_GET Superglobal variable </h2>
        <form action="Lab_04_get_process.php" method="get">
            <labe for="username">User Name:</label><br>
          <input type="text" id="usrname" name="username">
          <br>
          <labe for="password">Password:</label><br>
          <input type="password" id="password" name="password">
          <br><br>
          <input type="submit" value="Submit">
        </form> 
        <?php
        // put your code here
        ?>
        <h2>Using $_POST Superglobal variable </h2>
        <form action="Lab_04_post_process.php" method="post">
            <labe for="username">User Name:</label><br>
          <input type="text" id="usrname" name="username">
          <br>
          <labe for="password">Password:</label><br>
          <input type="password" id="password" name="password">
          <br><br>
          <input type="submit" value="Submit">
        </form>     
    </body>
</html>
