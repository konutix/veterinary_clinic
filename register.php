<?php
    include 'classes/includes.php';
    session_start();
    if(isset($_SESSION["userID"])){
        header("Location: ./index.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["register"]) && $_POST["action"] = "change"){
            $_SESSION["register"]=$_POST["register"];
        }
    }
    else
    {   
        if(!isset($_SESSION["register"])){
            $_SESSION["register"] = 1;
        }
    }
?>
<!DOCTYPE html>
	<head>
            <meta charset="utf-8">
            <title>Przychodnia</title>
            <link rel="stylesheet" href="style.css">
	</head>
	<body>
	<?php
            $register = new RegisteringView();
            if($_SESSION["register"] == 1){
                $register->showLogin();
            }else if($_SESSION["register"] == 0){
                $register->showRegister();
            }
        ?>
	</body>
</html>