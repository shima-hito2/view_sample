<?php
$conn = mysqli_connect("localhost", "root", "root", "cloudhome");

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
