<?php

session_start();

require 'validation.php';

header('X-FRAME-OPTIONS:DENY');

if (!isset($_SESSION['token'])) {
    $token = bin2hex(random_bytes(32));
    $_SESSION['token'] = $token;
}

$errors = validation($_POST);

if (!empty($_POST["btn-confirm"]) && empty($errors)) {
    header('Location: confirm.php');
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
    <h1 class="main-text">Contact</h1>
    <p class="main-text-ja">お問い合わせ</p>

    <form class="all" action="confirm.php" method="post">
        <div class="contact-all">
            <div class="form">
                <label for="name" class="info">氏名</label>
                <input class="input-area" type="text" id="name" name="name" placeholder="山田太郎" value="<?php if (!empty($_POST['name'])) {
                                                                                                            echo h($_POST['name']);
                                                                                                        } ?>">
            </div>
            <?php if (!empty($errors['name']) && !empty($_POST['btn-confirm'])) {
                echo '<p class="error">' . $errors['name'] . '</p>';
            } ?>
            <div class="form">
                <label for="email" class="info">メールアドレス</label>
                <input class="input-area" type="email" id="email" name="email" placeholder="aaa@test.com" value="<?php if (!empty($_POST['email'])) {
                                                                                                                        $email = h($_POST['email']);
                                                                                                                        $email = i($email);
                                                                                                                        echo $email;
                                                                                                                    } ?>">
            </div>
            <?php if (!empty($errors['email']) && !empty($_POST['btn-confirm'])) {
                echo '<p class="error">' . $errors['email'] . '</p>';
            } ?>
            <div class="form">
                <label for="contact" class="info">お問い合わせ内容</label>
                <textarea class="content-area" id="contact" name="contact" placeholder="お問い合わせ内容を入力してください。"><?php if (!empty($_POST["contact"])) {
                                                                                                                echo h($_POST["contact"]);
                                                                                                            } ?></textarea>
            </div>
            <?php if (!empty($errors['contact']) && !empty($_POST['btn-confirm'])) {
                echo '<p class="error">' . $errors['contact'] . '</p>';
            } ?>
            <input class="btn" type="submit" name="btn-confirm" value="確認画面へ">

            <input type="hidden" name="csrf" value="<?php echo $_SESSION['token']; ?>">
        </div>
    </form>
</body>

</html>