<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<h1>Aktivieren Sie Ihr Konto</h1>

<?php

// retrieve token
if (isset($_GET["token"]) && preg_match('/^[0-9A-F]{40}$/i', $_GET["token"])) {
    $token = $_GET["token"];
}
else {
    echo "<div class='alert alert-danger'>Ungültiges Einwegpasswort</div>";
}

$query = $mysqli->prepare("SELECT email, time_stamp FROM registration_requests WHERE token = ? LIMIT 1");
$query->bind_param('s', $token);
$query->execute();
$query->store_result();
$query->bind_result($email, $timestamp);
$query->fetch();
// $query->closeCursor();


if ($query->num_rows == 1) {
    
    // 1 day measured in seconds = 60 seconds * 60 minutes * 24 hours
    $delta = 86400;

    // Check to see if link has expired
    if ($_SERVER["REQUEST_TIME"] - $timestamp > $delta) {
        echo "<div class='alert alert-danger'>Einwegpasswort nicht mehr gültig<br>"
        . "<a href='index.php?path=pages/register_request'>Neues beantragen</a>.</div>";
    }
    else{
        // PROMT USER FOR password, lastname, firstname, person (type), newsletter --- see register.php
        // INSERT TO members
    ?>
        <div class="container col-sm-6 col-sm-offset-3">
            <table class="table table-bordered">
                <tr class="active">
                    <td>
                        <h3 class="text-center"><small>MEINE DATEN</small></h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br>
                        <form class="form-horizontal" action="includes/register.inc.php" method="post" name="login_form">
                          
                          <div class="form-group">
                            <label for="password" class="col-sm-2 col-sm-offset-1 control-label">Passwort</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password" placeholder="Passwort" name="password">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="confirmpwd" class="col-sm-2 col-sm-offset-1 control-label">...Passwort</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="confirmpwd" placeholder="Wiederholen Sie das Passwort" name="confirmpwd">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="lastname" class="col-sm-2 col-sm-offset-1 control-label">Nachname</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="lastname" placeholder="Nachname" name="lastname">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="firstname" class="col-sm-2 col-sm-offset-1 control-label">Vorname</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="firstname" placeholder="Vorname" name="firstname">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="person" class="col-sm-2 col-sm-offset-1 control-label">Kategorie</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="person" name="person">
                                    <option value="student">Schüler</option>
                                    <option value="teacher">Lehrer</option>
                                    <option value="administrative">Verwaltung</option>
                                    <option value="misc">Andere</option>
                                </select>
                            </div>
                          </div>
                            <input type="hidden" name="username" value="<?php echo $email; ?>" />
                            <input type="hidden" name="email" value="<?php echo $email; ?>" />
                            <input type="hidden" name="pw_update" value="FALSE" />
                            <input type="hidden" name="token" value="<?php echo $token; ?>" />
                            <input type="hidden" name="timestamp" value="<?php echo $timestamp; ?>" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <div class="col-sm-offset-1 col-sm-10">
                                <button type="submit" class="btn btn-primary" value="Register"
                                   onclick="return regformhash(this.form,
                                   this.form.username,
                                   this.form.lastname,
                                   this.form.firstname,
                                   this.form.person,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd);">Konto erstellen</button>
                            </div>
                          </div>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    <?php
    }
}
else{
    echo "<div class='alert alert-danger'>Ungültiges Einwegpasswort</div>";
}