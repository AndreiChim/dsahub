<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$check_alumni = $mysqli->prepare('SELECT alumn_id FROM alumni WHERE user_id = ?');
$user_id = $_SESSION['user_id'];
$check_alumni->bind_param('s', $user_id);
$check_alumni->execute();
$check_alumni->store_result();

if(!login_check($mysqli)){
    header('location:index.php?path=pages/login');
}
elseif(!$check_alumni->num_rows){
    header('location:index.php?path=pages/alumni/registration');
}
$check_alumni->bind_result($alumn_id);
$check_alumni->fetch();

if(isset($_POST['sendmessage'])){
    $rcpnt = $_POST['rcpnt'];
    $rcpnt = sanitizeInput($rcpnt);
    $to = array();
    $to = unserialize(base64_decode($rcpnt));
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $headers = $_POST['headers'];
    
    $subject = sanitizeInput($subject);
    $message = sanitizeInput($message);
    $headers = sanitizeInput($headers);

    $message = $message."
---
Sie bekommen diese Mail, weil Sie damit einverstanden waren. Wenn Sie solche Mails nicht mehr bekommen wollen, ändern Sie die Einstellungen Ihres Kontos:
alumni.host.winw.de/index.php?path=pages/login";
    
    foreach($to as $rcpnt){
        mail($rcpnt, $subject, $message, $headers);
    }
    echo "<div class='alert alert-success'>Nachricht erfolgreich geschickt!<br>"
    . "<a href='index.php?path=pages/alumni/home'>Zur Alumni-Homepage...</a></div>";
}

$recipient = $_GET['recipient'];
$recipient = sanitizeInput($recipient);

$type = $_GET['type'];
$type = sanitizeInput($type);

if($type == 'group'){
    $get_group_name = $mysqli->prepare('SELECT group_name FROM groups WHERE group_id = ?'); 
    $get_group_name->bind_param('s', $recipient);
    $get_group_name->execute();
    $get_group_name->store_result();
    $get_group_name->bind_result($group_name);
    $get_group_name->fetch();
    
    
    $to = array();
    $group_member = $mysqli->prepare('SELECT alumn_id FROM int_alumni_groups WHERE group_id = ?');
    $group_member->bind_param('s', $recipient);
    $group_member->execute();
    $group_member->store_result();
    $group_member->bind_result($alumn_id);
    while($group_member->fetch()){
        $alumn_email = $mysqli->prepare('SELECT email, contact_agree FROM alumni WHERE alumn_id = ?');
        $alumn_email->bind_param('s', $alumn_id);
        $alumn_email->execute();
        $alumn_email->store_result();
        $alumn_email->bind_result($email, $contact_agree);
        $alumn_email->fetch();
        if($contact_agree == 'YES')
            $to[] = $email;
    }
    $lastname = $_SESSION['lastname'];
    $firstname = $_SESSION['firstname'];
    $headers = "From: ".$firstname." ".$lastname." <alumni@host.winw.de>\r\n ";
    
}
elseif($type == 'person'){
    $get_alumn_name = $mysqli->prepare('SELECT lastname, firstname FROM alumni WHERE alumn_id = ?'); 
    $get_alumn_name->bind_param('s', $recipient);
    $get_alumn_name->execute();
    $get_alumn_name->store_result();
    $get_alumn_name->bind_result($alumn_lastname, $alumn_firstname);
    $get_alumn_name->fetch();
    $alumn_name = $alumn_firstname . " " . $alumn_lastname;
    
    $alumn_email = $mysqli->prepare('SELECT email FROM alumni WHERE alumn_id = ?');
    $alumn_email->bind_param('s', $recipient);
    $alumn_email->execute();
    $alumn_email->store_result();
    $alumn_email->bind_result($email);
    $alumn_email->fetch();
    $to = array();
    $to[] = $email;
    $lastname = $_SESSION['lastname'];
    $firstname = $_SESSION['firstname'];
    $headers = "From: ".$firstname." ".$lastname." <alumni@host.winw.de>\r\n ";
}

?>

<a href='index.php?path=pages/alumni/home'>&laquo; Zurück zur Alumni-Homepage</a>
<h1>
    Nachricht schicken
</h1>
<p>
    Schicken Sie eine Email an eine Person oder an eine Gruppe.
</p>

<div class="container col-sm-6 col-sm-offset-3">
    <table class="table table-bordered">
        <tr class="active">
            <td>
                <h3 class="text-center"><small>NACHRICHT</small></h3>
            </td>
        </tr>
        <tr>
            <td>
                <br>
                <form class="form-horizontal" id="messageform" action="index.php?path=pages/alumni/message&type=<?php echo $type; ?>&recipient=<?php echo $recipient; ?>" method="post">
                  <div class="form-group">
                    <label for="recipient" class="col-sm-2 col-sm-offset-1 control-label">Empfänger</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="recipient" value="<?php if(isset($group_name)) echo $group_name; else echo $alumn_name; ?>" name="contactsurname" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="subject" class="col-sm-2 col-sm-offset-1 control-label">Betreff</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="subject" placeholder="Notwendig" name="subject" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="message" class="col-sm-2 col-sm-offset-1 control-label">Nachricht</label>
                      <div class="col-sm-8">
                          <textarea class="form-control" id="message" placeholder="Notwendig" rows="5" name="message" required></textarea>
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
                          <input type="checkbox" name="agreement" value="yes" required> Ich bin damit einverstanden, dass die Daten aus diesem Formular
                            in unserer Datenbank gespeichert werden. Sie werden nur an die angezeigten Empfänger weitergegeben.
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
                      <button type="submit" class="btn btn-primary" name="sendmessage" value="sendmessage">Senden</button>
                      <a class="btn btn-default" href="index.php?path=pages/alumni/message&type=<?php echo $type; ?>&recipient=<?php echo $recipient; ?>" role="button">Reset</a>
                    </div>
                  </div>
                <input type="hidden" name="rcpnt" value="<?php echo base64_encode(serialize($to)); ?>" />
                <input type="hidden" name="headers" value="<?php echo $headers; ?>" />
                </form>
            </td>
        </tr>
    </table>
</div>