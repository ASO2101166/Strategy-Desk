<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <meta name="description" content="ここにサイト説明を入れます">
    <!-- cssはQuestionnaire.cssを編集 -->
    <link rel="stylesheet" href="../static/css/Questionnaire.css">
    </head>
    <body>
        <div id="create_questionary_area" style="margin: 5%;" hidden="true">
            <form action="../backend/QuestionnaireCreation.php" method="post">
                <input type="hidden" id="board_id" name="board_id" value="<?php echo $_POST['board_id']?>">
                <input type="text" id="questionary_title_text" class="form-control" name="questionary_title" placeholder="アンケート題名" required>
                <div id="questionary_detail_area">
                    <!-- 複製用tag_area -->
                    <div id="clone_questionary_detail" class="questionary_detail" style="display: none;">
                        <input type="text" class="questionary_detail_text" placeholder="項目名">
                        <!-- タグ削除ボタン -->
                        <button type="button" class="delete_questionary_detail_button" onclick="delete_questionary_detail(event)">
                            <i class="bi bi-dash-square" style="color: red;"></i>
                        </button>
                    </div>
                    <!-- 初期表示用項目名 -->
                    <div class="questionary_detail">
                        <input type="text" name="questionary_detail[]" class="questionary_detail_text" placeholder="項目名" required>
                    </div>
                    <div class="questionary_detail">
                        <input type="text" name="questionary_detail[]" class="questionary_detail_text" placeholder="項目名" required>
                    </div>
                    <!-- タグ追加ボタン -->
                    <button id="add_tag_button" type="button">
                        <i class="bi bi-plus-square"></i>
                    </button>
                    <button type="submit" class="questionary_submit_btn">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </div>
            </form>
        </div>
        <div id="select_questionary_area" style="margin: 5%;" hidden="true">
            <div id="select_questionary_title">この中で一番いいのはどれですか？？？？？？？？？？？？？？？？？？</div>
            
        </div>
        <!-- 複製用 -->
        <button id="clone_select_questionary_detail_area" class="select_questionary_detail_area" hidden="true">
            <input type="hidden" value="">
            <div class="select_questionary_detail"></div>
        </button>
        <p id="time"></p>
        <script src="../static/js/Questionnaire.js"></script>
    </body>
</html>