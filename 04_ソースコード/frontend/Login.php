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
        <link rel="stylesheet" href="">
    </head>
    <body>
        <form action="C:\xampp\htdocs\Strategy-Desk\04_ソースコード\バックエンド\LoginCheck.php" method="post">
            メールアドレス：<input type="email" name="umail"><br>
            パスワード：<input type="password"name="upsw"><br>
            <input type="submit"value="ログイン">
        </form>
        <script src=""></script>
    </body>
</html>