<!DOCTYPE html>
<html lang="ja">
    <head>
        <?php
            session_start();
            if(isset($_SESSION["username"])==true){
                header('Location:Home.php');
            }
        ?>
        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <meta name="description" content="ここにサイト説明を入れます">
        <link rel="stylesheet" href="../static/css/Login.css">
    </head>
    <body>
        
        <form action="C:\xampp\htdocs\Strategy-Desk\04_ソースコード\バックエンド\LoginCheck.php" method="post">
            <div class="Login_form">
            <h1>ログイン</h1>
        <p>メールアドレス、パスワードをご入力の上</p>
        <p>「ログイン」ボタンをクリックしてください。</p>
<<<<<<< Updated upstream
        メールアドレス<input type="email" name="umail"><br>
            パスワード<input type="password"name="upsw"><br>
=======
        メールアドレス：<input type="email" name="umail"><br>
            パスワード：<input type="password"name="upsw"><br>
>>>>>>> Stashed changes
        </div>
            <input type="submit"value="ログイン">
        </form>
        <script src="../static/js/Login.js"></script>
    </body>
</html>