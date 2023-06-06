<?php
    session_start();
    include_once 'includes/functions.inc.php';
?>

<!DOCTYPE html>
<html lang="pt_PT">
    <head>
        <meta charset="utf-8">
        <title>Arca Digital - TecWeb</title>
        
        <link rel="stylesheet" href=".css/reset.css">
        <link rel="stylesheet" href="css/style.css">
    
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    </head>

    <body>
    <!--Menu de Navegação-->
    <nav>
      <div class="wrapper">
        <a href="index.php"><img src="img/logo.png" alt="Blogs logo"></a>
        <ul>
          <li><a href="index.php">Home</a></li>
          <?php
            if (isset($_SESSION["useruid"])) {
                $cookie_value = $_SESSION["useruid"];
            setcookie('user_name', $cookie_value , 0);
                echo "<li><a href='search.php'>Search</a></li>";
                echo "<li><a href='logout.php'>Logout</a></li>";            
            }
            else {
                echo "<li><a href='signup.php'>Sign up</a></li>";
                echo "<li><a href='login.php'>Log in</a></li>";
            }
          ?>
        </ul>
      </div>
    </nav>

<!--Um wrapper para alinhar o rodapé (acaba em footer.php)-->
<div class="wrapper">
