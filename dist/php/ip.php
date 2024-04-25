<?php
include "conn/ini.php";

$admin = [
    // colocar o IP admin entre as aspas
    '',
];

$ip = gethostbyname($_SERVER['REMOTE_ADDR']);
//

$isadmin = false;

foreach ($admin as $adm) {
    if ( $ip === $adm) {
        $isadmin = true;
    }
}

echo json_encode(["admin" => $isadmin]);