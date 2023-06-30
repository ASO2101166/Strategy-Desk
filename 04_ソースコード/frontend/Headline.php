<link rel="stylesheet" href="../static/css/Headine.css">
<header id="headline" class="sticky-top">
  <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">◀</a>
      <input id="search_form" class="form-control w-50" type="text" placeholder="掲示板検索" aria-label="default input example">
      <a href="Login.php">
        <button class="btn btn-outline-success">ログイン
      </button>
      </a>
    </div>
  </nav>
</header>
<!-- 掲示板検索画面表示 -->
<div id="boardsearch_background" hidden="true"></div>
<div id="add_boardsearch_area" hidden="true">
  <?php include("BoardSearch.php")?>
</div>
<script src="../static/js/Headline.js"></script>