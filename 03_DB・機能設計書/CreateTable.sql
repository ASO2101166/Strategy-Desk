START TRANSACTION;
-- ユーザーテーブル作成 --
CREATE TABLE users
(user_id                INT AUTO_INCREMENT, --会員番号
 user_name              VARCHAR(255) NOT NULL, --ユーザー名
 password               VARCHAR(255) NOT NULL, --パスワード
 PRIMARY KEY (user_id)
);
-- 掲示板テーブルを作成 --
CREATE TABLE boards
(board_id               INT, --掲示板ID
 board_title            VARCHAR(255) NOT NULL, --タイトル
 board_tag              VARCHAR(255) NOT NULL, --タグ
 initial_comment        TEXT NOT NULL, --初期コメント
 user_id                INT NOT NULL, --会員番号
 PRIMARY KEY (board_id),
 FOREIGN KEY (user_id) REFERENCES users(user_id)
);
-- コメントテーブルを作成 --
CREATE TABLE comments
(board_id               INT, --掲示板ID
 comment_id             INT, --コメントID
 comment_content        TEXT NOT NULL, --コメント内容
 like_count             INT NOT NULL DEFAULT 0, --高評価数
 not_like_count         INT NOT NULL DEFAULT 0, --低評価数
 fixed_comment          BOOLEAN NOT NULL, --固定コメント
 comment_data           DATE NOT NULL, --投稿日付
 parent_comment_id      INT, --親コメントID
 user_id                INT NOT NULL, --会員番号
 PRIMARY KEY (board_id,comment_id),
 FOREIGN KEY (board_id) REFERENCES boards(board_id),
 FOREIGN KEY (parent_comment_id) REFERENCES comments(comment_id),
 FOREIGN KEY (user_id) REFERENCES users(user_id)
);
-- マップテーブル作成 --
CREATE TABLE maps
(map_id                 INT, --マップID
 map_image              BLOB NOT NULL, --マップ画像
 PRIMARY KEY (map_id)
);
-- マップ部品テーブル作成 --
CREATE TABLE map_parts
(map_parts_id           INT, --マップ部品ID
 map_parts_image        VARCHAR(255) NOT NULL, --マップ部品画像
 PRIMARY KEY (map_parts_id)
);
-- アンケートテーブル作成 --
CREATE TABLE questionaires
(questionary_id         INT, --アンケートID
 questionary_title      VARCHAR(255) NOT NULL, --題名
 questionary_all_votes  INT NOT NULL DEFAULT 0, --全体投票数
 PRIMARY KEY (questionary_id)
);
-- アンケート詳細テーブル作成 --
CREATE TABLE questionary_details
(questionary_id         INT, --アンケートID
 questionary_detail_id  INT, --アンケート詳細ID
 questionary_detail     VARCHAR(255) NOT NULL, --アンケート詳細
 questionary_votes      INT NOT NULL DEFAULT 0, --投票数
 PRIMARY KEY (questionary_id,questionary_detail_id),
 FOREIGN KEY (questionary_id) REFERENCES questionaires(questionary_id)
);
-- アンケート投票テーブル作成 --
CREATE TABLE questionary_
(questionary_id         INT, --アンケートID
 user_id                INT, --会員番号
 PRIMARY KEY (questionary_id,user_id),
 FOREIGN KEY (questionary_id) REFERENCES questionaires(questionary_id),
 FOREIGN KEY (user_id) REFERENCES users(user_id)
);
COMMIT;
