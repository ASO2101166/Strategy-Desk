<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <meta name="description" content="ここにサイト説明を入れます">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="../static/css/Home.css">
    </head>
    
    <body>
        <!-- ヘッダー読み込み -->
        <?php include("Headline.php")?>
        <!-- --------------- -->
        <div class="container-fluid">
            <button id="creation" type="button">
                <div>掲示板立ち上げ</div>
            </button>
            <!-- 掲示板立ち上げ画面表示 -->
            <div id="launch_background" hidden="true"></div>
            <div id="add_launch_area" hidden="true">
                <?php include("BoardLaunch.php")?>
            </div>
            <!-- --------------------- -->
            <br>
            <main>
                <div class="test">
                    <form action="" method="post">
                        <button class="board_form_button" type="submit">
                            <h3>test</h3>
                            <div class="parent">
                                <div class="child">aaa</div>
                                <div calss="child">bbb</div>
                                <div class="child">ccc</div>
                                <div class="child">ddd</div>
                            </div>    
                        </button>
                    </form>
                </div>
                <br>
                <div class="test">
                    <form action="" method="post">
                        <button class="board_form_button" type="submit">
                            <h3>test</h3>
                            <div class="parent">
                                <div class="child">aaa</div>
                                <div calss="child">bbb</div>
                                <div class="child">ccc</div>
                            </div>    
                        </button>
                    </form>
                </div>
                <br>
                <div class="test">
                    <form action="" method="post">
                        <button class="board_form_button" type="submit">
                            <h3>test</h3>
                            <div class="parent">
                                <div class="child">aaa</div>
                                <div calss="child">bbb</div>
                            </div>    
                        </button>
                    </form>
                </div>
                <br>
                <div class="test">
                    <form action="" method="post">
                        <button class="board_form_button" type="submit">
                            <h3>test</h3>
                            <div class="parent">
                                <div class="child">aaa</div>
                                <div calss="child">bbb</div>
                                <div class="child">ccc</div>
                                <div class="child">ddd</div>
                                <div class="child">eee</div>
                            </div>    
                        </button>
                    </form>
                </div>
            </main>
        </div>

        <script src="../static/js/Home.js"></script>
    </body>
</html>