<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="container">
    <h1>
        Einloggen
    </h1>
    <p>
        Loggen Sie sich ein, um Zugang zu weiteren Daten zu
        bekommen, die wir aus rechtlichen oder praktischen Gründen nicht ohne
        Verifizierung veröffentlichen können.
    </p>
    <br>
    <?php
    if (isset($_GET['loginerror'])) {
        echo '<div class="alert alert-danger">Fehler beim Einloggen! Bitte versuchen Sie noch einmal!</div>';
    }
    ?> 
    <div class="container col-sm-6 col-sm-offset-3">
        <table class="table table-bordered">
            <tr class="active">
                <td>
                    <h3 class="text-center"><small>LOGINFORMULAR</small></h3>
                </td>
            </tr>
            <tr>
                <td>
                    <br>
                    <form class="form-horizontal" action="includes/process_login.php" method="post" name="login_form">
                      <div class="form-group">
                        <label for="loginEmail" class="col-sm-2 col-sm-offset-1 control-label">Email</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="loginEmail" placeholder="Email" name="email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="loginPassword" class="col-sm-2 col-sm-offset-1 control-label">Passwort</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="loginPassword" placeholder="Passwort" name="password"><br>
                            <p><a href="index.php?path=pages/pw_reset">Passwort vergessen...</a></p>
                        </div>
                      </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-10">
                            <button type="submit" class="btn btn-primary" onclick="formhash(this.form, this.form.password);">Einloggen</button>
                        </div>
                      </div>
                    </form>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="container">
    <?php
    if (login_check($mysqli) == true) {
        echo '<h4>Momentan als ' . htmlentities($_SESSION['username']) . ' eingeloggt.</h4>';
        echo '<h4>Wollen Sie den Benutzer wechseln? <a href="includes/logout.php">Loggen Sie sich aus.</a>.</h4>';
    } 
    else {
        echo "<p>Wenn Sie keine Zugangsdaten besitzen, stellen Sie einen <a href='index.php?path=pages/register_request'>Registrierungsantrag</a>.</p>";
    }
    ?>
</div>