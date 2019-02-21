<?php

// Vraci pripojeni na databazi
function db_connect() {
    static $db;

    if (!isset($db)) {
        $config = include('./config.php');
        $db = new mysqli($config['host'], $config['user'], $config['password'], $config['database']);
    }

    if ($db->connect_error) {
        echo $db->connect_error;
    }

    return $db;
}

// Ulozi uzivatele do databaze
function save_to_database($email, $password) {
    $db = db_connect();
    $query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

    return $db->query($query);
}

// Vrati uzivatele z datoveho souboru
function get_user_from_database($email) {
    $db = db_connect();
    $query = "SELECT * FROM users WHERE email = '$email'";

    $result = $db->query($query);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

// Zkontroluje, jestli existuje uzivatel s danym emailem
function check_if_user_exists($email) {
    return get_user_from_database($email) !== false;
}

// Najde uzivatele v databazi a ulozi k nemu hash cookieId retezce
function save_user_cookie_id($email, $cookieId) {
    $db = db_connect();
    $query = "UPDATE users SET cookie_id = '$cookieId' WHERE email = '$email'";

    return $db->query($query);
}