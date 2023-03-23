<?php
// セッションの利用を開始
session_start();

// セッションのflushメッセージをクリア
$flush = isset($_SESSION['flush']) ? $_SESSION['flush'] : [];
unset($_SESSION['flush']);

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
            <input type="text" id="name" name="name" required />
            <?php echo isset($flush['name']) ? $flush['name'] : null ?>
        </div>
        <div>
            <label for="email">メールアドレス：</label>
            <input type="email" id="email" name="email" required />
            <?php echo isset($flush['email']) ? $flush['email'] : null ?>
        </div>
        <div>
            <label for="message">お問い合わせ本文</label>
            <textarea id="message" name="message"></textarea>
        </div>
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>" />
        <button type="submit">送信</button>
    </form>
</body>

</html>