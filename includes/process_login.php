<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'db_connect.php';
require_once 'functions.php';
 
sec_session_start(); // Our custom secure way of starting a PHP session.
 
if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // The hashed password.
 
    if (login($email, $password, $mysqli) == true) {
        // Login success 
        header('Location: ../index.php?path=pages/controlpanel');
    } else {
        // Login failed 
        header('Location: ../index.php?path=pages/login&loginerror=1');
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}