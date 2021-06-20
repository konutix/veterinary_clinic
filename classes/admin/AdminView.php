<?php
include 'classes/includes.php';
class AdminView extends AdminModel{
    public function showChooseUser(){
        $users = null;
        echo "
            <div>
            Filtruj użytkowników:
            </div>
            <form method=\"post\" action=\"";echo htmlspecialchars($_SERVER["PHP_SELF"]);echo"\">
                <table>
                    <tr>
                        <td><label for=\"login\">Login</label></td><td><input id=\"login\" name=\"login\" type=\"text\" placeholder=\"Login\"></td>
                    </tr>
                    <tr>
                        <td><label for=\"name\">Imię</label></td><td><input id=\"name\" name=\"name\" type=\"text\" placeholder=\"Jan\"></td>
                    </tr>
                    <tr>
                        <td><label for=\"surname\">Nazwisko</label></td><td><input id=\"surname\" name=\"surname\" type=\"text\" placeholder=\"Kowalski\"></td>
                    </tr>
                    <tr>
                        <td><label for=\"accessType\">Typ użytkownika</label></td><td>
                            <select id=\"accessType\" name=\"accessType\">
                                <option value=\"all\">Wszyscy</option>
                                <option value=\"client\">Klient</option>
                                <option value=\"vet\">Weterynarzy</option>
                            </select>
                        </td>
                    </tr>
                </table>";
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "search") {
            $login = $_POST["login"];
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $access = $_POST["accessType"];
            $control = new AdminController();
            $access = $control->accessToNumber($access);
            $search = $this->getSearch($login,$name,$surname,$access);
            $users=null;
            echo"<div>";
            switch($control->validateSearch($search)){
                case 0:
                    $users = $this->getUsers($search);
                    break;
                case 1:
                    echo"Login może zawierać od 2 do 35 liter lub cyfr, bez znaków specjalnych i spacji.";
                    break;
                case 2:
                    echo"Imię może zawierać od 2 do 35 liter, bez znaków specjalnych i spacji.";
                    break;
                case 3:
                    echo"Nazwisko może zawierać od 2 do 50 liter, z opcjonalnym myślnikiem.";
                    break;
            }
        }
        echo"</div>
                <input type=\"hidden\" name=\"action\" value=\"search\">
                <input class=\"redirBtn\" type=\"submit\" value=\"Wyszukaj\">
            </form>";
        if($users != null){
            echo"
                <table>
                    <tr>
                        <td>ID</td><td>Login</td><td>Imię</td><td>Nazwisko</td><td>Typ użytkownika</td><td>Modyfikuj użytkownika</td><td>Usuń użytkownika</td>
                    <tr>";
            for($i=0; $i<count($users);$i++){
                echo"
                    <tr>
                        <td>".$users[$i]["ID"].
                        "</td><td>".$users[$i]["login"].
                        "</td><td>".$users[$i]["name"].
                        "</td><td>".$users[$i]["surname"].
                        "</td><td>";
                if($users[$i]["access"]==2){
                    echo"Weterynarz";
                }else if($users[$i]["access"]==3){
                    echo"Klient";
                }
                echo"
                    <form method=\"post\" action=\"";echo htmlspecialchars($_SERVER["PHP_SELF"]);echo"\">
                        <input type=\"hidden\" name=\"action\" value=\"modify\">
                        <input type=\"hidden\" name=\"id\" value=\"".$users[$i]["ID"]."\">
                        <input type=\"hidden\" name=\"access\" value=\"".$users[$i]["access"]."\">
                        <td><input id=\"modify\" name=\"modify\" type=\"submit\" value=\"Modyfikuj użytkownika\"></td>
                    </form>
                    <form method=\"post\" action=\"";echo htmlspecialchars($_SERVER["PHP_SELF"]);echo"\">
                        <input type=\"hidden\" name=\"action\" value=\"delete\">
                        <input type=\"hidden\" name=\"id\" value=\"".$users[$i]["ID"]."\">
                        <td><input id=\"delete\" name=\"delete\" type=\"submit\" value=\"Usuń użytkownika\"></td>
                    </form>";
                echo"</tr>";
            }
            echo"</table>";
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "modify") {
            $_SESSION["originalAccess"] = $_SESSION["access"];
            $_SESSION["originalID"] = $_SESSION["userID"];
            $_SESSION["access"] = $_POST["access"];
            $_SESSION["userID"] = $_POST["id"];;
            header("Location: ./index.php");
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "delete"){
            $db = new DbConnect();
            $db->connect();
            $query="UPDATE users SET depracated = true WHERE ID = ".$_POST["id"];
            $db->query($query);
        }
    }
}