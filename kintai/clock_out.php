<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jugyoin_id = $_POST['jugyoin_id'];
    // 最新の退勤していないレコードを探して更新
    // (日付を跨がない、記録忘れがない前提の簡易ロジックです)
    $stmt = $pdo->prepare("UPDATE kiroku SET end_work = NOW() WHERE jugyoin_id = ? AND end_work IS NULL ORDER BY start_work DESC LIMIT 1");
    $stmt->execute([$jugyoin_id]);
    
    if ($stmt->rowCount() > 0) {
        $message = "従業員ID: {$jugyoin_id} 退勤記録しました。";
    } else {
        $message = "エラー：出勤記録が見つかりません、または既に退勤済みです。";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>退勤登録</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="page-out">
    <h1>退勤登録</h1>
    <?php if (isset($message)) echo "<p>{$message}</p>"; ?>
    
    <form method="post">
        従業員ID: <input type="number" name="jugyoin_id" required>
        <button type="submit">退勤する</button>
    </form>
    <br>
    <a href="index.php">一覧へ戻る</a>
</body>
</html>