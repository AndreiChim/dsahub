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

if(isset($_POST['creategroup'])){
    $name = $_POST['name'];
    $name = sanitizeInput($name);
    $description = $_POST['description'];
    $description = sanitizeInput($description);
    
    $check_existing = $mysqli->prepare('SELECT * FROM groups WHERE group_name = ?');
    $check_existing->bind_param('s', $name);
    $check_existing->execute();
    $check_existing->store_result();
    
    if($check_existing->num_rows == 0){
        $create = $mysqli->prepare('INSERT INTO groups (group_name, group_description) VALUES (?, ?)');
        $create->bind_param('ss', $name, $description);
        $create->execute();
        $get_group_id = $mysqli->prepare('SELECT group_id FROM groups WHERE group_name = ?');
        $get_group_id->bind_param('s', $name);
        $get_group_id->execute();
        $get_group_id->store_result();
        $get_group_id->bind_result($group_id);
        $get_group_id->fetch();
        
        $link = $mysqli->prepare('INSERT INTO int_alumni_groups (alumn_id, group_id) VALUES (?, ?)');
        $link->bind_param('ss', $alumn_id, $group_id);
        $link->execute();
        
        echo "<div class='alert alert-success' role='alert'>
            Gruppe erfolgreich erstellt!<br>
            <a href='index.php?path=pages/alumni/home'>Zurück zur Alumni-Homepage...</a>
            </div>";
    }
    else{
        echo "<div class='alert alert-danger' role='alert'>
            Eine Gruppe mit diesem Namen existiert schon!
            </div>";
    }
    
    
}

?>

<a href='index.php?path=pages/alumni/home'>&laquo; Zurück zur Alumni-Homepage</a>
<h1>
    Neue Gruppe erstellen
</h1>
<p>
    Hier können Sie eine neue Gruppe erstellen.
</p>
<div class="alert alert-info" role="alert">
    Sie werden automatisch Mitglied jeder Gruppe, die Sie erstellen!
</div>

<div class="container col-sm-6 col-sm-offset-3">
    <table class="table table-bordered">
        <tr class="active">
            <td>
                <h3 class="text-center"><small>GRUPPE ERSTELLEN</small></h3>
            </td>
        </tr>
        <tr>
            <td>
                <br>
                <form class="form-horizontal" id="groupcreate" action="index.php?path=pages/alumni/create_group" method="post">
                  <div class="form-group">
                    <label for="name" class="col-sm-2 col-sm-offset-1 control-label">Gruppen-<br>name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" placeholder="Notwendig" name="name" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="description" class="col-sm-2 col-sm-offset-1 control-label">Beschrei-<br>bung</label>
                      <div class="col-sm-8">
                          <textarea class="form-control" id="description" placeholder="Kurze Beschreibung" rows="4" name="description" maxlength="1000"></textarea>
                      </div>
                  </div>
            </td>
        </tr>
        <tr>
            <td>
                  <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <button type="submit" class="btn btn-primary" name="creategroup" value="creategroup">Erstellen</button>
                      <a class="btn btn-default" href="index.php?path=pages/alumni/create_group" role="button">Reset</a>
                    </div>
                  </div>
                </form>
            </td>
        </tr>
    </table>
</div>