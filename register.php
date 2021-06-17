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
            $passwd = $_POST["passwd"];
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $address = $_POST["address"];
            $result = Registering::register($login, $passwd, $name, $surname, $email, $phone, $address);
            switch ($result){
                case 0:
                    header("Location: index1.php");
                    break;
                case 1:
                    print "Taki użytkownik już istnieje.";
            }
          }
        ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div>
				<label for="login">Login</label><input id="login" name="login" type="text" placeholder="Login" required>
			</div>
			<div>
				<label for="passwd">Hasło</label><input id="passwd" name="passwd" type="password" placeholder="Hasło" required>
			</div>
                        <div>
				<label for="name">Imię</label><input id="name" name="name" type="text" placeholder="Jan" required>
			</div>
			<div>
				<label for="surname">Nazwisko</label><input id="surname" name="surname" type="text" placeholder="Kowalski" required>
			</div>
                        <div>
				<label for="email">Email</label><input id="email" name="email" type="text" placeholder="nazwa@adres.com" required>
			</div>
			<div>
				<label for="phone">Telefon</label><input id="phone" name="phone" type="text" placeholder="+48123456789" required>
			</div>
			<div>
				<label for="address">Adres</label><input id="address" name="address" type="text" placeholder="Prosta 1" required>
			</div>
                
			<div>
				<input id="submit" type="submit" value="Zarejestruj">
			</div>
		</form>
	</body>
</html>