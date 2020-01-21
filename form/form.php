<!-- 新規投稿フォーム、投稿履歴 -->
<html>
<head><title>miracleave株式会社社員専用ページ</title>
<!-- bootstrapの導入 -->
<link rel="stylesheet" href="../css/bootstrap.css">
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<link rel = "stylesheet" href = "toukou.css">

</head>
<body>

<h1>miracleave株式会社 社員専用ページ</h1>
<!-- 入力フォーム -->
<form method="POST" action="form.confirm.php">
  <input name="today" type="date" required/>
 
<br><br>
<input type="text" name="title" placeholder = "投稿ページのタイトルを入れてください" required  style="width:300px;">
<br><br>
<textarea name="contents" rows="8" cols="40" placeholder="投稿する内容を入力してください" required></textarea>
<br><br>
<input type="text" name="link" placeholder = "プレビューのリンク先として表示する文字" required  style="width:300px;">
<br><br>

<input type="submit" name="btn1" value="投稿する" class="btn btn-warning">
</form>
<h3>投稿履歴</h3>
<a href = "preview/preview.php"><h1>プレビュー表示</h1></a>

<?php
// ここに投稿された内容一覧表示
try{
  $pdo = new PDO ("sqlite:C:/xampp/htdocs/php/sqlite-tools-win32-x86-3300100/form.sqlite3");
  $sql = "SELECT * FROM form order by id desc";
  $stmt = $pdo->query($sql);

  echo "<table border = 1><tr><td>日付</td><td>タイトル</td><td>編集ボタン</td><td>削除ボタン</td></tr></table>";
  foreach ($stmt as $row) {
    // 投稿履歴のフォーム
    echo "<table border = 1><tr>
    <td>";
    echo $row['date'];
    echo "</td><td>";
    echo $row['title'];
    echo "</td><td>";
    $edit =$row['id'];
    echo "<form method ='post' action ='edit/edit.php'class='text-center'>
    <button value=$edit name='edit' class='btn btn-primary'>編集</button></form>";
    echo "</td><td>";
    // 投稿ごとのクラス付与 削除機能
    $delete =$row['id'];
    echo "<form method ='post' action ='delete/delete.php' class='text-center'>
    <button value=$delete name='delete' class='btn btn-danger'>消去</button>
    </form>";
    echo "</td></tr></table>";

  }
}catch (Exception $e) {
echo $e->getMessage() . PHP_EOL;
  }
?>
<!-- データベース接続 なかったら作成 -->
    <?php
    try{
     $pdo = new PDO ( "sqlite:C:/xampp/htdocs/php/sqlite-tools-win32-x86-3300100/form.sqlite3" );
     $pdo->exec("CREATE TABLE IF NOT EXISTS form(
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      date VARCHAR(10),
      concept VARCHAR(10),
      title VARCHAR(10),
      link VARCHAR(10)
    )");
}catch (Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}

    ?>
  </body>
</html>