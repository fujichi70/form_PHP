<?php



function validation($request) {
    $errors = [];
    if (empty($request['name']) || mb_strlen($request['name']) >= 20) {
        $errors['name'] = '氏名をご入力ください。また、氏名は20文字まで入力できます。';
    }

    if (empty($request['email']) || !filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'メールアドレスを正しくご入力ください。';
    }

    if (empty($request['contact']) || mb_strlen($request['contact']) >= 400) {
        $errors['contact'] = 'お問い合わせ内容をご入力ください。また、内容は400字まで入力できます。';
    }
    return $errors;
}
