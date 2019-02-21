<?php

// Nastartuje pristup k session
session_start();

// Odstrani ze session informace o prihlaseni
unset($_SESSION['logged_in']);
unset($_SESSION['email']);

// Prida do session zpravu o odhlaseni
$_SESSION['message'] = 'Uživatel byl odhlášen';

// Presmeruje na hlavni stranku
header('Location: index.php');
exit;