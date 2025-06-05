# test-mogitate 🍊

## 概要
季節の果物を登録・編集・確認・削除できる商品管理Webアプリケーションです。  
LaravelとDockerを用いて開発されており、Bladeコンポーネントやフォームリクエストバリデーション、画像アップロードなどの基本機能を学ぶ教材として構築されました。

---

## 使用技術
- PHP 8.1
- Laravel 10
- MySQL
- Docker / Docker Compose
- Blade テンプレート
- Laravel コンポーネント
- Git / GitHub


## 導入手順（初回のみ）

```bash
# 1. リポジトリをクローン
git clone https://github.com/kiki1226/test-mogitate.git
cd test-mogitate

# 2. .env ファイルを作成
cp .env.example .env

# 3. Docker を起動
docker compose up -d

# 4. Laravel の初期設定
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate

# 5. ストレージリンク作成（画像アップロード表示のため）
docker compose exec app php artisan storage:link

# （任意）LinuxやMacでの権限調整
sudo chmod -R 777 storage bootstrap/cache

---
### ✅ 補足（開発中によく使うコマンド）

```bash
# キャッシュクリア（調子が悪いときに）
docker compose exec app php artisan config:clear
docker compose exec app php artisan cache:clear
docker compose exec app php artisan route:clear

# DBのリセット（開発中に使う）
docker compose exec app php artisan migrate:fresh --seed


##開発者情報
名前：赤間 芙美子
用途：学習・ポートフォリオ用