<?php

session_start();
// ワンタイムトークンの一致を確認
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
  // トークンが一致しなかった場合
  die('お問い合わせの送信に失敗しました');
}

// 必須項目の確認
if(empty($_POST['name'])) {
  $_SESSION['flash']['name'] = 'お名前は必須項目です';
}

$_SESSION['original']['name'] = $_POST['name']; // nameに入力があった場合、一旦セッションに保存

if(empty($_POST['email'])) {
  $_SESSION['flash']['email'] = 'メールアドレスは必須項目です';
}

$_SESSION['original']['email'] = $_POST['email']; // emailに入力があった場合、一旦セッションに保存
$_SESSION['original']['message'] = $_POST['message']; // messageに入力があった場合、一旦セッションに保存

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>確認画面</title>
</head>
<body>
  <p>以下の内容で間違いないですか？</p>
  <table>
    <tbody>
      <?php
        unset($_POST['csrf_token']);
        foreach($_POST as $key => $value) {
          if($key !== 'labels') {
            echo
            "<tr>\n" . 
              '<th>' . $_POST['labels'][$key] . "</th>\n" . 
              '<td>' . $value . "</td>\n" . 
            "</tr>\n";
          }
        }?>
    </tbody>
  </table>
</body>
</html>