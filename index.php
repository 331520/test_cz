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
        try {

            if ($_POST["name"] and $_POST["email"]) {
                $name = $_POST["name"];
                $email = $_POST["email"];
                echo $name;
                echo $email;
            }






            //db data
            $servername = "localhost";
            $username = "root";
            $password = "";

            // Create connection
            $conn = new mysqli($servername, $username, $password);

            // Check connection
            if ($conn->connect_error) {
                die("Error: " . $conn->connect_error);
            }

            //detele it
            echo "Has been connected";



            //user reg form
            ?>
            <form action = "" method = "post">
                Name: <input type = "text" name = "name"><br>
                E-mail: <input type = "text" name = "email"><br>
                <input type = "submit">
            </form>
            <?php
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        ?>
    </body>
</html>
