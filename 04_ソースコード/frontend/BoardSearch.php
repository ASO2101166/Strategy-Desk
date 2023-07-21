<link rel="stylesheet" href="../static/css/BoardSearch.css">
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