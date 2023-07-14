<?php
session_start();
require_once('funcs.php');
loginCheck();

$id = $_GET['id']; //?id~**を受け取る
require_once('funcs.php');
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM an_table WHERE id=:id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>



<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- title -->
  <title>データ編集</title>
</head>

<body>
  <div class="wrapper">
    <form method="POST" action="update.php">
            <fieldset>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">日時</span>
                </div>
                <input type="datetime-local"  class="form-control" name="time" value="<?= $row['time'] ?>">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">内容</span>
                </div>
                <textarea class="form-control" name="content" style="height: 100px"><?= $row['content'] ?></textarea>
              </div>
              <input type="hidden" name="id" value="<?= $id ?>">
              <div class="input-group mb-3">
                <button type="submit" class="btn btn-outline-warning btn-lg">OK</button>
              </div>
            </fieldset>
    </form>
    </div>

</body>

</html>
