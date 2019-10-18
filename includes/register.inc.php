<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'db_connect.php';
require_once 'psl-config.php';
 
$error_msg = "";
 
if (isset($_POST['username'], $_POST['lastname'], $_POST['firstname'], $_POST['person'], $_POST['email'], $_POST['p'])) { // p vs password ??
    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $person = filter_input(INPUT_POST, 'person', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= 'The email address you entered is not valid';
        header("location:../index.php?path=pages/register_result&error_msg=$error_msg");
    }
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= 'Invalid password configuration';
        header("location:../index.php?path=pages/register_result&error_msg=$error_msg");
    }
 
    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //
 
    $prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // check existing email  
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            $error_msg .= 'A user with this email address already exists.';
                        $stmt->close();
            header("location:../index.php?path=pages/register_result&error_msg=$error_msg");
        }
                $stmt->close();
    } else {
        $error_msg .= 'Database error Line 39';
                $stmt->close();
        header("location:../index.php?path=pages/register_result&error_msg=$error_msg");
    }
 
    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.
 
    if ($error_msg == "") {
        // Create a random salt
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
        // Create salted password 
        $password = hash('sha512', $password . $random_salt);
 
        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, person, lastname, firstname, email, password, salt) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('sssssss', $username, $person, $lastname, $firstname, $email, $password, $random_salt);
            // Execute the prepared query
            if (! $insert_stmt->execute()) {
                header("location:../index.php?path=pages/register_result&error_msg=Registrierung nicht gelungen.");
            }
            header("location:../index.php?path=pages/register_result");
        }
        
    }
}