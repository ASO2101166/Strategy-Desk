START TRANSACTION;
-- ユーザーテーブル作成 --
CREATE TABLE users
(user_id                INT AUTO_INCREMENT, -- 会員番号
 user_name              VARCHAR(255) NOT NULL, -- ユーザー名
 password               VARCHAR(255) NOT NULL, -- パスワード
 PRIMARY KEY (user_id)
);
-- 掲示板テーブルを作成 --
CREATE TABLE boards
(board_id               INT AUTO_INCREMENT, -- 掲示板ID
 board_title            VARCHAR(255) NOT NULL, -- タイトル
 user_id                INT NOT NULL, -- 会員番号
 PRIMARY KEY (board_id),
 FOREIGN KEY (user_id) REFERENCES users(user_id)
);
-- タグテーブルを作成 --
CREATE TABLE tags
(tag_id                 INT AUTO_INCREMENT, -- タイトル
 tag_name               VARCHAR(255) NOT NULL, -- タグ名
 board_id               INT, -- 掲示板ID
 PRIMARY KEY (tag_id),
 FOREIGN KEY (board_id) REFERENCES boards(board_id)
);
-- マップテーブル作成 --
CREATE TABLE maps
(map_id                 INT AUTO_INCREMENT, -- マップID
 map_image              BLOB NOT NULL, -- マップ画像
 PRIMARY KEY (map_id)
);
-- コメントテーブルを作成 --
CREATE TABLE comments
(board_id               INT, -- 掲示板ID
 comment_id             INT, -- コメントID
 comment_content        TEXT NOT NULL, -- コメント内容
 fixed_comment          BOOLEAN NOT NULL DEFAULT 0, -- 固定コメント
 comment_date           DATETIME NOT NULL, -- 投稿日付
 questionary_id         INT, -- アンケートID
 map_id                 INT, -- マップID
 parent_board_id        INT, -- 親掲示板ID
 parent_comment_id      INT, -- 親コメントID
 user_id                INT NOT NULL, -- 会員番号
 PRIMARY KEY (board_id,comment_id),
 FOREIGN KEY (board_id) REFERENCES boards(board_id),
 FOREIGN KEY (questionary_id) REFERENCES questionaires(questionary_id),
 FOREIGN KEY (map_id) REFERENCES maps(map_id),
 FOREIGN KEY (parent_board_id,parent_comment_id) REFERENCES comments(board_id,comment_id),
 FOREIGN KEY (user_id) REFERENCES users(user_id)
);
-- コメント評価テーブル作成 --
CREATE TABLE comment_evaluations
(board_id               INT, -- 掲示板ID
 comment_id             INT, -- コメントID
 user_id                INT, -- 会員番号
 evaluation             BOOLEAN NOT NULL, -- 評価
 PRIMARY KEY (board_id,comment_id,user_id),
 FOREIGN KEY (board_id,comment_id) REFERENCES comments(board_id,comment_id),
 FOREIGN KEY (user_id) REFERENCES users(user_id)
);
-- アンケートテーブル作成 --
CREATE TABLE questionaires
(board_id               INT, -- 掲示板ID
 questionary_id         INT, -- アンケートID
 questionary_title      VARCHAR(255) NOT NULL, -- 題名
 questionary_date       DATETIME NOT NULL, -- アンケート日付
 questionary_status     BOOLEAN DEFAULT 0 -- アンケート状態
 PRIMARY KEY (board_id, questionary_id),
 FOREIGN KEY (board_id) REFERENCES boards(board_id)
);
-- アンケート詳細テーブル作成 --
CREATE TABLE questionary_details
(board_id               INT, -- 掲示板ID
 questionary_id         INT, -- アンケートID
 questionary_detail_id  INT, -- アンケート詳細ID
 questionary_detail     VARCHAR(255) NOT NULL, -- アンケート詳細
 questionary_votes      INT NOT NULL DEFAULT 0, -- 投票数
 PRIMARY KEY (board_id, questionary_id, questionary_detail_id),
 FOREIGN KEY (board_id, questionary_id) REFERENCES questionaires(board_id, questionary_id)
);
-- アンケート投票テーブル作成 --
CREATE TABLE questionary_votes
(board_id               INT, -- 掲示板ID
 questionary_id         INT, -- アンケートID
 questionary_detail_id  INT, -- アンケート詳細ID
 user_id                INT, -- 会員番号
 PRIMARY KEY (board_id, questionary_id, questionary_detail_id, user_id),
 FOREIGN KEY (board_id, questionary_id, questionary_detail_id) REFERENCES questionary_details(board_id, questionary_id, questionary_detail_id),
 FOREIGN KEY (user_id) REFERENCES users(user_id)
);
COMMIT;
