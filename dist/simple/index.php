<?php
include "../php/conn/pdo.php";
$busca = $conn->query("SELECT * FROM `tm_tasks` WHERE `sts` < 3 ORDER BY -urgency,data ASC LIMIT 50");
$w = $busca->rowCount();
$rows = $busca->fetchAll();
$t = 0;
$n = 0;
$u = 0;
$i = 0;
foreach ( $rows as $row ) {
  $t++;
  if ( $row['urgency'] == 1 ) {
    $n++;
  }elseif ( $row['urgency'] == 2 ) {
    $u++;
  } else {
    $i++;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  <meta http-equiv="refresh" content="20">
  <title>Task Manager</title>
</head>
<body>
    <div class="body">
      <header>
        <div class="header">
          <p>TOTAL: <?php echo $t; ?></p>
          <p>NORMAIS: <?php echo $n; ?></p>
          <p>URGENTES: <?php echo $u; ?></p>
          <p>IMEDIATAS: <?php echo $i; ?></p>
        </div>
      </header>
      <main>
        <div class="main">
          <?php
          if ( $w == 0 ) {
          ?>
          <div class="no-items">
            <h1>Não há pendências no momento :)</h1>
          </div>
          <?php
          } else {
          echo "
          <div class='items'>
          ";
          function formatDate ($data) {
            $d = explode('-', $data);
            return $d[2] . "/" . $d[1] . "/" . $d[0];
          }
          foreach ( $rows as $row ) {
            $data = formatDate($row['data']);
            $data_sts = $row['data_sts'] != '0000-00-00' ? formatDate($row['data_sts']) : '';
            $title = $row['title'];
            $subtitle = $row['subtitle'];
            $state = $row['sts'];
            $sts = $state == 1 ? 'ABERTO' : 'EM ATENDIMENTO';
            $urgency = $row['urgency'];
            if ( $urgency == 1 ) {
              $class = 'item-normal';
            } elseif ( $urgency == 2 ) {
              $class = 'item-urgente';
            } else {
              $class = 'item-imediato';
            }
            echo "
            <div class='item $class'>
              <div class='v-col'>
                <p class='data initial-data'>$data</p>
                <p class='data final-data'>$data_sts</p>
              </div>
              <div class='v-col v-col-center'>
                <h1>$title</h1>
                <h3>$subtitle</h3>
              </div>
              <div class='v-col'>
                <p class='state'>
                  <h4>$sts</h4>
                </p>
              </div>
            </div>
            ";
          }
          echo "
          </div>
          ";
          }
          ?>
        </div>
      </main>
    </div>
</body>
</html>