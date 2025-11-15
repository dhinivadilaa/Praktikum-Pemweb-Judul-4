<?php
session_start();

if (!isset($_SESSION['contacts'])) {
    $_SESSION['contacts'] = [
        ["id" => 1, "name" => "Dhini", "phone" => "0812345678", "email" => "dhini@mail.com"],
        ["id" => 2, "name" => "vadila", "phone" => "0898765432", "email" => "vadila@mail.com"]
    ];
}
?>
