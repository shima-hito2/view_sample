<?php
require_once('./database.php');
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_NAME);

if ($conn) {
} else {
    echo "データベースに接続できません";
}

$received_data = json_decode(file_get_contents("php://input"));
$name = $received_data->name;
$email = $received_data->email;

if (!empty($name) && !empty($email)) {
    if (preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD', $email)) {
        $sql2_query = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
        $sql2 = mysqli_query($conn, $sql2_query);
        if ($sql2) {
            $message = "success";
        } else {
            $message = "問題があります。";
        }
    } else {
        $message = "emailアドレスとして適切ではありません";
    }
} else {
    $message = "未記入の項目があります";
}

$output = array(
    'message' => $message
);
echo json_encode($output);
