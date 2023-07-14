<?php
ini_set("display_errors", 'On');
error_reporting(E_ALL);

//1. POSTデータ取得
$time   = $_POST['time'];
$content  = $_POST['content'];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO an_table(time,content,created_at)VALUES(:time,:content,sysdate());');
$stmt->bindValue(':time', $time, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
  redirect('input.php?success=1');
}