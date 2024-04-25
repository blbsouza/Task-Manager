<?php
include "conn/pdo.php";

$id = intval(addslashes($_GET['id']));

try {
    if ( $id > 0 ) {
        $g = $conn->query("DELETE FROM tm_tasks WHERE id=$id");
    }
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}