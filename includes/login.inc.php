<?php

    if (isset($_POST["submit"])) {

        // First we get the form data from the URL
        $username = $_POST["uid"];
        $pwd = $_POST["pwd"];

        require_once "dbh.inc.php";
        require_once 'functions.inc.php';

        // Left inputs empty
        if (emptyInputLogin($username, $pwd) === true) {
        header("location: ../includes/login.php?error=emptyinput");
            exit();
        }

        // If we get to here, it means there are no user errors

        // Now we insert the user into the database
        loginUser($conn, $username, $pwd);

    } else {
        header("location: ../includes/login.php");
        exit();
    }

?>