<?php
session_start();

$_SESSION = array(); // セッションの配列を削除する為、空の配列を上書きする

// ここから、決まり文句↓
if (ini_set('session.use_cookies')) {  // セッションにクッキーを使用するかどうかの設定ファイル
// 以降、クッキーの情報を削除するための処理
  $params = session_get_cookie_params();
// クッキーの有効期限を切る事で、そのセッションを切る
  setcookie(session_name() . '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}
session_destroy();  // サーバー側のセッションIDを削除

setcookie('email', '', time() - 3600);  // ログアウト時、セッションに保存されたメールアドレスを削除

header('Location: login.php');
exit();
?>