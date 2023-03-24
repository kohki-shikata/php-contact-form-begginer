<?php
// セッションの利用を開始
session_start();

// セッションのflashメッセージをクリア
$flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : [];
unset($_SESSION['flash']);

// 過去のPOSTデータをクリア
$original = isset($_SESSION['original']) ? $_SESSION['original'] : [];
unset($_SESSION['original']);

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
    <form action="confirm.php" method="POST">
        <div>
            <label for="name">お名前：</label>
            <input type="text" id="name" name="name" value="<?php echo isset($original['name']) ? $original['name'] : null;?>" required />
            <?php echo isset($flash['name']) ? $flash['name'] : null ?>
        </div>
        <div>
            <label for="email">メールアドレス：</label>
            <input type="text" id="email" name="email" value="<?php echo isset($original['email']) ? $original['email'] : null;?>" required />
            <?php echo isset($flash['email']) ? $flash['email'] : null ?>
        </div>
        <div>
            <label for="message">お問い合わせ本文</label>
            <textarea id="message" name="message"><?php echo isset($original['message']) ? $original['message'] : null;?></textarea>
        </div>
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>" />
        <button type="submit">送信</button>
    </form>
</body>

</html>