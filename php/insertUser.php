<?php

require_once('queryUser.php');

$received_data = json_decode(file_get_contents("php://input"));
$name = $received_data->name;
$password = $received_data->password;

if (!empty($name) && !empty($password)) {

  $password = password_hash($password, PASSWORD_DEFAULT);
  $result_user = select_by_name($name);

  if (count($result_user) !== 0) {
    $message = "このユーザー名は既に登録されています。";
  } else {
    $result_insert = insert_new($name, $password);
    if ($result_insert) {
      $message = "success";
    } else {
      $message = "問題が発生しました。";
    }
  }
} else {
  $message = "未記入の項目があります";
}

$data = array(
  'message' => $message
);
echo json_encode($data);
