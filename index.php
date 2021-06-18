<?php
include 'classes/includes.php';
	session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if($_POST["logut"]){
                Registering::logout();
            }
            if($_POST["back"]){
                $_SESSION["access"] = $_SESSION["originalAccess"];
                $_SESSION["originalAccess"] = null;
            }
        }
        if(!isset($_SESSION["userID"])){
            header("Location: ./register.php");
        }
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8">

	<title>Przychodnia</title>

	<link rel="stylesheet" href="style.css">

</head>
<body>
        <?php
        if($_SESSION["access"] != 1){
            require "templates/userMenu.html.php";
            if(isset($_SESSION["originalAccess"]) && $_SESSION["originalAccess"] == 1){
                echo "
                    <form method=\"post\" action=\"";echo htmlspecialchars($_SERVER["PHP_SELF"]);echo"\">
                        <input name=\"back\" type=\"checkbox\" checked hidden/>
                        <input type=\"submit\" value=\"Wróc na swoje konto\" class=\"redirBtn\"/>
                    </form>";
            }
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input name="logut" type="checkbox" checked hidden/>
            <input type="submit" value="Wyloguj" class="redirBtn"/>
        </form>

</body>
</html>
