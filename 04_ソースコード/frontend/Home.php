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
        <div id="main"> 
            <div id="main_area">
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
                    <div class="home_board_area">
                        <form action="" method="post">
                            <button class="board_form_button" type="submit">
                                <h3>test</h3>
                                <div class="home_tag_area">
                                    <div class="home_tag">aaa</div>
                                    <div calss="home_tag">bbb</div>
                                    <div class="home_tag">ccc</div>
                                    <div class="home_tag">ddd</div>
                                </div>    
                            </button>
                        </form>
                    </div>
                    <br>
                    <div class="home_board_area">
                        <form action="" method="post">
                            <button class="board_form_button" type="submit">
                                <h3>test</h3>
                                <div class="home_tag_area">
                                    <div class="home_tag">aaa</div>
                                    <div calss="home_tag">bbb</div>
                                    <div class="home_tag">ccc</div>
                                </div>    
                            </button>
                        </form>
                    </div>
                    <br>
                    <div class="home_board_area">
                        <form action="" method="post">
                            <button class="board_form_button" type="submit">
                                <h3>test</h3>
                                <div class="home_tag_area">
                                    <div class="home_tag">aaa</div>
                                    <div calss="home_tag">bbb</div>
                                </div>    
                            </button>
                        </form>
                    </div>
                    <br>
                    <div class="home_board_area">
                        <form action="" method="post">
                            <button class="board_form_button" type="submit">
                                <h3>test</h3>
                                <div class="home_tag_area">
                                    <div class="home_tag">aaa</div>
                                    <div calss="home_tag">bbb</div>
                                    <div class="home_tag">ccc</div>
                                    <div class="home_tag">ddd</div>
                                    <div class="home_tag">eee</div>
                                </div>    
                            </button>
                        </form>
                    </div>
                </main>
            </div>
            <div id="my_board_area">
                <h3>自作掲示板</h3>
                <div class="my_board">
                    <form>
                        <button class="my_board_form_button" type="submit">
                            <div class="my_board_title">こんにちはこんにちはこんにちはこんにちはこんにちはこんにちはこんにちは</div>
                        </button>
                    </form>
                </div>
                <div class="my_board">
                    <form>
                        <button class="my_board_form_button" type="submit">
                            <div class="my_board_title">こんにちはこんにちはこんにちはこんにちはこんにちはこんにちはこんにちは</div>
                        </button>
                    </form>
                </div>
                <div class="my_board">
                    <form>
                        <button class="my_board_form_button" type="submit">
                            <div class="my_board_title">こんにちはこんにちはこんにちはこんにちはこんにちはこんにちはこんにちは</div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <script src="../static/js/Home.js"></script>
    </body>
</html>