<?php
    include "final.php";
    /* Connecting to database */
    $server = "localhost";
    $user = "u1fsufpgwmits";
    $pwd = "cs20team8";
    $db = "dbljxr9guyxurl";

    $conn = new mysqli($server, $user, $pwd, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn->select_db($db) or die( "Unable to select database");

    // Get the values entered in the HTML form
    $form_username = $_POST['username'];
    $card_number = $_POST['card_number'];
    $cvv = $_POST['cvv'];
    $expiration_date = $_POST['expiration_date'];

    $result = $conn->query("SELECT * FROM users WHERE username = '$form_username'");
    if ($result->num_rows == 0) {
        echo "Username does not exist";
    }


    // Update the credit card details in the database
    $sql = "UPDATE user SET card_number='$card_number', cvv='$cvv', expiration_date='$expiration_date' WHERE username='$form_username'";

    if ($conn->query($sql) === FALSE) {
        echo "Error updating credit card details: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
?>
