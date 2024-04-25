<?php
include "conn/pdo.php";


try {
    $b = $conn->query("SELECT * FROM `tm_tasks` ORDER BY -urgency,data ASC LIMIT 50");

    if ($b) {
        $array = [];

        $i = 0;
        $t = $b->fetchAll();
        
        foreach ( $t as $row ) {
            $array[$i]['id'] = intval($row['id']);
            $array[$i]['data'] = date('d/m/Y', strtotime($row['data']));
            if ( $row['data_sts'] != '0000-00-00' ) {
                $array[$i]['datasts'] = date('d/m/Y', strtotime($row['data_sts']));
            }
            $array[$i]['title'] = $row['title'];
            $array[$i]['subtitle'] = $row['subtitle'];
            $array[$i]['txt'] = $row['txt'];
            $array[$i]['sts'] = intval($row['sts']);
            $array[$i]['urgency'] = intval($row['urgency']);
            $i++;
        }

        echo json_encode($array);
    }
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>