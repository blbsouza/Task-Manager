<?php
include "conn/pdo.php";

$tit = addslashes($_GET['tit']);
$sub = addslashes($_GET['sub']);
$txt = addslashes($_GET['txt']);
$urg = addslashes($_GET['urg']);

try {
    if ( $tit ) {
        $data = date('Y-m-d');
        $g = $conn->query("INSERT INTO tm_tasks(data, title, subtitle, txt, urgency, sts)VALUES('$data', '$tit', '$sub', '$txt', $urg, 1)");
        echo json_encode(['typ' => 1]);
    }
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}