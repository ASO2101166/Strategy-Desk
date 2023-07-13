<?php
    // $board_id = (empty($_SERVER["HTTPS"]) ? "http://" : "https://").$_SERVER['HTPP_HOST'].$_SERVER['REQUEST_URL'];
    // setcookie('history',$board_id,time()+60*60*24*7);
?>

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
                <?php include("Questionnaire.php")?>
            </div>
            <!-- 中央エリア -->
            <div class="comment_area">
                <?php
                    require_once '../backend/CommentSelect.php';
                    $ClsCommentSelect = new CommentSelect();
                    $comments = $ClsCommentSelect->commentSelect($_POST['board_id']);
                    foreach($comments as $comment){

                ?>
                    <div class="comment">
                        <div class="comment_info">
                            <div class="comment_number"><?php echo $comment['comment_id']?></div>
                            <div class="comment_user"><?php echo $comment['user_name']?></div>
                            <div class="comment_date"><?php echo $comment['comment_date']?></div>
                            <button class="add_fixed_button" hidden="true" onclick="addfixedcomment(event,<?php echo $_POST['board_id'] ?>, <?php echo $comment['comment_id'] ?>)">
                                <div class="arrow_icon">
                                    <i class="bi bi-arrow-up-left-circle-fill"></i>
                                </div>
                            </button>
                        </div>
                        <div class="comment_content">
                            <div class="comment_text"><?php echo $comment['comment_content']?></div>
                        </div>
                    </div>
                <?php
                    }
                ?>
                <div style="height: 20%;"></div>
                <!-- コメント送信 -->
                <div id="comment_post_area">
                    <form action="../backend/CommentPost.php" method="post">
                        <input type="hidden" name="board_id" value="<?php echo $_POST['board_id']?>">
                        <textarea class="form-control" name="post_comment" id="post_comment" rows="1" placeholder="コメントを記入"></textarea>
                        <!-- 送信ボタン -->
                        <button type="submit" id="comment_post_button">
                            <i class="bi bi-send"></i>
                        </button>
                    </form>
                </div>
            </div>
            <!-- 右エリア -->
            <div class="fixed_comment_area">
                <button id="fixed_toggle_button">
                    <div class="arrow_icon">
                        <i id="fixed_toggle_icon" class="bi bi-arrow-up-left-circle-fill"></i>
                    </div>
                    <div id="fixed_status">OFF</div>
                </button>
                <?php
                    require_once '../backend/FixedCommentSelect.php';
                    $ClsFixedCommentSelect = new FixedCommentSelect();
                    $fixed_comments = $ClsFixedCommentSelect->fixedCommentSelect($_POST['board_id']);
                    if($fixed_comments == null){
                        $fixed_comments = [];
                    }
                    foreach($fixed_comments as $fixed_comment){

                    
                ?>

                <div class="fixed_comment">
                    <div class="comment_info">
                        <div class="comment_number"><?php echo $fixed_comment['comment_id']?></div>
                        <div class="comment_user"><?php echo $fixed_comment['user_name']?></div>
                        <div class="comment_date"><?php echo $fixed_comment['comment_date']?></div>
                        <button class="remove_fixed_button" onclick="removefixedcomment(event,<?php echo $fixed_comment['board_id'] ?>, <?php echo $fixed_comment['comment_id'] ?>)" hidden="true">
                            <div class="arrow_icon">
                                <i class="bi bi-arrow-up-left-circle-fill" style="color: #FFC122;"></i>
                            </div>
                        </button>
                    </div>
                    <div class="comment_content">
                        <div class="comment_text"><?php echo $fixed_comment['comment_content']?></div>
                    </div>
                </div>
                <?php
                    }
                ?>
                <!-- 複製用固定コメント -->
                <div id="clone_fixed_comment" style="display:none;">
                    <div class="comment_info">
                        <div class="comment_number"></div>
                        <div class="comment_user"></div>
                        <div class="comment_date"></div>
                        <button class="remove_fixed_button" hidden="true">
                            <div class="arrow_icon">
                                <i class="bi bi-arrow-up-left-circle-fill" style="color: #FFC122;"></i>
                            </div>
                        </button>
                    </div>
                    <div class="comment_content">
                        <div class="comment_text"></div>
                    </div>
                </div>
            </div>

        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../static/js/Board.js"></script>
        <script src="../static/js/FixedComment.js"></script>
    </body>
</html>