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

if(isset($_POST['joingroup'])){
    $group_id = $_POST['group_id'];
    $group_id = sanitizeInput($group_id);
    $join_group = $mysqli->prepare('INSERT INTO int_alumni_groups (alumn_id, group_id) VALUES (?, ?)');
    $join_group->bind_param('ss', $alumn_id, $group_id);
    $join_group->execute();
    header("location:index.php?path=pages/alumni/group&group_id=$group_id");
}

if(isset($_POST['search'])){
    $groupname = $_POST['groupname'];
    $groupname = sanitizeInput($groupname);
    header("location: index.php?path=pages/alumni/search_groups&groupname=$groupname");
}

?>

<a href='index.php?path=pages/alumni/home'>&laquo; Zurück zur Alumni-Homepage</a>
<h1>
    Gruppensuche
</h1>
<p>
    Suchen Sie nach Gruppen, in denen Sie sich wohl fühlen
</p>

<div class="container col-sm-6 col-sm-offset-3">
    <table class="table table-bordered">
        <tr class="active">
            <td>
                <h3 class="text-center"><small>GRUPPENSUCHE</small></h3>
            </td>
        </tr>
        <tr>
            <td>
                <br>
                <form class="form-horizontal" id="groupsearch" action="index.php?path=pages/alumni/search_groups" method="post">
                  <div class="form-group">
                    <label for="groupname" class="col-sm-2 col-sm-offset-1 control-label">Gruppen-<br>name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="groupname" placeholder="" name="groupname">
                    </div>
                  </div>
            </td>
        </tr>
        <tr>
            <td>
                  <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <button type="submit" class="btn btn-primary" name="search" value="search">Suchen</button>
                      <a class="btn btn-default" href="index.php?path=pages/alumni/search_groups" role="button">Reset</a>
                    </div>
                  </div>
                </form>
            </td>
        </tr>
    </table>
</div>

<?php

if(isset($_GET['groupname'])){
    

    
    
    $groupname = $_GET['groupname'];
    $groupname = sanitizeInput($groupname);
    $groupname = $groupname."%";
    
    $search = $mysqli->prepare('SELECT group_id, group_name, group_description FROM groups WHERE group_name LIKE ? ');
    $search->bind_param('s', $groupname);
    $search->execute();
    $search->store_result();
    
    $total = $search->num_rows;
    $order_by = 'group_name';
    $limit = 10;
    $pages = ceil($total / $limit);
    if(isset($_GET['page'])){
        $page = min($pages, sanitizeInput($_GET['page']));
    }
    else{
        $page = 1;
    }
    $offset = ($page - 1) * $limit;
    
    $search = $mysqli->prepare('SELECT group_id, group_name, group_description FROM groups WHERE group_name LIKE ? ORDER BY '.$order_by.' LIMIT '.$limit.' OFFSET '.$offset);
    $search->bind_param('s', $groupname);
    $search->execute();
    $search->store_result();
    $search->bind_result($group_id, $group_name, $group_description);

    $nr = $page * $limit - $limit;
    ?>
    
<table class="table table-hover">
    <thead>
        <th>
            Nr.
        </th>
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
    while($search->fetch()){
        $nr++;
        $group_size = getGroupSize($group_id); ?>
    <tr data-toggle="collapse" data-target=".target<?php echo $nr; ?>">
        <td>
            <?php echo $nr; ?>
        </td>
        <td>
            <?php echo "<a href='index.php?path=pages/alumni/group&group_id=".$group_id."'>".$group_name."</a>"; ?>
        </td>
        <td>
            <?php echo $group_size; ?>
        </td>
        <td>
            <?php  
            $check_group = $mysqli->prepare('SELECT * FROM int_alumni_groups WHERE alumn_id = ? AND group_id = ?');
            $check_group->bind_param('ss', $alumn_id, $group_id);
            $check_group->execute();
            $check_group->store_result();
            if($check_group->num_rows == 0){ ?>
            
            <form id="joingroup" action="index.php?path=pages/alumni/group&group_id=<?php echo $group_id; ?>" method="post">
                <button type="submit" class="btn btn-default" name="joingroup" value="joingroup">Mitglied werden</button>
                <input type="hidden" name="group_id" value="<?php echo $group_id; ?>" />
            </form>
            <?php    
            }
            else{
                echo "<a href='index.php?path=pages/alumni/group&group_id=".$group_id."'>Mitglied dieser Gruppe</a>";
            }
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="4" class="hiddenRow">
            <div class="collapse target<?php echo $nr; ?>">
                <b>Beschreibung</b>: <br>
                <?php echo $group_description; ?>
            </div>
        </td>
    </tr>
    
    <?php
    } ?>
</table>
<?php

    if($total > $limit){ ?>

    <nav aria-label="Page navigation">
      <ul class="pagination">
        <li>
          <a href="index.php?path=pages/alumni/search_groups&groupname=<?php echo $groupname; ?>&page=1" aria-label="First page">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li>
          <a href="index.php?path=pages/alumni/search_groups&groupname=<?php echo $groupname; ?>&page=<?php if($page > 1) echo $page-1; else echo 1; ?>" aria-label="Previous page">
            <span aria-hidden="true">&lsaquo;</span>
          </a>
        </li>
        <?php
        for($i = 1; $i <= $pages; $i++){
            if($i == $page){
                echo "<li class='active'><a href='index.php?path=pages/alumni/search_groups&groupname=".$groupname."&page=".$i."'>".$i."</a></li>";
            }
            else{
                echo "<li><a href='index.php?path=pages/alumni/search_groups&groupname=".$groupname."&page=".$i."'>".$i."</a></li>";
            }
        }
        ?>
        <li>
          <a href="index.php?path=pages/alumni/search_groups&groupname=<?php echo $groupname; ?>&page=<?php if($page < $pages) echo $page + 1; else echo $pages; ?>" aria-label="Next page">
            <span aria-hidden="true">&rsaquo;</span>
          </a>
        </li>
        <li>
          <a href="index.php?path=pages/alumni/search_groups&groupname=<?php echo $groupname; ?>&page=<?php echo $pages; ?>" aria-label="Last page">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
    <?php
    } 
}?>