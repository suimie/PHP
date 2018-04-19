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
            }
            .align-right{
                text-align: right;
            }
        </style>
    </head>
    <body>
        <div>
            <?php 
                global $firstname, $lastname, $email, $phone, $book, $os;
            ?>
            <p>Hi <span><?php $firstname ?></span>. Thank you for completing the survey.</p>
            <p>You have been added to the <span><?php $os ?></span> mailing list.</p>
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
                        <td><?php $firstname . ' ' . $lastname ?></td>
                        <td><?php $email ?></td>
                        <td><?php $phone ?></td>
                        <td><?php $os ?></td>
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
