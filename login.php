<?php

// Vlozi databazove funkce
require('./database.php');

// Email a heslo z formulare
$email = $_POST['email'];
$password = $_POST['password'];

// Nastartuje pristup k session
session_start();

// Pokusi se vytahnout uzivatele z databaze
$user = get_user_from_database($email);

// Pokud uzivatel s danym e-mailem existuje
if ($user) {

    // A pokud se zadane heslo shoduje
    $verified = password_verify($password, $user['password']);

    if ($verified) {

        // Nastavi do session prihlaseni
        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $user['email'];

        // A presmeruje na hlavni stranku
        header('Location: index.php');
        exit;

    }

}

// Uzivatel s e-mailem neexistoval, nebo se heslo neshodovalo
// Presmerujeme zpatky se zpravou nastavenou v session
$_SESSION['message'] = 'Špatný e-mail nebo heslo!';
header('Location: index.php');
exit;