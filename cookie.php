<?php

require('./database.php');

session_start();

// Zkontroluje, jestli je nastavena cookie pro zapamatovani prihlaseni
if ($_COOKIE['UID']) {

    // Rozdeli text ve tvaru "email:nahodny retezec" do promennych $email a $cookieId
    list($email, $cookieId) = explode(':', $_COOKIE['UID']);

    $user = get_user_from_database($email);

    if ($user) {

        // Overi jestli cookieId souhlasi s ulozenym hashem v databazi
        $verified = password_verify($cookieId, $user['cookie_id']);

        // Pokud ano, nastavi do session prihlaseni
        if ($verified) {
            $_SESSION['logged_in'] = true;
            $_SESSION['email'] = $user['email'];
        }
    }

}