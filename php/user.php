<?php
require_once('database.php');
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWD, DB_NAME);

if ($mysqli->connect_errno) {
} else {
  $message = "データベースに接続できません";
}

$result = $mysqli->query("SELECT * FROM `users` ORDER BY id DESC",MYSQLI_USE_RESULT);

print_r($result);
if (!$result) {
  $message = "レコードが有りません";
}else{

  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  
  //値をjson形式で出力
  echo json_encode($data);
}
