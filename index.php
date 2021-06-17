<?php
include 'classes/includes.php';
	session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if($_POST["logut"]){
                Registering::logout();
            }
        }
        if($_SESSION["userID"]==null){
            header("Location: ./login.php");
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

	<input type="button" value="Zwierzęta"  class="redirBtn" onClick="document.location.href='./zwierzeta.php'" />
	<input type="button" value="Użytkownik" class="redirBtn" onClick="document.location.href='./user.php'" />
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input name="logut" type="checkbox" checked hidden/>
            <input type="submit" value="Wyloguj" class="redirBtn"/>
        </form>

</body>
</html>
