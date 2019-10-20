<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(!login_check($mysqli)){
    header('location:index.php?path=pages/login');
}
if($_SESSION['access'] != 'admin'){
    header('location:index.php?path=pages/noaccess');
}

?>

<h1>
    Systemverwaltung
</h1>

<p>
    Hier können Sie das DSA-Hub verwalten.
</p>

<div class='container'>
    <div class='row'>
        <div class='col-sm-6'>
            <h3>
                Kontaktformular
            </h3>
            <table class="table table-hover">
                <thead>
                <th>
                    Ticketnr.
                </th>
                <th>
                    Betreff
                </th>
                <th>
                </th>
                </thead>
                <?php
                $request = $mysqli->prepare('SELECT ticketId, surname, firstname, email, subject, message FROM contactform');
                $request->execute();
                $request->store_result();
                $request->bind_result($ticket_id, $lastname, $firstname, $email, $subject, $message);
                $nr = 0;
                while($request->fetch()){
                    $nr++; ?>
                <tr data-toggle="collapse" data-target=".target<?php echo $nr; ?>">
                    <td>
                        <?php echo $ticket_id; ?>
                    </td>
                    <td>
                        <?php echo $subject; ?>
                    </td>
                    <td>
                        <a class="btn btn-default" href="mailto:<?php echo $email; ?>">Antworten</a>
                    </td>
                </tr>
                <tr>
                    <td class="hiddenRow">
                        <div class="collapse target<?php echo $nr; ?>">
                            <?php echo $lastname; ?> <br>
                            <?php echo $firstname; ?>
                        </div>
                    </td>
                    <td class="hiddenRow" colspan="2">
                        <div class="collapse target<?php echo $nr; ?>">
                            <b>Nachricht:</b> <br>
                            <?php echo $message; ?>
                        </div>
                    </td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <div class='col-sm-6'>
            <h3>
                Alumni-Registrierungsanträge
            </h3>
            <p>
                In Bearbeitung
            </p>
        </div>
    </div>
</div>