<?php
require_once('database.php');
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_NAME);

if ($conn) {
} else {
  $message = "データベースに接続できません";
}

$received_data = json_decode(file_get_contents("php://input"));
$id = $received_data->id;

if (!empty($id)) {
  $sql2_query = "DELETE FROM users WHERE id = '$id'";
  $sql2 = mysqli_query($conn, $sql2_query);
  if ($sql2) {
    $message = "success";
  } else {
    $message = "問題があります。";
  }
} else {
  $message = "エラーが発生しました。";
}

$output = array(
  'message' => $message
);
echo json_encode($output);
