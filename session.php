<?php
session_start();

if (!defined('USERS')) {
    define('USERS', [
        'dhinivadilaa' => 'praktikum2025',
        'admin' => 'password123',
    ]);
}

if (!isset($_SESSION['contacts'])) {
    $_SESSION['contacts'] = [
        ["id" => 1, "name" => "Dhini", "phone" => "0812345678", "email" => "dhini@mail.com"],
        ["id" => 2, "name" => "vadila", "phone" => "0898765432", "email" => "vadila@mail.com"]
    ];
}

function is_logged_in() {
    return isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
}

function require_login() {
    if (!is_logged_in()) {
        header("Location: login.php");
        exit;
    }
}
?>