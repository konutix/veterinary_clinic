<?php
	session_start();
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

</body>
</html>
