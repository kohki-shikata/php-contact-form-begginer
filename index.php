<?php
// セッションの利用を開始
session_start();

// ワンタイムトークン生成
$toke_byte = openssl_random_pseudo_bytes(16);
$csrf_token = bin2hex($toke_byte);

// トークンをセッションに保存
$_SESSION['csrf_token'] = $csrf_token;
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム</title>
</head>

<body>
    <form action="contact.php" method="POST">
        <div>
            <label for="name">お名前：</label>
            <input type="text" id="name" name="name" />
        </div>
        <div>
            <label for="email">メールアドレス：</label>
            <input type="email" id="email" name="email" />
        </div>
        <div>
            <label for="message">お問い合わせ本文</label>
            <textarea id="message" name="message"></textarea>
        </div>
        <button type="submit">送信</button>
    </form>
</body>

</html>