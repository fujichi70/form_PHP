<?php

session_start();

require 'validation.php';

header('X-FRAME-OPTIONS:DENY');

// if (!empty($_POST["btn-submit"])) {
//     header('Location: submit.php');
//     exit();
// }
if (!empty($_POST['btn-back'])) {
    header('Location: input.php');
    exit();
}

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
    <h1 class="main-text">Confirm</h1>
    <p class="main-text-ja">お問い合わせ内容確認</p>
    <?php if (isset($_POST["csrf"]) && $_POST["csrf"] === $_SESSION['token']) : ?>
        <form action="submit.php" method="post">
            <div class="confirm-all">
                <div class="form">
                    <label for="name" class="info">氏名</label>
                    <div class="input-area"><?php echo h($_POST["name"]); ?></div>
                </div>
                <div class="form">
                    <label for="email" class="info">メールアドレス</label>
                    <div class="input-area"><?php echo h($_POST["email"]); ?></div>
                </div>
                <div class="form">
                    <label for="contact" class="info">お問い合わせ内容</label>
                    <div class="content-area"><?php echo $_POST["contact"]; ?></div>
                </div>
                <div class="btn-all">
                    <input class="back-btn" type="submit" name="btn-back" value="戻る">
                    <input class="submit-btn" type="submit" name="btn-submit" value="送信する">
                </div>
                <input type="hidden" name="name" value="<?php echo h($_POST['name']); ?>">
                <input type="hidden" name="email" value="<?php echo h($_POST['email']); ?>">
                <input type="hidden" name="contact" value="<?php echo h($_POST['contact']); ?>">
                <input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']); ?>">
            </div>
        </form>
    <?php endif; ?>
</body>

</html>