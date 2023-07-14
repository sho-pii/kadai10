<?php
//1. POSTデータ取得
$time   = $_POST['time'];
$content  = $_POST['content'];
$id     = $_POST['id'];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('UPDATE an_table SET time=:time,content=:content WHERE id=:id;');
$stmt->bindValue(':time',   $time,   PDO::PARAM_STR);
$stmt->bindValue(':content',  $content,  PDO::PARAM_STR);
$stmt->bindValue(':id',     $id,     PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect('list.php');
}
