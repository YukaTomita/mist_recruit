-- スボーツランキング
-- データベース名＞sport
CREATE DATABASE sport;

-- スポーツテーブル
CREATE TABLE sports (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL
);

-- 投票結果テーブル
CREATE TABLE votes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sport_id INT NOT NULL,
  FOREIGN KEY (sport_id) REFERENCES sports(id) ON DELETE CASCADE
);
CREATE TABLE votes_history (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_ip VARCHAR(255) NOT NULL,
  sport_id INT NOT NULL,
  CONSTRAINT UNIQUE KEY unique_vote (user_ip, sport_id)
);

-- スポーツ選択欄
INSERT INTO sports (name) VALUES ('サッカー'), ('野球'), ('ラグビー'), ('バスケット'), ('テニス'), ('陸上'), ('水泳'), ('卓球'), ('格闘'), ('その他');

---------------------------------------------------------

-- キャリアアップランキング
-- データベース名＞enterprise
CREATE DATABASE enterprise;

-- オプションテーブル
CREATE TABLE options (
  id INT AUTO_INCREMENT PRIMARY KEY,
  option_name VARCHAR(255) NOT NULL
);

-- 投票結果テーブル
CREATE TABLE votes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  option_id INT NOT NULL,
  ip_address VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (option_id) REFERENCES options(id)
);

-- オプション選択欄
INSERT INTO options (option_name) VALUES ('事業内容');
INSERT INTO options (option_name) VALUES ('技術力');
INSERT INTO options (option_name) VALUES ('ネームバリュー');
INSERT INTO options (option_name) VALUES ('職場環境');
INSERT INTO options (option_name) VALUES ('年収');
INSERT INTO options (option_name) VALUES ('勤務地');
INSERT INTO options (option_name) VALUES ('会社の成長');
INSERT INTO options (option_name) VALUES ('福利厚生');
INSERT INTO options (option_name) VALUES ('雰囲気');
INSERT INTO options (option_name) VALUES ('その他');