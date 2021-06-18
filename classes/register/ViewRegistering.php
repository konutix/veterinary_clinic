<?php
include 'classes/includes.php';
session_start();
class ViewRegister extends Registering{
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
                </table>
                <input class=\"redirBtn\" type=\"submit\" value=\"Zaloguj\">
            </form>
            <form method=\"post\" action=\"";echo htmlspecialchars($_SERVER["PHP_SELF"]);echo"\">
                <input name=\"register\" type=\"number\" value=0 hidden/>
                <input type=\"hidden\" name=\"action\" value=\"change\">
                <input type=\"submit\" value=\"Do rejestracji\" class=\"redirBtn\"/>
            </form>";
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "register") {
            $login = $_POST["login"];
            $passwd = hash('md5',$_POST["passwd"]);
            $result = $this->login($login, $passwd);
            switch ($result){
                case 0:
                    header("Location: index.php");
                    break;
                case 1:
                    echo "Podano zły login";
                    break;
                case 2:
                    echo "Podano złe hasło";
                    break;
            }
        }
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
                </table>
                <input class=\"redirBtn\" type=\"submit\" value=\"Zarejestruj\">
            </form>
            <form method=\"post\" action=\"";echo htmlspecialchars($_SERVER["PHP_SELF"]);echo"\">
                <input name=\"register\" type=\"number\" value=1 hidden/>
                <input type=\"hidden\" name=\"action\" value=\"change\">
                <input type=\"submit\" value=\"Do logowania\" class=\"redirBtn\"/>
            </form>";
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "register") {
            $login = $_POST["login"];
            $passwd = $_POST["passwd"];
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $address = $_POST["address"];
            $result = $this->register($login, $passwd, $name, $surname, $email, $phone, $address);
            switch ($result){
                case 0:
                    header("Location: index.php");
                    break;
                case 1:
                    print "Taki użytkownik już istnieje.";
            }
        }
    }
}
