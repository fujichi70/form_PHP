<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ一覧表</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 class="title">お問い合わせ一覧</h1>
    <table class="table">
        <tr class="table--header">
            <th class="table--header-title">id</th>
            <th class="table--header-title">氏名</th>
            <th class="table--header-title">メールアドレス</th>
            <th class="table--header-title">お問い合わせ内容</th>
            <th class="table--header-title">お問い合わせ日時</th>
        </tr>
        
        <?php

require 'db_connection.php';

$sql = 'select * from contacts';
$pdo->beginTransaction();

try {
    $stmt = $pdo->prepare($sql);
    // $stmt->bindValue('id', 1, PDO::PARAM_INT);
    $stmt->execute();
    
    $pdo->commit();
    $result = $stmt->fetchall();
    
    foreach ($result as $row) {
        echo '<tr class="table--list">';
        echo '<td class="table--list-parts">' .  $row['id'] . '</td>';
        echo '<td class="table--list-parts">' .  $row['name'] . '</td>';
        echo '<td class="table--list-parts">' .  $row['email'] . '</td>';
        echo '<td class="table--list-parts">' .  $row['contact'] . '</td>';
        echo '<td class="table--list-parts">' .  $row['created_at'] . '</td>';
        echo '</tr>';
    }
    } catch (PDOException $e) {
        $pdo->rollBack();
    }
    ?>

</table>
</body>
</html>