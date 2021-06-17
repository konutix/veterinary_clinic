<?php
    include 'Registering.php';
?>
<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
	<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $login = $_POST["login"];
            $passwd = hash('md5',$_POST["passwd"]);
            $user = null;
            $result = Registering::login($login, $passwd);
            switch ($result){
                case 0:
                    header("Location: index.php");
                    break;
                case 1:
                    print "Podano zły login";
                    break;
                case 2:
                    print "Podano złe hasło";
                    break;
            }
          }
        ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div>
				<label for="login">Login</label><input id="login" name="login" type="text" placeholder="Login">
			</div>
			<div>
				<label for="passwd">Hasło</label><input id="passwd" name="passwd" type="password" placeholder="Hasło">
			</div>
			<div>
				<input id="submit" type="submit" value="Zaloguj">
			</div>
		</form>
	</body>
</html>