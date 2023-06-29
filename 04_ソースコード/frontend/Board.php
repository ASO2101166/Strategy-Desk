<!DOCTYPE html>
<html lang="ja">
    <head>

        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <meta name="description" content="ここにサイト説明を入れます">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../static/css/Board.css">
        <style>

        </style>
    </head>
    <body>
        <!-- ヘッダー読み込み -->
        <?php include("Headline.php")?>
        <!-- --------------- -->

        <div class="main">
            <!-- 左エリア -->
            <div class="add_content_area">
                <!-- マップを開くタグ --->
                <div id="map_tab">
                    <div>マップ</div>
                    <div class="plus"></div>
                </div>
                <!-- アンケートを開くタグ -->
                <div id="questionary_tab">
                    <div>アンケート</div>
                    <div class="plus"></div>
                </div>
            </div>
            <!-- 中央エリア -->
            <div class="comment_area">
                <div class="comment">
                    <div class="comment_info">
                        <div class="comment_number">1</div>
                        <div class="comment_user">志水太郎</div>
                        <div class="comment_date">2023/06/22 10:12</div>
                    </div>
                    <div class="comment_content">
                        <div class="comment_text">・こんにちは</div>
                    </div>
                </div>
                <div class="comment">
                    <div class="comment_info">
                        <div class="comment_number">2</div>
                        <div class="comment_user">杉本太郎</div>
                        <div class="comment_date">2023/06/22 10:17</div>
                    </div>
                    <div class="comment_content">
                        <div class="comment_text">・こんばんは</div>
                    </div>
                </div>
                <div class="comment">
                    <div class="comment_info">
                        <div class="comment_number">3</div>
                        <div class="comment_user">髙橋太郎</div>
                        <div class="comment_date">2023/06/22 10:22</div>
                    </div>
                    <div class="comment_content">
                        <image src="test.png" alt></image>
                    </div>
                </div>
                <!-- かさ増し -->
                <div class="comment">
                    <div class="comment_info">
                        <div class="comment_number">3</div>
                        <div class="comment_user">髙橋太郎</div>
                        <div class="comment_date">2023/06/22 10:22</div>
                    </div>
                    <div class="comment_content">
                        <image src="test.png" alt></image>
                    </div>
                </div>
                <div class="comment">
                    <div class="comment_info">
                        <div class="comment_number">3</div>
                        <div class="comment_user">髙橋太郎</div>
                        <div class="comment_date">2023/06/22 10:22</div>
                    </div>
                    <div class="comment_content">
                        <image src="test.png" alt></image>
                    </div>
                </div>
                <div class="comment">
                    <div class="comment_info">
                        <div class="comment_number">3</div>
                        <div class="comment_user">髙橋太郎</div>
                        <div class="comment_date">2023/06/22 10:22</div>
                    </div>
                    <div class="comment_content">
                        <image src="test.png" alt></image>
                    </div>
                </div>
                <div class="comment">
                    <div class="comment_info">
                        <div class="comment_number">3</div>
                        <div class="comment_user">髙橋太郎</div>
                        <div class="comment_date">2023/06/22 10:22</div>
                    </div>
                    <div class="comment_content">
                        <image src="test.png" alt></image>
                    </div>
                </div>
                <div class="comment">
                    <div class="comment_info">
                        <div class="comment_number">1</div>
                        <div class="comment_user">志水太郎</div>
                        <div class="comment_date">2023/06/22 10:12</div>
                    </div>
                    <div class="comment_content">
                        <div class="comment_text">・こんにちは</div>
                    </div>
                </div>
                <div style="height: 20%;"></div>
                <!-- コメント送信 -->
                <div id="comment_post_area">
                    <form action="../backend/CommentPost.php" method="post">
                        <textarea class="form-control" id="post_comment" rows="1" placeholder="コメントを記入"></textarea>
                        <!-- 送信ボタン -->
                        <button type="submit" id="comment_post_button">
                            <i class="bi bi-send"></i>
                        </button>
                    </form>
                </div>
            </div>
            <!-- 右エリア -->
            <div class="fixed_comment_area">
                <div id="fixed_toggle_button">
                    <div class="arrow_icon">
                        <i class="bi bi-arrow-up-left-circle-fill"></i>
                    </div>
                    <div>OFF</div>
                </div>
                <div class="fixed_comment">
                    <div class="comment_info">
                        <div class="comment_number">1</div>
                        <div class="comment_user">志水太郎</div>
                        <div class="comment_date">2023/06/22 10:12</div>
                    </div>
                    <div class="comment_content">
                        <div class="comment_text">・こんにちは</div>
                    </div>
                </div>
            </div>

        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../static/js/Board.js"></script>
    </body>
</html>