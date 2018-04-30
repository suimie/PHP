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
        <style>
            span{
                color:blue;
                font-weight: bold;
            }
            .align-right{
                text-align: right;
            }
            th{
                width:120px;
                text-align: left;
                background-color: lightgoldenrodyellow;
            }
        </style>
    </head>
    <body>
        <div>
            <?php 
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $email = $_POST["email"];
                $phone = $_POST["phone"];
                $os = $_POST["os"];
            ?>
            <p>Hi <span><?php echo $firstname ?></span>. Thank you for completing the survey.</p>
            <p>You have been added to the <span><?php echo $os ?></span> mailing list.</p>
            <br />
            <h4>The following information has been saved in our database:</h6>
            
            <table>
                <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Os</th>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $firstname . ' ' . $lastname ?></td>
                        <td><?php echo $email ?></td>
                        <td><?php echo $phone ?></td>
                        <td><?php echo $os ?></td>
                    </tr>
                </tbody>
            </table>
            <p class="align-right">This is only a sample form. You have not been added to a mailing list in our database.</p>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
