<?php

$errors = [];


if (empty($_POST['name']) || mb_strlen($_POST['name']) >= 20) {
    $errors['name'] = '氏名をご入力ください。また、氏名は20文字まで入力できます。';
}

if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'メールアドレスを正しくご入力ください。';
}

if (empty($_POST['contact']) || mb_strlen($_POST['contact']) >= 400) {
    $errors['contact'] = 'お問い合わせ内容をご入力ください。また、内容は400字まで入力できます。';
}
