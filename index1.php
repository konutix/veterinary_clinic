<?php
    include 'Managment.php';
?>
<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
	<?php
            session_start();
            $user = unserialize($_SESSION['user']);
            print "Witaj ".$user->getName()." ".$user->getSurname();
        ?>
            
	</body>
</html>
