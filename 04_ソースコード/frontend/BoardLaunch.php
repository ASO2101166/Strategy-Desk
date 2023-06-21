<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="ここにサイト説明を入れます">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../static/css/BoardLaunch.css">
    </head>
    <body>
        <div class="container-fluid">
            <div class="main">
                <h2 class="midashi">掲示板立ち上げ</h2>
                <form action="../backend/BoardCreation.php" method="post">
                    <!-- 議題名 -->
                    <div class="mt-3 mb-3">
                        <input name="title" class="form-control form-control-lg" type="text" placeholder="議題名" required>
                    </div>
                    <!-- 複製用tag_area -->
                    <div align="right" id="tag_area" class="mt-3 tag_area" style="display: none;">
                        <input class="form-control" type="text" placeholder="タグ付け" >
                        <!-- タグ削除ボタン -->
                        <div class="delete_tag_button">
                            <button type="button">
                                <i class="bi bi-dash-square" style="color: red;"></i>
                            </button>
                        </div>
                    </div>
                    <!-- 初期表示用tag_area -->
                    <div id="tag_area" class="mt-3">
                        <input name="tag[]" class="form-control" type="text" placeholder="タグ付け" required>
                    </div>
                    <!-- タグ追加ボタン -->
                    <div id="add_tag_button" align="right" class="mb-2">
                        <button type="button">
                            <i class="bi bi-plus-square"></i>
                        </button>
                    </div>
                    <!-- 初期コメント -->
                    <div class="mb-3">
                        <textarea name="first_comment" class="form-control" rows="3" placeholder="初期コメント" required></textarea>
                    </div>
                    <!-- 送信ボタン -->
                    <div align="right">
                        <button type="submit" class="btn btn-primary">作成する</button>
                    </div>
                </form>
            </div>
        </div>
        <script src="../static/js/BoardLaunch.js"></script>
    </body>
</html>
