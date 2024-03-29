<?php
    setcookie('history',$_POST['board_id'],time()+60*60*24*7);
    require_once '../backend/UserInfo.php';
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_POST['board_id'])){
        header('Location: ../frontend/Home.php',true, 307);
        exit();
    }
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        $user_id = $user->user_id;
    }else{
        $user_id = 0;
    }
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
        <input type="hidden" id="user_id" value="<?php if(isset($_SESSION['user'])){echo $user_id;}?>">
        <div class="main">
            <!-- 左エリア -->
            <div class="add_content_area">
                <!-- マップを開くタグ --->
                <!-- <div id="map_tab">
                    <div>マップ</div>
                    <div class="plus"></div>
                </div> -->
                <!-- アンケートを開くタグ -->
                <!-- <div id="questionary_tab">
                    <div>アンケート</div>
                    <div class="plus"></div>
                </div> -->
                <div id="questionnaire_main" style="height: 100%; position: relative; overflow:scroll;">
                    <?php include("Questionnaire.php")?>
                </div>
                <button type="submit" form="questionnaire_form" class="questionary_submit_btn">
                    <i class="bi bi-send-fill"></i>
                </button>
            </div>
            <!-- 中央エリア -->
            <div class="comment_area">
                <?php
                    require_once '../backend/CommentSelect.php';
                    require_once '../backend/Sanitize.php';
                    $ClsCommentSelect = new CommentSelect();
                    $ClsSanitize = new Sanitize();
                    $comments = $ClsCommentSelect->commentSelect($_POST['board_id']);
                    foreach($comments as $comment){

                ?>  
                    <?php 
                        if(is_null($comment['questionary_id']) || $comment['questionary_id'] == 0){
                    ?>
                    <div class="comment">
                        <div class="comment_info">
                            <div class="comment_number">ID:<?php echo $comment['comment_id']?></div>
                            <div class="comment_user">名前:<?php echo $comment['user_name']?></div>
                            <div class="comment_date">時間:<?php echo $comment['comment_date']?></div>
                            <button class="add_fixed_button" hidden="true" onclick="addfixedcomment(event,<?php echo $_POST['board_id'] ?>, <?php echo $comment['comment_id'] ?>, <?php echo $user_id?>)">
                                <div class="arrow_icon" style="color:<?php if($comment['fixed_comment'] == 1){echo '#FFC122';}?>;">
                                    <i class="bi bi-arrow-up-left-circle-fill"></i>
                                </div>
                            </button>
                        </div>
                        <div class="comment_content">
                            <div class="comment_text"><?php echo $ClsSanitize->sanitize_br($comment['comment_content'])?></div>
                        </div>
                    </div>
                    <?php
                        }else{
                            require_once '../backend/QuestionnaireCommentSelect.php';
                            $ClsQuestionnaireCommentSelect = new QuestionnaireCommentSelect();
                            $searchArray = $ClsQuestionnaireCommentSelect->questionnaireCommentSelect($_POST['board_id'], $comment['questionary_id'], $user_id);
                    ?>
                    <div class="comment_questionnaire">
                        <div>ID:<?php echo $comment['comment_id'];?></div>
                        <h3 class="comment_questionnaire_title"><?php echo $searchArray['questionary_title']?></h3>
                        <?php
                            for($i = 0; $i < count($searchArray['questionary_detail']); $i++){
                        ?>
                        <div style="display: flex; margin-bottom:1%;">
                            <div class="comment_questionnaire_detail <?php if($searchArray['user_questionary_detail_id'] == $searchArray['questionary_detail_id'][$i]){echo "user_vote";}?>"><?php echo $searchArray['questionary_detail'][$i]?></div>
                            <div><?php echo $searchArray['questionary_votes'][$i]."票".round($searchArray['questionary_percent'][$i], 1)."%"?></div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                    <div style="border-bottom: 1px solid gray;"></div>
                    <?php
                        }
                    ?>
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
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="fixed_toggle_button" style="height:15px;width:30px;">
                    <label class="form-check-label" for="fixed_toggle_button" style="font-size:0.8rem;">固定コメント機能ボタン</label>
                </div>
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
                        <div class="fixed_comment_number"><?php echo $fixed_comment['comment_id']?></div>
                        <div class="comment_user"><?php echo $fixed_comment['user_name']?></div>
                        <div class="comment_date"><?php echo $fixed_comment['comment_date']?></div>
                        <button class="remove_fixed_button" onclick="removefixedcomment(event,<?php echo $fixed_comment['board_id'] ?>, <?php echo $fixed_comment['comment_id'] ?>)" hidden="true">
                            <div class="arrow_icon">
                                <i class="bi bi-arrow-up-left-circle-fill" style="color: #FFC122;"></i>
                            </div>
                        </button>
                    </div>
                    <div class="comment_content">
                        <div class="comment_text"><?php echo $ClsSanitize->sanitize_br($fixed_comment['comment_content'])?></div>
                    </div>
                    <?php
                        require_once '../backend/FixedCommentEvaluationSelect.php';
                        $ClsFixedCommentEvaluationSelect = new FixedCommentEvaluationSelect();
                        $fixed_comment_count = $ClsFixedCommentEvaluationSelect->fixedCommentEvaluationSelect($fixed_comment['board_id'], $fixed_comment['comment_id']);
                        $fixed_comment_user = $ClsFixedCommentEvaluationSelect->fixedCommentEvaluationUser($fixed_comment['board_id'], $fixed_comment['comment_id'], $user_id);
                        
                    ?>
                    <div id="fixed_evalution_area">
                        <input class="fixed_comment_user_evaluation" type="hidden" value="<?php echo $fixed_comment_user[0]['evaluation'];?>">
                        <button class="fixed_good" onclick="fixedCommentGood(event,<?php echo $fixed_comment['board_id'].','.$fixed_comment['comment_id'].','.$user_id.','.$fixed_comment_user[0]['evaluation']?>)">
                            <i class="bi bi-hand-thumbs-up" <?php if($fixed_comment_user[0]['evaluation'] == 1){echo "hidden";}?>></i>
                            <i class="bi bi-hand-thumbs-up-fill" style="color:red;" <?php if($fixed_comment_user[0]['evaluation'] != 1){echo "hidden";}?>></i>
                            <span class="evaluation_count_good"><?php echo $fixed_comment_count[0]['high']?></span>
                        </button>
                        <button class="fixed_bad" onclick="fixedCommentBad(event,<?php echo $fixed_comment['board_id'].','.$fixed_comment['comment_id'].','.$user_id.','.$fixed_comment_user[0]['evaluation']?>)">
                            <i class="bi bi-hand-thumbs-down" <?php if($fixed_comment_user[0]['evaluation'] == 0){echo "hidden";}?>></i>
                            <i class="bi bi-hand-thumbs-down-fill" style="color:blue;" <?php if($fixed_comment_user[0]['evaluation'] != 0){echo "hidden";}?>></i>
                            <span class="evaluation_count_bad"><?php echo $fixed_comment_count[0]['low']?></span>
                        </button>
                    </div>
                    <?php
                    ?>
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
                    <div id="fixed_evalution_area">
                        <input class="fixed_comment_user_evaluation" type="hidden" value="">
                        <button class="fixed_good" onclick="fixedCommentGood()">
                            <i class="bi bi-hand-thumbs-up"></i>
                            <i class="bi bi-hand-thumbs-up-fill" style="color:red;"></i>
                            <span class="evaluation_count_good"></span>
                        </button>
                        <button class="fixed_bad" onclick="fixedCommentBad()">
                            <i class="bi bi-hand-thumbs-down"></i>
                            <i class="bi bi-hand-thumbs-down-fill" style="color:blue;"></i>
                            <span class="evaluation_count_bad"></span>
                        </button>
                    </div>
                </div>
                <div style="height:10%;"></div>
            </div>

        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../static/js/Board.js"></script>
        <script src="../static/js/FixedComment.js"></script>
    </body>
</html>