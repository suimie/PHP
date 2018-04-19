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
        <h1>Welcome to Lab 02</h1>
        <p>Today is Apr. 16, 2018</p>
        
        <p>Today is <?php echo date('M j, Y H:i:s'); ?></p>             <!-- Apr 16, 2018 15:32:01 -->
        <p>Today is <?php echo date('l jS \of F Y h:i:s A'); ?></p>    <!-- Monday 16th of April 2018 03:32:01 PM -->
        
        <?php
        // put your code here
        //date_default_timezone_set("America/Toronto");
        //echo date_default_timezone_get();
        ?>
        
        <?php
        /* look for date \ mktime \ DATE_ATOM \ DATE_RFC822 */
        // print something like Monday
        echo "<p>" .  date('l') . "<br/>";
        
        // print something like Monday 16th of April 2018 12:5 PM
        echo "<p>" .  date('l jS of F Y h:i A') . "<br/>";
        
        // print something like Monday April 21, 2018 is on a Saturday
        // mktime(hour, minute second, month, day, year is_dst)       
        echo "<p>April 21, 2018 is on a " .  date('l', mktime(0, 0, 0, 4, 21, 2018))  . "<br/>";
        
        // print something like Mon, 16 Apr 2018 12:10:45 UTC
        date_default_timezone_set("UTC");
        echo "<p>" .  date('D, j M F Y h:i:s e') . "<br/>";
        echo date(DATE_RFC822) . "<br/>";
        
        // print something like 202007-01TO0:00:00+00:00
        echo date(DATE_ATOM) . "<br/>";
        echo date(DATE_ATOM, mktime(0, 0, 0, 7, 1, 2020)) . "<br/>";
        ?>
    </body>
</html>
