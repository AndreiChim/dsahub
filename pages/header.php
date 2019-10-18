<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<nav class="navbar navbar-default navbar-fixed-top" id="mainnav" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                DSA Bukarest - The Hub
            </a>
            
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                if(login_check($mysqli) == false){ ?>
                    <li><a href="index.php?path=pages/register_request">Registrierung beantragen</a></li>
                <?php
                } ?>
                <li><a href="index.php?path=pages/contact">Kontakt</a></li>
                <li><a href="index.php?path=pages/legal">Impressum</a></li>
            </ul>
            <!--
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            -->
            <ul class="nav navbar-nav navbar-right">
            <?php
            if(login_check($mysqli) == false){ ?>
                <li><a href="index.php?path=pages/login">Einloggen</a></li>
            <?php
            }
            else{ ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Eingeloggt als <?php echo htmlentities($_SESSION['firstname'])
                        . " " . htmlentities($_SESSION['lastname']); ?><span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="index.php?path=pages/controlpanel">Control Panel</a></li>
                    <?php
                    if($_SESSION['access'] == 'admin'){ ?>
                    <li><a href="index.php?path=pages/admin">Administration</a></li>
                    <?php
                    } ?>
                    <li class="divider"></li>
                    <li><a href="includes/logout.php">Ausloggen</a></li>
                </ul>
                </li>
            <?php
            } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>