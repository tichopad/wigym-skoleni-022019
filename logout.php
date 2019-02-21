<?php

require('./database.php');

// Nastartuje pristup k session
session_start();

// Odstrani ze session informace o prihlaseni
unset($_SESSION['logged_in']);
unset($_SESSION['email']);

// Smazani cookie
setcookie('UID', null, time() + (3600 * 24 * 30), "/");

// Prida do session zpravu o odhlaseni
$_SESSION['message'] = 'Uživatel byl odhlášen';

// Presmeruje na hlavni stranku
header('Location: index.php');
exit;