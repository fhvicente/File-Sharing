<?php
    include_once 'header.php';
?>

<section class="signup-form">
    <h2>Sign Up</h2>
    <div class="signup-form-form">
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="name" placeholder="Full name...">
            <input type="text" name="email" placeholder="Email...">
            <input type="text" name="uid" placeholder="Username...">
            <input type="password" name="pwd" placeholder="Password...">
            <input type="password" name="pwdrepeat" placeholder="Repeat password...">
            <button type="submit" name="submit">Sign up</button>
        </form>
    </div>
    <?php
    // Error mensages
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
          echo "<p>Preencha todos os campos!</p>";
        }
        else if ($_GET["error"] == "invaliduid") {
          echo "<p>Escolha um nome apropriado!</p>";
        }
        else if ($_GET["error"] == "invalidemail") {
          echo "<p>Escolha um email apropriado!</p>";
        }
        else if ($_GET["error"] == "passwordsdontmatch") {
          echo "<p>As passwords não condizem!</p>";
        }
        else if ($_GET["error"] == "stmtfailed") {
          echo "<p>Alguma coisa está mal!</p>";
        }
        else if ($_GET["error"] == "usernametaken") {
          echo "<p>Username já está em uso!</p>";
        }
        else if ($_GET["error"] == "none") {
          echo "<p>Registo feito com sucesso!</p>";
        }
    }
    ?>
</section>

<?php
    include_once 'footer.php';
?>