<?php
include "conn/pdo.php";

$val = intval(addslashes($_GET['val']));
$id = intval(addslashes($_GET['id']));

try {
    if ( $val > 0 && $id > 0 ) {
        $data = date('Y-m-d');
        $g = $conn->query("UPDATE `tm_tasks` SET `sts`=$val, `data_sts`='$data' WHERE id=$id");
    }
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}