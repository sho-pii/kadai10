<?php
session_start();

require_once('funcs.php');
loginCheck();

$pdo = db_conn();
$stmt = $pdo->prepare('SELECT * FROM an_table');
$status = $stmt->execute();

$view = '';
if ($status == false) {
    sql_error($stmt);
} else {
    while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<tr>';
        $view .= '<th scope="row"><a href="detail.php?id=' . $r["id"] . '">';
        $view .= h($r['id']) . "</th><td> " . h($r['created_at']) . "</td><td> " . h($r['time']) . "</td><td> " . h($r['content']);
        $view .= '</td></a>';
        $view .= "　";

        // 管理者であれば削除ボタンを表示
        if ($_SESSION['kanri_flg'] === 1) {
          $view .= '<td><a class="btn btn-danger" href="#" onclick="showConfirmModal(' . $r['id'] . ')">';
          $view .= '<i class="fa-solid fa-trash-can"></i> 削除';
          $view .= '</a></td>';
      }

        $view .= '</tr>';
    }
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
  <title>一覧</title>
</head>

<body>
  <!-- ナビ -->
  <nav class="navbar navbar-light bg-light">
<div class="container-fluid">
  <form class="d-flex">
    <a class="nav-link active" href="index.php" >トップ</a>
    <a class="nav-link active" href="input.php">入力フォーム</a>
    <a class="nav-link active" href="list.php" >一覧</a>
    </form>
    <form class="d-md-flex d-grid justify-content-md-end">
    <a class="btn btn-outline-success mr-3" href="login.php" role="button">Login</a>
    <a class="btn btn-outline-danger" href="logout.php" role="button">Logout</a>
</form>
</div>
</nav>
<!--  -->

  <div>
    <div class="wrapper">
    <table class="table table-sm">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">入力日時</th>
      <th scope="col">予定日時</th>
      <th scope="col">内容</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
        <?= $view ?>
</tbody>
    </table>
    </div>
  </div>

  <div class="modal" id="confirmModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">確認</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>本当に削除しますか？</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                <a id="deleteLink" class="btn btn-danger" href="#">削除</a>
            </div>
        </div>
    </div>
</div>
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="js/delete.js"></script>
</body>

</html>