<!DOCTYPE html>
<html lang="ja">
    <head>
        <?php
            if(!isset($_SESSION)){
                session_start();
            }
        ?>
        <meta charset="UTF-8">
        <title>新規登録</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <meta name="description" content="ここにサイト説明を入れます">
        <link rel="stylesheet" href="../static/css/Signup.css">
    </head>
    <body>
        <body>
            <form action="../backend/UserCreation.php" method="post">
                <div class="Login_form">
                    <h1>新規登録</h1>
                    <!-- <p>ユーザー名、パスワードをご入力の上</p>
                    <p>「新規登録」ボタンをクリックしてください。</p> -->
                    <?php
                        if(isset($_GET['error'])){
                    ?>
                        <div class="error" style="text-align: center;">そのメールアドレス・パスワードの組は既に登録されています</div>
                    <?php
                        }
                    ?>
                    ユーザー名<input type="text" name="uname"><br>
                    パスワード<input type="password"name="upwd"><br>
                </div>
                <input type="submit"value="新規登録">
                <a href="Login.php">ログインはこちら</a>
            </form>
        <script src="../static/js/Signup.js"></script>
    </body>
</html>