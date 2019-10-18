<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (login_check($mysqli) == true) { ?>
    <h1>
        Hallo <?php echo htmlentities($_SESSION['firstname']); ?>! <br>
    </h1>
    <p>
        Hier finden Sie eine Übersicht Ihrer Daten und können diese auch ändern.
    </p>
    <br>
    <div class="col-sm-4 col-sm-offset-4">
        <table class="table">
            <tr>
                <td>
                    <strong>Zugangsart</strong>
                </td>
                <td <?php if($_SESSION['access'] == 'user') 
                            echo "class='info'";
                          elseif($_SESSION['access'] == 'admin')
                            echo "class='warning'"; ?> >
                    <?php if($_SESSION['access'] == 'user')
                            echo "<span class='text-info'>Mitglied</span>";
                          elseif($_SESSION['access'] == 'admin')
                            echo "<span class='text-warning'>Administrator</span>"; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Alumnidatenbank</strong>
                </td>
                <td>
                    <?php
                    $user_id = $_SESSION['user_id'];
                    $stmt = $mysqli->prepare("SELECT * FROM alumni WHERE user_id = ?");
                    $stmt->bind_param('s', $user_id);
                    $stmt->execute();
                    $stmt->store_result();
                    
                    if($stmt->num_rows == 0){
                    ?>
                    <a class="btn btn-default" href="index.php?path=pages/alumni/registration" role="button">Einschreiben</a>
                    <?php
                    }
                    else{
                    ?>
                    Registriert! <a href="index.php?path=pages/alumni/home">Zur Alumni-homepage...</a>
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Bibliothek</strong>
                </td>
                <td>
                    <?php
                    /*
                    $stmt = $mysqli->prepare("SELECT * FROM bib_members WHERE user_id = ?");
                    $stmt->bind_param('s', $user_id);
                    $stmt->execute();
                    $stmt->store_result();
                    
                    if($stmt->num_rows == 0){
                     */
                    ?>
                    <a class="btn btn-default" href="#" role="button">Einschreiben</a>
                    <?php
                    /*
                    }
                    else{
                     * bla bla
                    }
                     */
                    ?>
                </td>
            </tr>
        </table>
    </div>
<?php 
}
else { ?>
    <div class="alert alert-danger">
        You are not authorized to access this page. <br>
        Please <a href="index.php?path=pages/login">login</a>.
    </div>

<?php 
} ?>