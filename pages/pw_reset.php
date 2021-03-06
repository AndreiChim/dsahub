<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'includes/db_connect.php';

if(isset($_POST['requestsubmit'])){
    if(isset($_POST['requestemail'])){
        $requestemail = $_POST['requestemail'];
        $requestemail = sanitizeInput($requestemail);
    }
    if(isset($_POST['requestagreement'])){
        $requestagreement = $_POST['requestagreement'];
        $requestagreement = sanitizeInput($requestagreement);
    }
    // Backup server-side validation
    if($requestemail && $requestagreement){
        $check_registered = $mysqli->prepare('SELECT * FROM members WHERE email = ?');
        $email = $requestemail;
        $check_registered->bind_param('s', $email);
        $check_registered->execute();
        $check_registered->store_result();

        $check_token = $mysqli->prepare('SELECT * FROM pw_reset_requests WHERE email = ? AND time_stamp > ?');
        $email = $requestemail;
        $timestamp_age_limit = $_SERVER['REQUEST_TIME'] - 86400;
        $check_token->bind_param('si', $email, $timestamp_age_limit);
        $check_token->execute();
        $check_token->store_result();

        if($check_registered->num_rows == 0){
            echo "<div class='alert alert-warning'>Wir konnten kein Konto mit dieser Emailadresse finden. <a href='index.php?path=pages/registration_request'>Hier</a> können Sie sich registrieren.</div>";
        }
        elseif($check_token->num_rows != 0){
            echo "<div class='alert alert-warning'>Es existiert bereits ein aktives Einweglink für diese Emailadresse! Bitte überprüfen Sie Ihren Inbox sowie den Spam-Ordner.</div>";
        }
        else{
            $token = sha1(uniqid($requestemail, true));
            $timestamp = $_SERVER["REQUEST_TIME"];

            $query = $mysqli->prepare('INSERT INTO pw_reset_requests (email, token, time_stamp) VALUES(?, ?, ?)');
            $query->bind_param('ssi', $requestemail, $token, $timestamp);
            if($query->execute()){
                $url = "alumni.host.winw.de/index.php?path=pages/pw_new&token=$token";
                $message =
                    "Hallo!
                    
Wir haben einen Antrag über die Zurücksetzung Ihres Passworts bekommen. Bitte klicken Sie auf folgendes Link

$url

um ein neues Passwort einzugeben. Dieses Link ist nur in den nächsten 24 Stunden aktiv.

Falls Sie diesen Antrag nicht gestellt oder versehentlich gestellt haben, bitte ignorieren Sie diese Email.

Mit freundlichen Grüßen

Ihr DSA Team";
                mail($requestemail, "Ihr DSA-Hub Konto", $message, "From: DSA Bukarest <alumni@host.winw.de>");

                echo "<div class='alert alert-success'>Die Daten wurden erfolgreich gespeichert. Sie werden in kürzester Zeit eine E-Mail bekommen!</div>";
            }
            else{
                echo "<div class='alert alert-danger'>Ein Fehler ist eingetreten. Bitte kontaktieren Sie den <a href='mailto:andrei.bubeneck@yahoo.com'>Administrator!</a></div>";
            }
        }
    }
    else{
        echo "<div class='alert alert-danger'>Error: Füllen Sie alle benötigten Felder aus!</div>";
    }
}

?>

<h1>
    Passwort zurücksetzen
</h1>
<p>
    Haben Sie Ihr Passwort vergessen? Kein Problem! Geben Sie uns Ihre Email-Adresse und wir schicken Ihnen weitere Anweisungen, um Ihr Passwort zurückzusetzen.
</p>
<div class="alert alert-info">
    Sie kriegen per Email ein einmalig verwendbares Link, das Ihnen ermöglicht, ein neues Passwort auszuwählen.
</div>
<div class="container col-sm-6 col-sm-offset-3">
    <table class="table table-bordered">
        <tr class="active">
            <td>
                <h3 class="text-center"><small>PASSWORT ZURÜCKSETZEN</small></h3>
            </td>
        </tr>
        <tr>
            <td>
                <br>
                <form class="form-horizontal" id="contactform" action="index.php?path=pages/pw_reset" method="post">
                    <div class="form-group">
                        <label for="requestemail" class="col-sm-2 col-sm-offset-1 control-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="requestemail" placeholder="Email" name="requestemail" required>
                        </div>
                    </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="requestagreement" value="yes" required> Ich bin einverstanden, dass die Daten aus diesem Formular
                                für unbegrenzte Zeit gespeichert werden. Sie werden nicht an Dritte weitergegeben. Weitere Informationen finden Sie <a href="index.php?path=pages/legal">hier</a>.
                            </label>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <button type="submit" class="btn btn-primary" name="requestsubmit" value="submit">Senden</button>
                        <a class="btn btn-default" href="index.php?path=pages/pw_reset" role="button">Reset</a>
                    </div>
                </div>
                <input type="hidden" name="requesttype" value="student">
                </form>
            </td>
        </tr>
    </table>
</div>
