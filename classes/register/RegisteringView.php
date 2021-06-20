<?php
include 'classes/includes.php';

class RegisteringView extends Registering{
    public function showLogin(){
        echo "
            <form method=\"post\" action=\"";echo htmlspecialchars($_SERVER["PHP_SELF"]);echo"\">
                <table>
                    <tr>
                            <td><label for=\"login\">Login</label></td><td><input id=\"login\" name=\"login\" type=\"text\" placeholder=\"Login\"></td>
                    </tr>
                    <tr>
                            <td><label for=\"passwd\">Hasło</label></td><td><input id=\"passwd\" name=\"passwd\" type=\"password\" placeholder=\"Hasło\"></td>
                    </tr>
                    <input type=\"hidden\" name=\"action\" value=\"register\">
                </table>";
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "register") {
            $login = $_POST["login"];
            $passwd = hash('md5',$_POST["passwd"]);
            $result = $this->login($login, $passwd);
            switch ($result){
                case 0:
                    header("Location: index.php");
                    break;
                case 1:
                    echo "<div>Podano zły login</div>";
                    break;
                case 2:
                    echo "<div>Podano złe hasło</div>";
                    break;
            }
        }
        echo "<input class=\"redirBtn\" type=\"submit\" value=\"Zaloguj\">
            </form>
            <form method=\"post\" action=\"";echo htmlspecialchars($_SERVER["PHP_SELF"]);echo"\">
                <input name=\"register\" type=\"number\" value=0 hidden/>
                <input type=\"hidden\" name=\"action\" value=\"change\">
                <input type=\"submit\" value=\"Do rejestracji\" class=\"redirBtn\"/>
            </form>";
        
    }
    public function showRegister(){
        echo "
            <form method=\"post\" action=\"";echo htmlspecialchars($_SERVER["PHP_SELF"]);echo"\">
                <table>
                    <tr>
                        <td><label for=\"login\">Login</label></td><td><input id=\"login\" name=\"login\" type=\"text\" placeholder=\"Login\" required></td>
                    </tr>
                    <tr>
                        <td><label for=\"passwd\">Hasło</label></td><td><input id=\"passwd\" name=\"passwd\" type=\"password\" placeholder=\"Hasło\" required></td>
                    </tr>
                        <td><label for=\"name\">Imię</label></td><td><input id=\"name\" name=\"name\" type=\"text\" placeholder=\"Jan\" required></td>
                    </tr>
                    <tr>
                        <td><label for=\"surname\">Nazwisko</label></td><td><input id=\"surname\" name=\"surname\" type=\"text\" placeholder=\"Kowalski\" required></td>
                    </tr>
                    <tr>
                        <td><label for=\"email\">Email</label></td><td><input id=\"email\" name=\"email\" type=\"text\" placeholder=\"nazwa@adres.com\" required></td>
                    </tr>
                    <tr>
                        <td><label for=\"phone\">Telefon</label></td><td><input id=\"phone\" name=\"phone\" type=\"text\" placeholder=\"+48123456789\" required></td>
                    </tr>
                    <tr>
                        <td><label for=\"address\">Adres</label></td><td><input id=\"address\" name=\"address\" type=\"text\" placeholder=\"Prosta 1\" required></td>
                    </tr>
                    <input type=\"hidden\" name=\"action\" value=\"register\">
                </table>";
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "register") {
            $login = $_POST["login"];
            $passwd = hash('md5',$_POST["passwd"]);
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $address = $_POST["address"];
            $access = 3;
            if(isset($_SESSION["accessType"])){
                $access = $_SESSION["accessType"];
            }
            $rc = new RegisteringController();
            switch($rc->registerValidate($login,$_POST["passwd"],$name,$surname,$email,$phone,$address)){
                case 1:
                    echo "<div>Login może zawierać od 2 do 35 liter lub cyfr, bez znaków specjalnych i spacji.</div>";
                    break;
                case 2:
                    echo "<div>Hasło powinno zawierać minimum 4 znaki (litery, cyfry, znaki specjalne)</div>";
                    break;
                case 3:
                    echo "<div>Imię może zawierać od 2 do 35 liter, bez znaków specjalnych i spacji.</div>";
                    break;
                case 4:
                    echo "<div>Nazwisko może zawierać od 2 do 50 liter, z opcjonalnym myślnikiem.</div>";
                    break;
                case 5:
                    echo "<div>To nie jest poprawny adres email.</div>";
                    break;
                case 6:
                    echo "<div>Numer telefonu powinien rozpoczynać się od znaku '+', następnie 2 cyfry kierunkowe i 9 cyfr numeru telefonu.</div>";
                    break;
                case 7:
                    echo "<div>Adres powinien składać się z liter, myślinka bądź kropki.</div>";
                    break;
                case 0:
                    $result = $this->register($login, $passwd, $name, $surname, $email, $phone, $address, $access);
                    switch ($result){
                        case 0:
                            $_SESSION["register"] = 1;
                            header("Location: index.php");
                            break;
                        case 1:
                            echo "<div>Taki użytkownik już istnieje.</div>";
                            break;
                    }
                    break;
            }
            
        }
        echo"<input class=\"redirBtn\" type=\"submit\" value=\"Zarejestruj\">
            </form>";
        if(!isset($_SESSION["accessType"])){
            echo"<form method=\"post\" action=\"";echo htmlspecialchars($_SERVER["PHP_SELF"]);echo"\">
                <input name=\"register\" type=\"number\" value=1 hidden/>
                <input type=\"hidden\" name=\"action\" value=\"change\">
                <input type=\"submit\" value=\"Do logowania\" class=\"redirBtn\"/>
            </form>";
        }else{
            echo '<input type="button" value="Home" class="redirBtn" onClick="document.location.href=\'./index.php\'" />';
        }
    }
}
