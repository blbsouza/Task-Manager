<?php
include "./ini.php";
include "./conn/pdo.php";

$b = $conn->query("SHOW TABLES FROM atacadao");

$t = $b->fetchAll();

$c = false;

foreach ( $t as $table ) {
    if ($table[0] == "tm_tasks") $c = true;
}

echo json_encode(array("table" => $c));