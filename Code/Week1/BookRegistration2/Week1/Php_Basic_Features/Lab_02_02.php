<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP Data Type Conversion</title>
    </head>
    <body>
        <?php
        // declare a string, double and integer
        $testString = "3.5 seconds";
        $testDouble = 79.2;
        $testInteger = 12;
        ?>
        
        <?php
        // print each variable's value and type
        print($testString . " is a(n) " . gettype($testString) . "<br/>");
        //print("$testString  is a(n)  gettype($testString) <br/>");
        print($testDouble . " is a(n) " . gettype($testDouble) . "<br/>");
        print($testInteger . " is a(n) " . gettype($testInteger) . "<br/>");
        ?>
        
        <?php
        // convert to other data types
        // call function settype to convert variables
        // testString to different data types
        print($testString);
        settype($testString, "double");
        print(" as a double is $testString <br />");
        settype($testString, "integer");
        print( " as a integer is $testString <br/>");
        print( $testString + $testInteger . " <br/>");
        print( " sum : " . $testString + $testInteger . " <br/>");      // error
        print( $testString - $testInteger . " <br/>");
        print( $testString * $testInteger . " <br/>");
        print( $testString / $testInteger . " <br/>");       
        
        $variable = 5.258;
        echo '$variable';   // $variable
        echo '<br />';
        echo "$variable";   // 5.258
        echo '<br />';
        print("$variable");     // 5.258
        echo '<br />';
        print('$variable');     // $variable
        print("<br/>");
       ?>
        
        <?php
        $fruits = array("apple", "orange", "banana");
        
        // iterate through each array element
        for ($counter = 0; $counter < count($fruits); $counter++){
            // call function strcomp to compare array elements
            if (strcmp($fruits[$counter], "banana") < 0) {
                print ($fruits[$counter] . " is less than banana.");
            } else if (strcmp($fruits[$counter], "banana") > 0) {
                print ($fruits[$counter] . " is less than banana.");
            } else{
                print ($fruits[$counter] . " is equal to banana.");
            }
            print("<br/>");
        }
        ?>
    </body>
</html>
