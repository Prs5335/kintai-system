<?php
require 'db.php';

// 全データを取得
$stmt = $pdo->query("SELECT * FROM kiroku ORDER BY start_work DESC");
$records = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>全記録一覧</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="page-list">
    <h1>全記録一覧</h1>
    <div class="nav-links">
        <a href="clock_in.php">出勤画面へ</a> | 
        <a href="clock_out.php">退勤画面へ</a>
    </div>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>従業員ID</th>
            <th>出勤時刻</th>
            <th>退勤時刻</th>
        </tr>
        <?php foreach ($records as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['jugyoin_id']) ?></td>
            <td><?= htmlspecialchars($row['start_work']) ?></td>
            <td><?= htmlspecialchars($row['end_work'] ?? '勤務中') ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>