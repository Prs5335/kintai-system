<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jugyoin_id = $_POST['jugyoin_id'];
    // 出勤時間を現在時刻で登録
    $stmt = $pdo->prepare("INSERT INTO kiroku (jugyoin_id, start_work) VALUES (?, NOW())");
    $stmt->execute([$jugyoin_id]);
    $message = "従業員ID: {$jugyoin_id} 出勤記録しました。";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>出勤登録</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="page-in">
    <h1>出勤登録</h1>
    <?php if (isset($message)) echo "<p>{$message}</p>"; ?>
    
    <form method="post">
        従業員ID: <input type="number" name="jugyoin_id" required>
        <button type="submit">出勤する</button>
    </form>
    <br>
    <a href="index.php">一覧へ戻る</a>
</body>
</html>