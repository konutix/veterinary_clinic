<?php

echo '
        <tr>
            <th>'.$userData['login'].'</th>
        </tr>
        <tr>
            <td>Email: '.$userData['email'].'</td>
        </tr>
        <tr>
            <td>Imię: '.$userData['name'].'</td>
        </tr>
        <tr>
            <td>Nazwisko: '.$userData['surname'].'</td>
        </tr>
        <tr>
            <td>Nr telefonu: '.$userData['phone'].'</td>
        </tr>
        <tr>
            <td>Adres: '.$userData['address'].'</td>
        </tr>
        <tr>
            <td>
                <form action="?action=showChange" method="post">
                    <input class="password-button" type="submit" value="Zmień hasło"/>
                </form>
            </td>
        </tr>';

?>