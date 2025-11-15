<?php
include "session.php";

$id = $_GET["id"];

foreach ($_SESSION['contacts'] as $i => $c) {
    if ($c['id'] == $id) {
        unset($_SESSION['contacts'][$i]);
        break;
    }
}

header("Location: index.php");
