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

$group_id = $_GET['group_id'];
$group_id = sanitizeInput($group_id);

$check_group = $mysqli->prepare('SELECT * FROM int_alumni_groups WHERE alumn_id = ? AND group_id = ?');
$check_group->bind_param('ss', $alumn_id, $group_id);
$check_group->execute();
$check_group->store_result();

$get_group_name = $mysqli->prepare('SELECT group_name, group_description FROM groups WHERE group_id = ?'); 
$get_group_name->bind_param('s', $group_id);
$get_group_name->execute();
$get_group_name->store_result();
$get_group_name->bind_result($group_name, $group_description);
$get_group_name->fetch();

if(isset($_POST['joingroup'])){
    $join_group = $mysqli->prepare('INSERT INTO int_alumni_groups (alumn_id, group_id) VALUES (?, ?)');
    $join_group->bind_param('ss', $alumn_id, $group_id);
    $join_group->execute();
    header("location:index.php?path=pages/alumni/group&group_id=$group_id");
}

if(isset($_POST['searchtype']) && isset($_POST['search'])){
    $searchtype = $_POST['searchtype'];
    $searchtype = sanitizeInput($searchtype);
    $search = $_POST['search'];
    $search = sanitizeInput($search);
    header("location:index.php?path=pages/alumni/group&group_id=$group_id&searchtype=$searchtype&search=$search");
}

?>

<a href='index.php?path=pages/alumni/home'>&laquo; Zurück zur Alumni-Homepage</a>
<h1>
    Gruppe: <?php echo $group_name; if($check_group->num_rows == 1) echo "<br><span class='label label-success'>Mitglied</span>";
                                    else{ ?>
    <form id="joingroup" action="index.php?path=pages/alumni/group&group_id=<?php echo $group_id; ?>" method="post">
        <button type="submit" class="btn btn-primary" name="joingroup" value="joingroup">Mitglied werden</button>
    </form>
    <?php
                                    }
    ?>
</h1>

<h3>
    Beschreibung
</h3>
<p>
    <?php 
    echo $group_description;
    if(($check_group->num_rows == 1 || $_SESSION['access'] == 'admin')){
        if(isset($_POST['change'])) {?>
        <form id='group_description' action="index.php?path=pages/alumni/group&group_id=<?php echo $group_id; ?>" method="post">
            <textarea class="form-control" id="message" placeholder="Beschreibung" rows="5" name="description" required><?php echo $group_description; ?></textarea>
            <br><button type="submit" class="btn btn-default">Ändern</button>
        </form>
    <?php
        }
        elseif(isset($_POST['description'])){
            $description = $_POST['description'];
            $description = sanitizeInput($description);
            echo $description;
            $change_description = $mysqli->prepare('UPDATE groups SET group_description = ? WHERE group_id = ?');
            $change_description->bind_param('ss', $description, $group_id);
            $change_description->execute();
            echo "<div class='alert alert-success'>Beschreibung der Gruppe erfolgreich geändert!<br><a href='index.php?path=pages/alumni/group&group_id=$group_id'>Aktualisieren...</a></div>";
        }
        else{ ?>
        <form id="description_change" action="index.php?path=pages/alumni/group&group_id=<?php echo $group_id; ?>" method="post">
            <button type="submit" class="btn btn-default" name="change">Ändern</button>
        </form>
    <?php
        }
    }
    ?>
</p>

<h3>
    Mitglieder
</h3>
<div class="container">
    <div class='row'>
        <div class="col-sm-6">
            Ordnen nach:
            <form id="orderby" action="index.php?path=pages/alumni/group&group_id=<?php echo $group_id; ?>" method="post">
                <select name="order_by">
                    <option value="lastname">Nachname</option>
                    <option value="firstname">Vorname</option>
                    <option value="person">Kategorie</option>
                    <option value="section">Primärgruppe</option>
                    <option value="year_in">Ankunftsjahr</option>
                    <option value="year_out">Abgangsjahr</option>
                    <option value="country">Land</option>
                    <option value="city">Stadt</option>
                    <option value="occupation_type">Beschäftigungsart</option>
                    <option value="occupation">Beschäftigung</option>
                </select>
                <button type="submit" class="btn btn-default">Ordnen</button>
            </form>
        </div>
        <div class="col-sm-6">
            Schnelle Suche:
            <form id="simplesearch" action="index.php?path=pages/alumni/group&group_id=<?php echo $group_id; ?>" method="post">
                <select name="searchtype">
                    <option value="lastname">Nachname</option>
                    <option value="firstname">Vorname</option>
                    <option value="person">Kategorie</option>
                    <option value="section">Primärgruppe</option>
                    <option value="year_in">Ankunftsjahr</option>
                    <option value="year_out">Abgangsjahr</option>
                    <option value="country">Land</option>
                    <option value="city">Stadt</option>
                    <option value="occupation_type">Beschäftigungsart</option>
                    <option value="occupation">Beschäftigung</option>
                </select>
                <input type="text" name="search" required />
                <button type="submit" class="btn btn-default">Suchen</button>
            </form>
        </div>
    </div>
</div>

<br>
<table class="table table-hover">
    <thead>
        <th>
            Nr.
        </th>
        <th>
            Name
        </th>
        <th>
            Vorname
        </th>
        <th>
            Kategorie
        </th>
        <th>
            Primärgruppe
        </th>
        <th>
            Ankunftsjahr
        </th>
        <th>
            Abgangsjahr
        </th>
        <th>
            
        </th>
    </thead>
    <?php
    $order_by = 'alumni.lastname';
    if(isset($_POST['order_by'])){
        $order_by = $_POST['order_by'];
        $order_by = sanitizeInput($order_by);
        $order_by = 'alumni.'.$order_by;
    }
    
    $count_rows = $mysqli->prepare('SELECT COUNT(*) FROM int_alumni_groups WHERE group_id = ?');
    $count_rows->bind_param('s', $group_id);
    $count_rows->execute();
    $count_rows->store_result();
    $count_rows->bind_result($total);
    $count_rows->fetch();

    $limit = 10;
    
    if(isset($_GET['page'])){
        $page = sanitizeInput($_GET['page']);
    }
    else{
        $page = 1;
    }
    $offset = ($page - 1) * $limit;
    
    if(isset($_GET['searchtype']) && isset($_GET['search'])){
        $searchtype = $_GET['searchtype'];
        $searchtype = sanitizeInput($searchtype);
        $search = $_GET['search'];
        $search = sanitizeInput($search);
        $search = $search.'%';
        $alumn = $mysqli->prepare('SELECT alumni.alumn_id FROM int_alumni_groups JOIN alumni ON int_alumni_groups.alumn_id = alumni.alumn_id WHERE group_id = ? AND '.$searchtype.' LIKE ? ORDER BY '.$order_by.' LIMIT '.$limit.' OFFSET '.$offset);
        $alumn->bind_param('ss', $group_id, $search);
        
        $count_rows = $mysqli->prepare('SELECT COUNT(*) FROM int_alumni_groups JOIN alumni ON int_alumni_groups.alumn_id = alumni.alumn_id WHERE group_id = ? AND '.$searchtype.' LIKE ? ');
        $count_rows->bind_param('ss', $group_id, $search);
        $count_rows->execute();
        $count_rows->store_result();
        $count_rows->bind_result($total);
        $count_rows->fetch();
    }
    else{
        $alumn = $mysqli->prepare('SELECT alumni.alumn_id FROM int_alumni_groups JOIN alumni ON int_alumni_groups.alumn_id = alumni.alumn_id WHERE group_id = ? ORDER BY '.$order_by.' LIMIT '.$limit.' OFFSET '.$offset);
        $alumn->bind_param('s', $group_id);
    }
    
    $pages = ceil($total / $limit);
    
    $alumn->execute();
    $alumn->store_result();

    $alumn->bind_result($alumn_id);
    $nr = $page * $limit - $limit;
    
    while($alumn->fetch()){
        $nr++;
        $alumn_details = $mysqli->prepare('SELECT lastname, firstname, person, section, year_in, year_out, country, city, occupation_type, occupation, telephone, description, contact_agree FROM alumni WHERE alumn_id = ?');
        $alumn_details->bind_param('s', $alumn_id);
        $alumn_details->execute();
        $alumn_details->store_result();
        $alumn_details->bind_result($lastname, $firstname, $person, $section, $year_in, $year_out, $country, $city, $occupation_type, $occupation, $telephone, $description, $contact_agree);
        $alumn_details->fetch(); ?>
    <tr data-toggle="collapse" data-target=".target<?php echo $nr; ?>">
        <td>
            <?php echo $nr; ?>
        </td>
        <td>
            <?php echo $lastname; ?>
        </td>
        <td>
            <?php echo $firstname; ?>
        </td>
        <td>
            <?php if($person == 'student') echo 'Schüler'; elseif($person == 'teacher') echo 'Lehrer'; else echo 'Verwaltung'; ?>
        </td>
        <td>
            <?php echo $section; ?>
        </td>
        <td>
            <?php echo $year_in; ?>
        </td>
        <td>
            <?php if($year_out == 0) echo 'Noch an der Schule'; else echo $year_out; ?>
        </td>
        <td>
            <?php
            if($contact_agree == 'YES'){ ?>
            <a class="btn btn-default" href="index.php?path=pages/alumni/message&type=person&recipient=<?php echo $alumn_id; ?>">Nachricht</a>
            <?php
            } ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="hiddenRow">
            <div class="collapse target<?php echo $nr; ?>">
                <b>Telefonnummer</b>: <br>
                <?php echo $telephone; ?>
            </div>
        </td>
        <td colspan="2" class="hiddenRow">
            <div class="collapse target<?php echo $nr; ?>">
                <b>Land:</b> <?php echo $country; ?><br>
                <b>Stadt:</b> <?php echo $city; ?>
            </div>
        </td>
        <td class="hiddenRow">
            <div class="collapse target<?php echo $nr; ?>">
                <b>Beschäftigungsart:</b> <br>
                <?php echo $occupation_type; ?><br>
                <b>Beschäftigung:</b> <br>
                <?php echo $occupation; ?>
            </div>
        </td>
        <td colspan="3" class="hiddenRow">
            <div class="collapse target<?php echo $nr; ?>">
                <b>Persönliche Beschreibung:</b> <br>
                <?php echo $description; ?>
            </div>
        </td>
    </tr>
    <?php
    }
    ?>
</table>
<?php
if($total > $limit){ 
    if(isset($_GET['searchtype']) && isset($_GET['search'])){ ?>

<nav aria-label="Page navigation">
  <ul class="pagination">
    <li>
      <a href="index.php?path=pages/alumni/group&group_id=<?php echo $group_id ?>&searchtype=<?php echo $searchtype; ?>&search=<?php echo $search; ?>&page=1" aria-label="First page">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li>
      <a href="index.php?path=pages/alumni/group&group_id=<?php echo $group_id ?>&searchtype=<?php echo $searchtype; ?>&search=<?php echo $search; ?>&page=<?php if($page > 1) echo $page-1; else echo 1; ?>" aria-label="Previous page">
        <span aria-hidden="true">&lsaquo;</span>
      </a>
    </li>
    <?php
    for($i = 1; $i <= $pages; $i++){
        if($i == $page){
            echo "<li class='active'><a href='index.php?path=pages/alumni/group&group_id=".$group_id."&searchtype=".$searchtype."&search=".$search."&page=".$i."'>".$i."</a></li>";
        }
        else{
            echo "<li><a href='index.php?path=pages/alumni/group&group_id=".$group_id."&searchtype=".$searchtype."&search=".$search."&page=".$i."'>".$i."</a></li>";
        }   
    }
    ?>
    <li>
      <a href="index.php?path=pages/alumni/group&group_id=<?php echo $group_id ?>&searchtype=<?php echo $searchtype; ?>&search=<?php echo $search; ?>&page=<?php if($page < $pages) echo $page + 1; else echo $pages; ?>" aria-label="Next page">
        <span aria-hidden="true">&rsaquo;</span>
      </a>
    </li>
    <li>
      <a href="index.php?path=pages/alumni/group&group_id=<?php echo $group_id ?>&searchtype=<?php echo $searchtype; ?>&search=<?php echo $search; ?>&page=<?php echo $pages; ?>" aria-label="Last page">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
    <?php
    }
    else{ ?>

<nav aria-label="Page navigation">
  <ul class="pagination">
    <li>
      <a href="index.php?path=pages/alumni/group&group_id=<?php echo $group_id ?>&page=1" aria-label="First page">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li>
      <a href="index.php?path=pages/alumni/group&group_id=<?php echo $group_id ?>&page=<?php if($page > 1) echo $page-1; else echo 1; ?>" aria-label="Previous page">
        <span aria-hidden="true">&lsaquo;</span>
      </a>
    </li>
    <?php
    for($i = 1; $i <= $pages; $i++){
        if($i == $page){
            echo "<li class='active'><a href='index.php?path=pages/alumni/group&group_id=".$group_id."&page=".$i."'>".$i."</a></li>";
        }
        else{
            echo "<li><a href='index.php?path=pages/alumni/group&group_id=".$group_id."&page=".$i."'>".$i."</a></li>";
        }
    }
    ?>
    <li>
      <a href="index.php?path=pages/alumni/group&group_id=<?php echo $group_id ?>&page=<?php if($page < $pages) echo $page + 1; else echo $pages; ?>" aria-label="Next page">
        <span aria-hidden="true">&rsaquo;</span>
      </a>
    </li>
    <li>
      <a href="index.php?path=pages/alumni/group&group_id=<?php echo $group_id ?>&page=<?php echo $pages; ?>" aria-label="Last page">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
<?php
    }
} ?>