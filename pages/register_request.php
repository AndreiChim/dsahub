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
        $token = sha1(uniqid($requestemail, true));
        $timestamp = $_SERVER["REQUEST_TIME"];
        
        $tbl_name = 'registration_requests';
        $query = "INSERT INTO $tbl_name (email, token, timestamp) VALUES('$requestemail', '$token', '$timestamp')";
        $result = mysqli_query($mysqli, $query);
        if($result){
            $url = "alumni.host.winw.de/index.php?path=pages/activate&token=$token";
            $message =
            "Danke für Ihren Antrag. Bitte klicken Sie auf folgendes Link

$url

um Ihren Konto zu aktivieren";
            mail($requestemail, "Ihr DSA-Hub Konto", $message, "From: DSA Bukarest <alumni@host.winw.de>");
            
            echo "<div class='alert alert-success'>Die Daten wurden erfolgreich gespeichert. Sie werden in kürzester Zeit eine E-Mail bekommen!</div>";
        }
        else{
            echo "<div class='alert alert-danger'>Ein Fehler ist eingetreten. Bitte kontaktieren Sie den <a href='mailto:andrei.bubeneck@yahoo.com'>Administrator!</a></div>";
        }
    }
    else{
        echo "<div class='alert alert-danger'>Error: Füllen Sie alle benötigten Felder aus!</div>";
    }
}

?>

<h1>
    Registrierung beantragen
</h1>
<p>
    Hier können Sie die Registrierung eines neuen Benutzers beantragen.
</p>
<div class="alert alert-info">
    Die Zugangsdaten werden Ihnen per Email geschickt.
</div>
<div class="container col-sm-6 col-sm-offset-3">
    <table class="table table-bordered">
        <tr class="active">
            <td>
                <h3 class="text-center"><small>REGISTRIERUNGSANTRAG</small></h3>
            </td>
        </tr>
        <tr>
            <td>
                <br>
                <form class="form-horizontal" id="contactform" action="index.php?path=pages/register_request" method="post">
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
                      <a class="btn btn-default" href="index.php?path=pages/register_request" role="button">Reset</a>
                    </div>
                  </div>
                <input type="hidden" name="requesttype" value="student">
                </form>
            </td>
        </tr>
    </table>
</div>