<?php

// Vlozi databazove funkce
require('./database.php');

// E-mail a heslo z formulare
$email = $_POST['email'];
$password = $_POST['password'];

// Zkontroluje, jestli uzivatel s e-mailem uz existuje
$userExists = check_if_user_exists($email);

// Nastartuje pristup k session
session_start();

// Pokud uzivatel existuje
if ($userExists) {

    // Nastavi do session zpravu
    $_SESSION['message'] = "Uživatel s e-mailem $email už existuje";

    // A presmeruje zpatky na hlavni stranku
    header('Location: index.php');
    exit;

} else {

    // Pokud uzivatel s e-mailem neexistuje, ulozi se jeho ucet do databaze
    $hash = password_hash($password, PASSWORD_DEFAULT);
    save_to_database($email, $hash);

    // Do session se nastavi zprava
    $_SESSION['message'] = "Účet $email byl vytvořen";

    // A presmeruje zpatky na hlavni stranku
    header('Location: index.php');
    exit;

}