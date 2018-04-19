<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Calculate the Sum of Factorials</title>
    </head>
    <body>
        <?php
        //echo phpinfo();
        $m = 5;
        $n = 10;
        $sum_of_factorials = calculate_sum_of_factorials($m, $n);
        
        echo "The Sum of Factorials of the Entered Integers is " .
               $sum_of_factorials ;
           
        function calculate_sum_of_factorials($arg1, $arg2) {
            $factorial1 = calculate_factorial($arg1);
            $factorial2 = calculate_factorial($arg2);
            
            $result = calculate_sum($factorial1, $factorial2);
            return $result;                      
        } // end calculate_sum_of_factorials
        
        function calculate_factorial($argument) {
            $factorial_result = 1;
            for ($count = 1; $count <= $argument; $count++) {
                $factorial_result = $factorial_result * $count;                
            }
            return $factorial_result;
        } // end function calculate_factorial
        
        function calculate_sum($facto1, $facto2) {
            return $facto1 + $facto2;
        } // end  function calculate_sum
        ?>
    </body>
</html>

