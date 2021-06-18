<?php
require "templates/userMenu.html.php";
echo "<input type=\"button\" value=\"Usuń użytkownika\"  class=\"redirBtn\" onClick=\"document.location.href='./usun.php'\" />";
echo "<input type=\"button\" value=\"Zaloguj się jako inny użytkownik\"  class=\"redirBtn\" onClick=\"document.location.href='./zmien.php'\" />";
?>