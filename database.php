<?php

// Vrati cestu k datovemu souboru
function get_database_file_path() {
    return './database.json';
}

// Vrati dekodovany obsah datoveho souboru
function load_database_file() {
    $path = get_database_file_path();
    $file = file_get_contents($path);

    return json_decode($file, true);
}

// Ulozi uzivatele do datoveho souboru
function save_to_database($email, $password) {
    $database = load_database_file();
    $user = [
        'email' => $email,
        'password' => $password,
    ];

    if (empty($database)) {
        $database = [];
    }

    array_push($database, $user);
    $path = get_database_file_path();

    return file_put_contents($path, json_encode($database));
}

// Vrati uzivatele z datoveho souboru
function get_user_from_database($email) {
    $database = load_database_file();
    $user = array_filter($database, function ($user) use ($email) {
        return $user['email'] === $email;
    });
    $user = array_values($user);

    return empty($user) ? false : $user[0];
}

// Zkontroluje, jestli existuje uzivatel s danym emailem
function check_if_user_exists($email) {
    $database = load_database_file();
    $users = array_filter($database, function ($user) use ($email) {
        return $user['email'] === $email;
    });

    return count($users) > 0;
}