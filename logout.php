<?php
    session_start();
    setcookie('user_name', "", time()-3600);
    session_unset();
    session_destroy();

    header("location: index.php");
    exit();
?>