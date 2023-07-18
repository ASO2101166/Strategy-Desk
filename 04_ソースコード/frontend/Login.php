<!DOCTYPE html>
<html lang="ja">
    <head>
        <?php
            if(!isset($_SESSION)){
                session_start();
            }
            require_once '../backend/UserInfo.php';
            require_once '../backend/SessionCheck.php';
            $ClsSessionCheck = new SessionCheck();
            if($ClsSessionCheck->usersessioncheck() == true){
                header('Location: Home.php', true, 304);
                exit();
            }
        ?>
        <meta charset="UTF-8">
        <title>ログイン</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <meta name="description" content="ここにサイト説明を入れます">
        <link rel="stylesheet" href="../static/css/Login.css">
    </head>
    <body>
        <form action="../backend/LoginCheck.php" method="post">
            <div class="Login_form">
                <h1>ログイン</h1>
                <!-- <p>ユーザー名、パスワードをご入力の上</p>
                <p>「ログイン」ボタンをクリックしてください。</p> -->
                <?php
                    if(isset($_GET['error'])){
                ?>
                    <div class="error" style="text-align: center;">メールアドレスまたはパスワードが違います</div>
                <?php
                    }
                ?>
                <?php
                    if(isset($_GET['newcomplete'])){
                ?>
                    <div class="newcomplete" style="text-align: center;">新規登録完了しました！</div>
                <?php
                    }
                ?>
                ユーザー名<input type="text" name="uname" required><br>
                パスワード<input type="password"name="upwd" required><br>
            </div>
            <input type="submit" value="ログイン">
            <a href="Signup.php">新規登録はこちら</a>
        </form>
        <script src="../static/js/Login.js"></script>
    </body>
</html>