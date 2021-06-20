<?php
     echo   '
            <tr>
                <th>Zmiana danych kontaktowych</th>
            </tr>
            <tr>
                <th>"'.$userData['login'].'"</th>
            </tr>
            
            <form action="?action=changeData" method="post">
        <tr>
            <td>Email: <input type="text" name="email" value="'.$userData['email'].'"></td>
        </tr>
        <tr>
            <td>Imię: <input type="text" name="name" value="'.$userData['name'].'"></td>
        </tr>
        <tr>
            <td>Nazwisko: <input type="text" name="surname" value="'.$userData['surname'].'"></td>
        </tr>
        <tr>
            <td>Nr telefonu: <input type="text" name="phone" value="'.$userData['phone'].'"></td>
        </tr>
        <tr>
            <td>Adres: <input type="text" name="address" value="'.$userData['address'].'"></td>
        </tr>
        <tr>
            <td>
                <input class=button type="submit" value="Zmień" />
            </td>
            </tr>
            </form>';
?>