<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'includes/db_connect.php';

if(isset($_POST['contactsubmit'])){
    if(isset($_POST['contactsurname'])){
        $contactsurname = $_POST['contactsurname'];
        $contactsurname = sanitizeInput($contactsurname);
    }
    if(isset($_POST['contactfirstname'])){
        $contactfirstname = $_POST['contactfirstname'];
        $contactfirstname = sanitizeInput($contactfirstname);
    }
    if(isset($_POST['contactemail'])){
        $contactemail = $_POST['contactemail'];
        $contactemail = sanitizeInput($contactemail);
    }
    if(isset($_POST['contactsubject'])){
        $contactsubject = $_POST['contactsubject'];
        $contactsubject = sanitizeInput($contactsubject);
    }
    if(isset($_POST['contactmessage'])){
        $contactmessage = $_POST['contactmessage'];
        $contactmessage = sanitizeInput($contactmessage);
    }
    if(isset($_POST['contactagreement'])){
        $contactagreement = $_POST['contactagreement'];
        $contactagreement = sanitizeInput($contactagreement);
    }
    // Backup server-side validation
    if($contactsurname && $contactfirstname && $contactemail && $contactsubject && $contactmessage && $contactagreement){
        $tbl_name = 'contactform';
        $query = "INSERT INTO $tbl_name (surname, firstname, email, subject, message) VALUES('$contactsurname', '$contactfirstname', '$contactemail', '$contactsubject', '$contactmessage')";
        $result = mysqli_query($mysqli, $query);
        if($result){
            echo "<div class='alert alert-success'>Die Daten wurden erfolgreich gespeichert. Wir werden Sie im Kürzesten kontaktieren!</div>";
        }
        else{
            echo "<div class='alert alert-danger'>Ein Fehler ist eingetreten. Bitte kontaktieren Sie den <a href='mailto:andrei.bubeneck@yahoo.com'>Administrator!</a></div>";
        }
    }
    else{
        echo "<div class='alert alert-danger'>Error: Füllen Sie alle Felder aus!</div>";
    }
}

?>

<h1>Kontaktformular</h1>
<p>Haben Sie eine Bemerkung oder Frage? Wir stehen Ihnen immer zur Verfügung!</p>
<br>
<div class="container col-sm-6 col-sm-offset-3">
    <table class="table table-bordered">
        <tr class="active">
            <td>
                <h3 class="text-center"><small>KONTAKTFORMULAR</small></h3>
            </td>
        </tr>
        <tr>
            <td>
                <br>
                <form class="form-horizontal" id="contactform" action="index.php?path=pages/contact" method="post">
                  <div class="form-group">
                    <label for="contactsurname" class="col-sm-2 col-sm-offset-1 control-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="contactsurname" placeholder="Name" name="contactsurname" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="contactfirstname" class="col-sm-2 col-sm-offset-1 control-label">Vorname</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="contactfirstname" placeholder="Vorname" name="contactfirstname" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="contactemail" class="col-sm-2 col-sm-offset-1 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="contactemail" placeholder="Email" name="contactemail" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="contactsubject" class="col-sm-2 col-sm-offset-1 control-label">Betreff</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="contactsubject" placeholder="Betreff" name="contactsubject" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="contactmessage" class="col-sm-2 col-sm-offset-1 control-label">Nachricht</label>
                      <div class="col-sm-8">
                          <textarea class="form-control" id="contactmessage" placeholder="Nachricht" rows="4" name="contactmessage" required></textarea>
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
                          <input type="checkbox" name="contactagreement" value="yes" required> Ich bin damit einverstanden, dass die Daten aus diesem Formular
                          für unbegrenzte Zeit gespeichert werden. Sie werden nie an Dritte weitergegeben werden.
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
                      <button type="submit" class="btn btn-primary" name="contactsubmit" value="submit">Senden</button>
                      <a class="btn btn-default" href="index.php?path=pages/contact" role="button">Reset</a>
                    </div>
                  </div>
                </form>
            </td>
        </tr>
    </table>
</div>