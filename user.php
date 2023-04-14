<?php
require_once('./database.php');
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_NAME);

if ($conn) {
} else {
  echo "データベースに接続できません";
}

$result = mysqli_query($conn, "SELECT * FROM `users` ORDER BY id DESC");

if (mysqli_num_rows($result) == 0) {
  echo "レコードが有りません";
}

while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

//値をjson形式で出力
echo json_encode($data);
