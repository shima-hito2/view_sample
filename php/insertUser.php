<?php
require_once('database.php');
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_NAME);

if ($conn) {
} else {
  $message = "データベースに接続できません";
}

$received_data = json_decode(file_get_contents("php://input"));
$name = $received_data->name;
$password = password_hash($received_data->password, PASSWORD_DEFAULT);

if (!empty($name) && !empty($password)) {
  $result_user = mysqli_query($conn, "SELECT * FROM `users` WHERE name = '$name'");
  if (mysqli_num_rows($result_user) !== 0) {
    $message = "このユーザー名は既に登録されています。";
  } else {
    $result_insert = mysqli_query($conn, "INSERT INTO `users` ( `name`, `password` ) VALUES ('$name', '$password')");
    if ($result) {
      $message = "success";
    } else {
      $message = mysqli_error($conn);
    }
  }
} else {
  $message = "未記入の項目があります";
}

$output = array(
  'message' => $message
);
echo json_encode($output);
