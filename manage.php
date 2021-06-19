<?php
    include 'classes/includes.php';
    session_start();
    if(isset($_SESSION["access"]) && $_SESSION["access"]!=1){
        header("Location: ./index.php");
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
            $admin = new AdminView();
            $admin->showChooseUser();
        ?>
	</body>
</html>