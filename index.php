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

            //db data
            global $servername, $username, $password, $dbname, $conn;
            $servername = "localhost";
            $username = "root";
            $password = "tegeran43";
            $dbname = "interlcg";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Error: " . $conn->connect_error);
            }

            //detele it
            echo "<br />Has been connected to DB";

            if (empty($_POST["name"]) or empty($_POST["surname"]) or empty($_POST["address"]) or empty($_POST["email"]) or empty($_POST["telephone"])) {
                echo "Error: All Fields Is Requred";
            } else {

                //check for alphabetical only
                if (ctype_alpha($_POST["name"]) and ctype_alpha($_POST["surname"])) {
                    $name = $_POST["name"];
                    $surname = $_POST["surname"];
                } else {
                    echo "Wrong symbols in Name or Surname";
                    $error_flg = "Y";
                }


                //email must contains @ and .
                if (strpos($_POST["email"], '@') !== false and strpos($_POST["email"], '.') !== false) {
                    //if (strpos($_POST["address"], '@') !== false and strpos($_POST["address"], '.') !== false) {                    
                    $email = $_POST["email"];
                } else {
                    echo "Error : Enter e-mail in correct format";
                    $error_flg = "Y";
                }

                //Just address
                $address = $_POST["address"];

                // only numbers in phone
                if (ctype_digit($_POST["telephone"])) {
                    $telephone = $_POST["telephone"];
                } else {
                    echo "Error : Enter phone in correct format";
                    $error_flg = "Y";
                }

                //no errors. Try to create new row in table customer
                if (empty($error_flg)) {
                    $q = "INSERT INTO customer (name, surname, address, email, telephone) VALUES ('" . $name . "', '" . $surname . "', '" . $address . "', '" . $email . "', '+" . $telephone . "')";
                    echo "Query : " . $q; //delete it

                    if ($conn->query($q) === TRUE) { //OK
                        echo "New customer registered successfully";
                    } else {
                        echo "Error: " . $q . "<br>" . $conn->error;
                    }
                }
            }

            //user reg form
            ?>
            <br />
            <br /><br />
            <?php
            ?>
            <form action = "" method = "post">
                Name: <input type = "text" name = "name"><br>
                SurName: <input type = "text" name = "surname"><br>
                Address: <input type = "text" name = "address"><br>
                E-mail: <input type = "text" name = "email"><br>
                Telephone: +<input type = "text" name = "telephone"><br>
                Card number <select name="cards">
                    <?php
                    $sql = "select card_number from cards where cust_id IS null";
                    $result = $conn->query($sql);
                    print_r($result);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            // it must be somewhere here
                            // echo "<option value='".$row["card_number"]."'>" . $row["card_number"] . "<br>";
                            echo "Card number " . $row["card_number"] . "<br>";
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>

                    
                </select>
                <br><input type = "submit">
            </form>
            <?php
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $conn->close();
        ?>
    </body>
</html>