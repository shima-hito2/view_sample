<?php
require_once('database.php');
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_NAME);
// session_start();

if ($conn) {
} else {
  $message = "データベースに接続できません";
}

$received_data = json_decode(file_get_contents("php://input"));
$name = $received_data->name;
$password = password_hash($received_data->password, PASSWORD_DEFAULT);

if (!empty($name) && !empty($password)) {
  // $result = mysqli_query($conn, "SELECT name , password , id FROM `users` WHERE name = '$name'");
//   if (mysqli_num_rows($result) !== 0) {
//       if($password !== $result['password']){
//           $message = "パスワードが不正です。";
//       }else{
//           $message = "success";
//           // $_SESSION['id'] = $result['id'];
//       }
//   } else {
    // $message = "ユーザー名は登録されていません。";
//   }
$result_user = mysqli_query($conn, "SELECT * FROM `users` WHERE name = '$name'");
if (mysqli_num_rows($result_user) == 0) {
    $message = "ユーザー名は登録されていません。";
  // $message = "このユーザー名は既に登録されています。";
} else {
  if (mysqli_num_rows($result_user) !== 0) {
      // $message = mysql_fetch_assoc($result_user);
  //     if($password !== $result_user['password']){
  //         $message = "パスワードが不正です。";
  //     }else{
  //         $message = "success";
  //         // $_SESSION['id'] = $result['id'];
  //     }
  } else {
    $message = "ユーザー名は登録されていません。";
  }
}
} else {
  $message = "未記入の項目があります";
}
  
  $output = array(
    'message' => $message
  );
echo json_encode($output);

//値をjson形式で出力
// echo json_encode($data);

// if (!empty($name) && !empty($password)) {
//   $result = mysqli_query($conn, "SELECT name , password FROM `users` WHERE name = '$name'");
//   if (mysqli_num_rows($result) !== 0) {
//     if(password_hash($password, PASSWORD_DEFAULT) == $result){

//     }
//   } else {
//     $message = "ユーザー名は登録させていません。";
//   }

// } else {
//   $message = "未記入の項目があります";
// }

// $output = array(
//   'message' => $message
// );
// echo json_encode($output);
