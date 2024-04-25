<?php
include "ini.php";
include "dados.php";

$fetch_testing = $_GET['fetch'];

try {
  $conn = new PDO('mysql:host=localhost;dbname=atacadao', $user, $pass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if ($fetch_testing == 1) {echo json_encode(array("bd" => true));}
} catch(PDOException $e) {
  echo 'ERROR: ' . $e->getMessage();
}