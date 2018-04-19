<?php 
	require_once
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>Book Registration Form</title>
    <style>
        .form_title{
            background-color:lightseagreen;
            color:white;
            width:200px;
        }

        h3{
            color:blue;
        }

        .lablecell {
            background-color: black;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Book Registration Form</h1>
    <h2>Please fill in all fields and click Register.</h2>

    <div>
        <form action="bookRegistration.php" method="post" 
              id="book_registration_from" name="book_registration_from">
            <p class="form_title">User Information</p>
            <h3>Please fill out the fields below.</h3>

            <table>
                <tr>
                    <td class="lablecell">
                        <label for="firstname">First name</label>
                    </td>
                    <td>
                        <input type="text" id="firstname" name="firstname" required="required">
                    </td>
                </tr>
                <tr>
                    <td class="lablecell">
                        <label for="lsstname">Last name</label>
                    </td>
                    <td>
                        <input type="text" id="lastname" name="lastname">
                    </td>
                </tr>
                <tr>
                    <td class="lablecell">
                        <label for="email">Email</label>
                    </td>
                    <td>
                        <input type="email" id="email" name="email">
                    </td>
                </tr>
                <tr>
                    <td class="lablecell">
                        <label for="firstname">Phone</label>
                    </td>
                    <td>
                        <input type="text" id="phone" name="phone">
                    </td>
                </tr>
            </table>
            <br>
            <p>Must be in the form (555)555-5555</p>

            <p class="form_title">Publications</p>
            <h3>Which book would you like information about?</h3>
            <select id="book" name="book">
                <option value="Programming PHP 3E">Programming PHP 3E</option>
                <option value="Practical PHP and MySQL Website Databases">Practical PHP and MySQL Website Databases</option>
                <option value="PHP Quick Scripting Reference">PHP Quick Scripting Reference</option>
                <option value="Object-Oriented PHP">Object-Oriented PHP</option>
            </select>
            <h3>Which operating system are you currently using?</h3>
            <input type="radio" id="os" name="os" value="Windows XP" checked> Windows XP
            <input type="radio" id="os" name="os" value="Windows Vista"> Windows Vista
            <br />
            <input type="radio" id="os" name="os" value="Mac OX X"> Mac OX X
            <input type="radio" id="os" name="os" value="Linux"> Linux
            <input type="radio" id="os" name="os" value="Other"> Other
            <br />

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
