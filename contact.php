<?php

session_start();

require 'validation.php';

header('X-FRAME-OPTIONS:DENY');

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$pageflag = 0;

if (!empty($_POST["btn-confirm"]) && empty($errors)) {
    $pageflag = 1;
}
if (!empty($_POST["btn-submit"])) {
    $pageflag = 2;
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
    <?php if ($pageflag === 0) : ?>
        <?php
        if (!isset($_SESSION['token'])) {
            $token = bin2hex(random_bytes(32));
            $_SESSION['token'] = $token;
        }
        ?>
        <form class="all" action="contact.php" method="post">
            <div class="contact-all">
                <div class="form">
                    <label for="name" class="info">氏名</label>
                    <input class="input-area" type="text" name="name" placeholder="山田太郎" value="<?php if (!empty($_POST['name'])) {
                                                                                                    echo h($_POST['name']);
                                                                                                } ?>">
                </div>
                <?php if (!empty($errors['name']) && !empty($_POST['btn-confirm'])) {
                    echo '<p class="error">' . $errors['name'] . '</p>';
                } ?>
                <div class="form">
                    <label for="email" class="info">メールアドレス</label>
                    <input class="input-area" type="email" name="email" placeholder="aaa@test.com" value="<?php if (!empty($_POST['email'])) {
                                                                                                            echo h($_POST['email']);
                                                                                                        } ?>">
                </div>
                <?php if (!empty($errors['email']) && !empty($_POST['btn-confirm'])) {
                    echo '<p class="error">' . $errors['email'] . '</p>';
                } ?>
                <div class="form">
                    <label for="message" class="info">お問い合わせ内容</label>
                    <textarea class="content-area" name="contact" placeholder="お問い合わせ内容を入力してください。"><?php if(!empty($_POST["contact"])){echo h($_POST["contact"]) ;}?></textarea>
                </div>
                <?php if (!empty($errors['contact']) && !empty($_POST['btn-confirm'])) {
                    echo '<p class="error">' . $errors['contact'] . '</p>';
                } ?>
                <input class="btn" type="submit" name="btn-confirm" value="確認画面へ">
                <input type="hidden" name="csrf" value="<?php echo $_SESSION['token']; ?>">
            </div>
        </form>
    <?php endif; ?>

    <?php if ($pageflag === 1) : ?>
        <?php if ($_POST['csrf'] === $_SESSION['token']) : ?>
            <form action="contact.php" method="post">
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
                        <label for="message" class="info">お問い合わせ内容</label>
                        <div class="content-area"><?php echo h($_POST["contact"]); ?></div>
                    </div>
                    <div class="btn-all">
                        <input class="back-btn" type="submit" name="back" value="戻る">
                        <input class="submit-btn" type="submit" name="btn-submit" value="送信する">
                    </div>
                    <input type="hidden" name="name" value="<?php if (!empty($_POST["name"])) {
                                                                echo h($_POST["name"]);
                                                            } ?>">
                    <input type="hidden" name="email" value="<?php if (!empty($_POST["email"])) {
                                                                    echo h($_POST["email"]);
                                                                } ?>">
                    <input type="hidden" name="message" value="<?php if (!empty($_POST["contact"])) {
                                                                    echo $_POST["contact"];
                                                                } ?>">
                    <input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']); ?>">
                </div>
            </form>
        <?php endif; ?>
    <?php endif; ?>
    <?php if ($pageflag === 2) : ?>
        <?php if ($_POST['csrf'] === $_SESSION['token']) : ?>

            <div class="complete">
                <h1 class="thank-you">thank you!</h1>
                <p class="compete-message">お問い合わせいただきありがとうございました。<br>2営業日以内に返信させていただきますので少々お待ちください。<br>どうぞよろしくお願いいたします。</p>
            </div>

            <?php unset($_SESSION['token']); ?>
        <?php endif; ?>
    <?php endif; ?>
</body>

</html>