<?php

session_start();

header('X-FRAME-OPTIONS:DENY');

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Kaisei+Decol&family=Zen+Kaku+Gothic+New&display=swap" rel="stylesheet">
</head>

<body>
        <?php if ($_POST['csrf'] === $_SESSION['token']) : ?>

            <?php require '../mainte/insert.php';

            insertContact($_POST);
            ?>

            <div class="complete">
                <h1 class="thank-you">thank you!</h1>
                <p class="compete-message">お問い合わせいただきありがとうございました。<br>2営業日以内に返信させていただきますので少々お待ちください。<br>どうぞよろしくお願いいたします。</p>
            </div>

            <?php unset($_SESSION['token']); ?>
            <a class="top-back" href="input.php">TOPに戻る</a>
        <?php endif; ?>
</body>
</html>