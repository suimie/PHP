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
        /*
        $employee = array('Sally Meyers', 'George Smith', 'Peter hengel');
        echo $employee[1];
          */
        $employee[0] = 'Sally Meyers';
        $employee[1] = 'George Smith';
        $employee[2] = 'Peter Hengel';
        print_r($employee);
       ?>
        
        <br/>
        <?php 
        //$employee2 = array('name'=>'Sally Meyers', 'position'=>'President', 'yearEmployed'=>2017);
        $employee2['name'] = 'Sally Meyers';
        $employee2['position'] = 'President';
        $employee2['yearEmployed'] = '2017';
        print_r($employee2);
        ?>
        <br/>
        <?php 
        $employees = array(array('name'=>'Sally Meyers', 'position'=>'President', 'yearEmployeed'=>2017),
                                        array('name'=>'George Smith', 'position'=>'Treasurer', 'yearEmployeed'=>2016),
                                        array('name'=>'Peter Hengel', 'position'=>'Clerk', 'yearEmployeed'=>1992));

        ?>
        <pre>
            <?php print_r($employees); ?>
        </pre>
        
    </body>
</html>
