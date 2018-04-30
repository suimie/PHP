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
        // put your code here
            $firstName = 'Andy';
            $lastName = 'Tarr';
            $myVar = 'Hi, my name is ' . $firstName . ' ' . $lastName . '.';
            echo $myVar;
        ?>
        <br/>
        <?php 
        $myName = 'Andy';
        echo strlen($myName);
        ?>
        <br/>
        <?php 
        $myName = 'Andy & Amos';
        echo htmlspecialchars($myName);
        echo '<br/>' . $myName;
        ?>
        <br/>
        <?php 
        $myVar = 'the book of days';
        echo ucfirst($myVar);
        echo  '<br/>' .ucwords($myVar);
        ?>
        <br/>
        <?php 
        $myVar = 'THE BOOK OF daYs';
        //echo ucwords($myVar);
        echo ucwords(strtolower($myVar));
        ?>
        <br/>

    </body>
</html>
