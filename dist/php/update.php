<?php
include "conn/pdo.php";

$tit = addslashes($_GET['tit']);
$sub = addslashes($_GET['sub']);
$txt = addslashes($_GET['txt']);
$urg = addslashes($_GET['urg']);
$idd = addslashes($_GET['idd']);

try {
    if ( $tit !='' ) {
        $g = $conn->query("UPDATE `tm_tasks` SET `title`='$tit', `subtitle`='$sub', `txt`='$txt', `urgency`=$urg WHERE `id`=$idd");
        echo json_encode(['typ' => 1]);
    }
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}