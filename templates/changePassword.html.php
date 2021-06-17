<?php
     echo   '
            <tr>
                <th>Zmiana hasła</th>
            </tr>
            <form action="?action=changePassword" method="post">
            <tr>
                <td>
                <label>Stare hasło: </label>
                <input class=password type="password" name="oldPassword" />
                </td>
            </tr>
            <tr>
                <td>
                <label>Nowe hasło: </label>
                <input class=password type="password" name="newPassword" />
                </td>
            </tr>
            <tr>
                <td>
                <input class=password-button type="submit" value="Zmień" />
            </td>
            </tr>
            </form>';
?>