<h1>Ändern Sie Ihr Passwort</h1>

<?php

// retrieve token
if (isset($_GET["token"]) && preg_match('/^[0-9A-F]{40}$/i', $_GET["token"])) {
    $token = $_GET["token"];
}
else {
    echo "<div class='alert alert-danger'>Ungültiges Einwegpasswort</div>";
}

$query = $mysqli->prepare("SELECT email, time_stamp FROM pw_reset_requests WHERE token = ? LIMIT 1");
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
                            <label for="password" class="col-sm-2 col-sm-offset-1 control-label">Neues Passwort</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password" placeholder="Passwort" name="password">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="confirmpwd" class="col-sm-2 col-sm-offset-1 control-label">Bestätigung</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="confirmpwd" placeholder="Wiederholen Sie das Passwort" name="confirmpwd">
                            </div>
                          </div>
                            <input type="hidden" name="username" value="<?php echo $email; ?>" />
                            <input type="hidden" name="email" value="<?php echo $email; ?>" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <div class="col-sm-offset-1 col-sm-10">
                                <button type="submit" class="btn btn-primary" value="Register"
                                   onclick="return newpwdformhash(this.form,
                                   this.form.password, this.form.confirmpwd);">Änderung speichern</button>
                            </div>
                          </div>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    <?php
        // delete token so it can't be used again
        $query = $mysqli->prepare(
            "DELETE FROM pw_reset_requests WHERE email = ? AND token = ? AND time_stamp = ?"
        );
        $query->bind_param('sss', $email, $token, $timestamp);
        $query->execute();
    }
}
else{
    echo "<div class='alert alert-danger'>Ungültiges Einwegpasswort</div>";
}