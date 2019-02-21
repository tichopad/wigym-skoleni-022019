<?php

// Vlozi databazove funkce
require('./database.php');

// Email a heslo z formulare
$email = $_POST['email'];
$password = $_POST['password'];
$remember = $_POST['remember'];

// Nastartuje pristup k session
session_start();

// Pokusi se vytahnout uzivatele z databaze
$user = get_user_from_database($email);

// Pokud uzivatel s danym e-mailem existuje
if ($user) {

    // A pokud se zadane heslo shoduje
    $verified = password_verify($password, $user['password']);

    if ($verified) {

        // Pri zapamatovani prihlaseni nastavi cookie
        if ($remember) {

            // Nahodny retezec (cas + nahodne cislo)
            $cookieId = time() . uniqid();
            // Ulozi nahodny retezec k uzivateli
            save_user_cookie_id($user['email'], $cookieId);
            // Do cookie pak ulozi text ve tvaru "email:nahodny retezec"
            $cookieValue = $user['email'] . ':' . $cookieId;

            // Nastavi cookie
            setcookie('UID', $cookieValue, time() + (3600 * 24 * 30), "/");

        }

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