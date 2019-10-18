<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$check_alumni = $mysqli->prepare('SELECT alumn_id, email, lastname, firstname, person, section, country, city, telephone, occupation_type, occupation, year_in, year_out, description, mailing_subscription, contact_agree FROM alumni WHERE user_id = ?');
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
$check_alumni->bind_result($alumn_id, $email, $lastname, $firstname, $person, $section, $country, $city, $telephone, $occupation_type, $occupation, $year_in, $year_out, $description, $mailing_subscription, $contact_agree);
$check_alumni->fetch();

if(isset($_POST['leave'])){
    $group_id = $_POST['group_id'];
    $group_id = sanitizeInput($group_id);
    $leave_group = $mysqli->prepare('DELETE FROM int_alumni_groups WHERE alumn_id = ? AND group_id = ?');
    $leave_group->bind_param('ss', $alumn_id, $group_id);
    $leave_group->execute();
}

if(isset($_POST['message'])){
    $group_id = $_POST['group_id'];
    $group_id = sanitizeInput($group_id);
    header("location:index.php?path=pages/alumni/message&type=group&recipient=$group_id");
}

?>

<h1>
    Wilkommen zur Alumnidatenbank der Deutschen Spezialabteilung aus Bukarest!
</h1>
<p>
    Hier können Sie in Kontakt mit anderen gegenwärtigen und ehmaligen Mitgliedern der DSA in Kontakt bleiben.
</p>

<div class='container'>
    <div class='row'>
        <div class='col-sm-6'>
            <h3>Mein Profil</h3>
            <a href="index.php?path=pages/alumni/editprofile&alumn_id=<?php echo $alumn_id; ?>">Bearbeiten...</a>
            <br><br>
            <table class="table">
                <tr>
                    <td>
                        <b>Name</b>
                    </td>
                    <td>
                        <?php echo $lastname; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Vorname</b>
                    </td>
                    <td>
                        <?php echo $firstname; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Email</b>
                    </td>
                    <td>
                        <?php echo $email; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Telefonnummer</b>
                    </td>
                    <td>
                        <?php echo $telephone; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Land</b>
                    </td>
                    <td>
                        <?php echo $country; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Stadt</b>
                    </td>
                    <td>
                        <?php echo $city; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Kategorie</b>
                    </td>
                    <td>
                        <?php if($person == 'student') echo 'Schüler'; elseif($person == 'teacher') echo 'Lehrer'; else echo 'Verwaltung'; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Primärgruppe</b>
                    </td>
                    <td>
                        <?php echo $section; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Zeit an der DSA</b>
                    </td>
                    <td>
                        <?php if($year_out != 0 ) echo $year_in.' - '.$year_out; else echo 'Seit '.$year_in; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Beschäftigungsgruppe</b>
                    </td>
                    <td>
                        <?php echo $occupation_type; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Beschäftigung</b>
                    </td>
                    <td>
                        <?php echo $occupation; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Kann Nachrichten von <br> anderen Benutzern bekommen?</b>
                    </td>
                    <td>
                        <?php if($contact_agree == 'YES') echo 'Ja'; else echo 'Nein'; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>An der Newsletter abonniert?</b>
                    </td>
                    <td>
                        <?php if($mailing_subscription == 'YES') echo 'Ja'; else echo 'Nein'; ?>
                    </td>
                </tr>
            </table>
            <h3>
                Meine persönliche Beschreibung
            </h3>
            <p>
                <?php echo $description; ?>
            </p>
        </div>
        <div class='col-sm-6'>
            <h3>Meine Gruppen</h3>
            <a href='index.php?path=pages/alumni/search_groups'>Gruppen finden...</a><br>
            <a href='index.php?path=pages/alumni/create_group'>Gruppe erstellen...</a>
            <table class='table table-hover'>
                <thead>
                    <th>
                        Name
                    </th>
                    <th>
                        Mitglieder
                    </th>
                    <th>
                        
                    </th>
                </thead>
                <?php
                $group = $mysqli->prepare('SELECT group_id FROM int_alumni_groups WHERE alumn_id = ?');
                $group->bind_param('s', $alumn_id);
                $group->execute();
                $group->store_result();
                $group->bind_result($group_id);
                while($group->fetch()){ ?>
                <tr>
                    <td>
                        <?php 
                        $get_group_name = $mysqli->prepare('SELECT group_name FROM groups WHERE group_id = ?'); 
                        $get_group_name->bind_param('s', $group_id);
                        $get_group_name->execute();
                        $get_group_name->store_result();
                        $get_group_name->bind_result($group_name);
                        $get_group_name->fetch();
                        echo "<a href='index.php?path=pages/alumni/group&group_id=".$group_id."'>".$group_name."</a>";
                        ?>
                    </td>
                    <td>
                        <?php echo getGroupSize($group_id); ?>
                    </td>
                    <td>
                        <form id="groupactions" action="index.php?path=pages/alumni/home" method="post">
                            <button type="submit" class="btn btn-default" name="message" value="message">Nachricht</button>
                            <button type="submit" class="btn btn-default" name="leave" value="leave">Verlassen</button>
                            <input type="hidden" name="group_id" value="<?php echo $group_id; ?>" /> 
                        </form>
                    </td>
                </tr>
                <?php
                }
                ?>
            </table>
            <h3>
                Meine Freunde
            </h3>
            <a href="index.php?path=pages/alumni/search_alumni">Alumni finden...</a>
            <h3>
                Meine Veranstaltungen
            </h3>
            <p>In Bearbeitung</p>
        </div>
    </div>
</div>