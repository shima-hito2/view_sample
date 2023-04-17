<?php

require_once('queryUser.php');

$received_data = json_decode(file_get_contents("php://input"));
$name = $received_data->name;
$password = $received_data->password;
$login_name = "";

if (!empty($name) && !empty($password)) {

  $result_user = select_by_name($name);
  
  if (count($result_user) == 0) {
    $message = "ユーザー名は登録されていません。";
  } else {
    if (!password_verify($password,$result_user[0]['password'])) {
      $message = "パスワードが不正です。";
    } else {
      $message = "success";
      $login_name = $result_user[0]['name'];
    }
  }
} else {
  $message = "未記入の項目があります";
}

$data = array(
  'message' => $message,
  'login_name' => $login_name
);
echo json_encode($data);
