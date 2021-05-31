<?php

session_start();

if(isset($_SESSION['username'])){
    header('Location: index.php');
}

if (isset($_POST['login'])) {

    $accept = true;

    //LOGIN CHECK
    $login = $_POST['login'];
    if ((strlen($login) < 3) || (strlen($login) > 99)) {

        $accept = false;
        $_SESSION['err_login'] = "Login musi posiadać pomiędzy 3 a 99 znaków!";

    } else {
        unset($_SESSION['err_login']);
    }

    if (!ctype_alnum($login)) {

        $accept = false;
        $_SESSION['err_login'] = "Login musi się składać tylko z liter i cyfr(bez polskich znaków)!";

    } else {
        unset($_SESSION['err_login']);
    }

    //EMAIL CHECK
    $email = $_POST['email'];
    $emailS = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ((filter_var($emailS, FILTER_VALIDATE_EMAIL)) == false || ($email != $emailS)) {
        $accept = false;
        $_SESSION['err_email'] = "Padaj poprawny e-mail";
    } else {
        unset($_SESSION['err_email']);
    }

    //PASSWORD CHECK
    $password = $_POST['password'];
    $repassword = $_POST['rePassword'];
    if (strlen($password) < 7 || strlen($password) > 50) {
        $accept = false;
        $_SESSION['err_password'] = "Hasło powinno zawierać od 6 do 50 znaków";
    } else {
        unset($_SESSION['err_password']);
    }

    if ($password != $repassword) {
        $accept = false;
        $_SESSION['err_repassword'] = "Hasła nie są identyczne";
    } else {
        unset($_SESSION['err_repassword']);
    }

    //USERNAME CHECK
    $username = $_POST['username'];
    if (!ctype_alnum($username)) {
        $accept = false;
        $_SESSION['err_username'] = "Login musi się składać tylko z liter i cyfr(bez polskich znaków)";
    } else {
        unset($_SESSION['err_username']);
    }

    //NAME CHECK
    $name = $_POST['name'];
    if (strlen($name) < 1) {
        $accept = false;
        $_SESSION['err_name'] = "Wypełnij to pole";
    } else {
        unset($_SESSION['err_name']);
    }

    //SURNAME CHECK
    $surname = $_POST['surname'];
    if (strlen($surname) < 1) {
        $accept = false;
        $_SESSION['err_surname'] = "Wypełnij to pole";
    } else {
        unset($_SESSION['err_surname']);
    }

    //POSTAL CHECK
    $postal = $_POST['postal'];
    if (strlen($postal) < 1) {
        $accept = false;
        $_SESSION['err_postal'] = "Wypełnij to pole";
    } else {
        unset($_SESSION['err_postal']);
    }

    //CITY CHECK
    $city = $_POST['city'];
    if (strlen($city) < 1) {
        $accept = false;
        $_SESSION['err_city'] = "Wypełnij to pole";
    } else {
        unset($_SESSION['err_city']);
    }

    //ADRESS CHECK
    $adress = $_POST['adress'];
    if (strlen($adress) < 1) {
        $accept = false;
        $_SESSION['err_adress'] = "Wypełnij to pole";
    } else {
        unset($_SESSION['err_adress']);
    }

    //TELEPHONE NR CHECK
    $tel = $_POST['tel'];
    if (strlen($tel) < 1) {
        $accept = false;
        $_SESSION['err_tel'] = "Wypełnij to pole";
    } else {
        unset($_SESSION['err_tel']);
    }

    //TERMS ACCEPT CHECK
    if (!isset($_POST['terms'])) {
        $accept = false;
        $_SESSION['err_terms'] = "Zaakceptuj regulamin";
    } else {
        unset($_SESSION['err_terms']);
    }

    //DATABASE CONNECTION
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            $result = $connection->query("SELECT id FROM users where email='$email'");

            if (!$result) throw new Exception($connection->error);

            $found = $result->num_rows;

            if ($found > 0) {
                $accept = false;
                $_SESSION['err_email'] = "Istnieje już konto o takim adresie";
            }

            $result = $connection->query("SELECT id FROM users where login='$login'");

            if (!$result) throw new Exception($connection->error);

            $found = $result->num_rows;

            if ($found > 0) {
                $accept = false;
                $_SESSION['err_login'] = "Istnieje już konto o takim loginie";
            }

            if ($accept) {

                do {
                    $id = rand(9999999, 99999999);
                    $result = $connection->query("SELECT id FROM users where id='$id'");
                } while ($result->num_rows > 1);

                $password = password_hash($password, PASSWORD_DEFAULT);

                if ($connection->query("INSERT INTO users VALUES('$id','$name','$surname','$postal','$adress','$city','$username','$email','$login','$password','client','$tel')")) {
                    $_SESSION['signup_success'] = true;
                    header('Location: index.php');
                } else {
                    throw new Exception($connection->error);
                }
            }
            $connection->close();
        }
    } catch (Exeption $err) {
        echo '<span style="color:darkred">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
        exit();
    }
}

?>
    <!DOCTYPE html>
    <html lang="pl-PL">
    <head>

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <title> BOIVET - Rejestracja </title>
        <meta charset="utf-8"/>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="mystyle.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>

            .navbar {
                margin-bottom: 0;
                border-radius: 0;
            }

            footer {
                background-color: #f2f2f2;
                padding: 25px;
            }

            .carousel-inner img {
                width: 100%;
                margin: auto;
                min-height: 200px;
            }


        </style>
    </head>
    <body>

    <script>

        $(document).ready(function () {
            $('li.active').removeClass('active');
            $('a[href="' + location.pathname + '"]').closest('li').addClass('active');
        });

    </script>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">STRONA GŁÓWNA</a></li>
                    <li><a href="about.php">O NAS</a></li>
                    <li><a href="services.php">ZAKRES ŚWIADCZEŃ</a></li>
                    <li><a href="contact.php">KONTAKT I DOJAZD</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container text-center gap2">
        <div class="row">

            <div class="col-sm-12">
                <div class="well" id="panel">
                    <p class="logowanie">REJESTRACJA
                    <form method="post">


                        <label>Login:</label>
                        <br>
                        <input type="text" id="password" name="login"
                               value="<?php if (isset($_POST['email'])) echo $_POST['login'] ?>">
                        <br>
                        <?php

                        if (isset($_SESSION['err_login'])) {
                            echo '<p style="color: darkred">' . $_SESSION['err_login'] . '</p>';
                        }

                        ?>
                        <br>
                        <label>E-mail:</label>
                        <br>
                        <input type="text" id="password" name="email"
                               value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>">
                        <br>
                        <?php

                        if (isset($_SESSION['err_email'])) {
                            echo '<p style="color: darkred">' . $_SESSION['err_email'] . '</p>';
                        }

                        ?>
                        <br>
                        <label>Hasło:</label>
                        <br>
                        <input type="password" id="password" name="password">
                        <br>
                        <?php

                        if (isset($_SESSION['err_password'])) {
                            echo '<p style="color: darkred">' . $_SESSION['err_password'] . '</p>';
                        }

                        ?>
                        <br>
                        <label>Powtórz hasło:</label>
                        <br>
                        <input type="password" id="password" name="rePassword">
                        <br>
                        <?php

                        if (isset($_SESSION['err_repassword'])) {
                            echo '<p style="color: darkred">' . $_SESSION['err_repassword'] . '</p>';
                        }

                        ?>
                        <br><br>

                        <label>Dane osobowe:</label>

                        <br><br><br>
                        <label>Nazwa użytkownika:</label>
                        <br>
                        <input type="text" id="password" name="username"
                               value="<?php if (isset($_POST['username'])) echo $_POST['username'] ?>">
                        <br>
                        <?php

                        if (isset($_SESSION['err_username'])) {
                            echo '<p style="color: darkred">' . $_SESSION['err_username'] . '</p>';
                        }

                        ?>
                        <br>
                        <label>Imię:</label>
                        <br>
                        <input type="text" id="password" name="name"
                               value="<?php if (isset($_POST['name'])) echo $_POST['name'] ?>">
                        <br>
                        <?php

                        if (isset($_SESSION['err_name'])) {
                            echo '<p style="color: darkred">' . $_SESSION['err_name'] . '</p>';
                        }

                        ?>
                        <br>
                        <label>Nazwisko:</label>
                        <br>
                        <input type="text" id="password" name="surname"
                               value="<?php if (isset($_POST['surname'])) echo $_POST['surname'] ?>">
                        <br>
                        <?php

                        if (isset($_SESSION['err_surname'])) {
                            echo '<p style="color: darkred">' . $_SESSION['err_surname'] . '</p>';
                        }

                        ?>
                        <br>
                        <label>Kod pocztowy:</label>
                        <br>
                        <input type="text" id="password" name="postal"
                               value="<?php if (isset($_POST['postal'])) echo $_POST['postal'] ?>">
                        <br>
                        <?php

                        if (isset($_SESSION['err_postal'])) {
                            echo '<p style="color: darkred">' . $_SESSION['err_postal'] . '</p>';
                        }

                        ?>
                        <br>
                        <label>Adres zamieszkania:</label>
                        <br>
                        <input type="text" id="password" name="adress"
                               value="<?php if (isset($_POST['adress'])) echo $_POST['adress'] ?>">
                        <br>
                        <?php

                        if (isset($_SESSION['err_adress'])) {
                            echo '<p style="color: darkred">' . $_SESSION['err_adress'] . '</p>';
                        }

                        ?>
                        <br>
                        <label>Miejscowość:</label>
                        <br>
                        <input type="text" id="password" name="city"
                               value="<?php if (isset($_POST['city'])) echo $_POST['city'] ?>">
                        <br>
                        <?php

                        if (isset($_SESSION['err_city'])) {
                            echo '<p style="color: darkred">' . $_SESSION['err_city'] . '</p>';
                        }

                        ?>
                        <br>
                        <label>Nr telefonu:</label>
                        <br>
                        <input type="text" id="password" name="tel"
                               value="<?php if (isset($_POST['tel'])) echo $_POST['tel'] ?>">
                        <br>
                        <?php

                        if (isset($_SESSION['err_tel'])) {
                            echo '<p style="color: darkred">' . $_SESSION['err_tel'] . '</p>';
                        }

                        ?>

                        <br>
                        <label><input type="checkbox" name="terms"> Akceptuję regulamin</label>

                        <br>
                        <?php

                        if (isset($_SESSION['err_terms'])) {
                            echo '<p style="color: darkred">' . $_SESSION['err_terms'] . '</p>';
                        }

                        ?>
                        <br>
                        <div id="lower">
                            <input type="submit" value="ZAREJESTRUJ">
                        </div>
                    </form>
                </div>
                </p>
            </div>
        </div>
    </div>
    </div><br>

    <footer class="container-fluid text-center">
        <p>Inżynieria Oprogramowania</p>
    </footer>

    </body>
    </html>
<?php

if (!@$accept) {
    session_unset();
    unset($_POST);
}

?>