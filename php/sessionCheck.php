<?php
require_once('database.php');
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_NAME);
$data = array();

session_start();

if (isset($_SESSION['id'])) {
  $data['id'] = $_SESSION['id'];
}

//値をjson形式で出力
echo json_encode($data);
