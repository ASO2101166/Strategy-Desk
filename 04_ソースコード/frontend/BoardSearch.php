<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <meta name="description" content="ここにサイト説明を入れます">
    <link rel="stylesheet" href="../static/css/BoardSearch.css">
    </head>
    <body>
        <!-- 複製用 -->
        <div id="clone_search_board_area" class="search_board_area" hidden="true">
            <form action="Board.php" method="post">
                <input type="hidden" name="board_id" value="">
                <button class="search_form_button" type="submit">
                    <h3 class="search_title"></h3>
                    <div class="search_tag_area">
                        <!-- タグ追加 -->
                    </div>    
                </button>
            </form>
        </div>
        <main id="search_main">
            <!-- 複製されたものはここに挿入される -->
        </main>
        <script src="../static/js/BoardSearch.js"></script>
    </body>
</html>