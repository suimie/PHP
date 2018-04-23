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
        <?php
            global $firstname, $lastname, $email, $phone, $book, $os;
            $firstname = $lastname = $email = $phone = $book = $os = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
              //$firstname = test_input($_POST["firstname"]);
              //$lastname = test_input($_POST["lastname"]);
              //$email = test_input($_POST["email"]);
              $phone = test_input($_POST["phone"]);
              //$book = test_input($_POST["book"]);
              //$os = test_input($_POST["os"]);

              if(!preg_match("/^(\(\d{3}\))\d{3}-?\d{4}$/", $phone)) {
                include 'invalidPhoneNumber.php';
              }else{
                include 'succeedSubmit.php';
              }
            }

            function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }        
        ?>
    </body>
</html>
