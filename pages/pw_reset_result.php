<h1>Ändern Sie Ihr Passwort</h1>

<?php

if (!empty($_GET['error_msg'])) {
    $error_msg = $_GET['error_msg'];
    echo "<div class='alert alert-danger'>$error_msg</div>";
}
else{
    echo "<div class='alert alert-success'>Passwort erfolgreich geändert!<br>"
        . "<a href='index.php?path=pages/login'>Zur Login-Seite...</a></div>";
}

?>