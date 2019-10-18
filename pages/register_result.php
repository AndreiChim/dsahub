<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<h1>Aktivieren Sie Ihr Konto</h1>

<?php

if (!empty($_GET['error_msg'])) {
    $error_msg = $_GET['error_msg'];
    echo "<div class='alert alert-danger'>$error_msg</div>";
}
else{
    echo "<div class='alert alert-success'>Konto erfolgreich erstellt!<br>"
    . "<a href='index.php?path=pages/login'>Zur Login-Seite...</a></div>";
}

?>