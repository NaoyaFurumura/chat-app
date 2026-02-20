# sample-slack

Laravel × React で作る Slack ライクな Web アプリ。

## 技術スタック

- **バックエンド**: Laravel 12 (PHP 8.3)
- **フロントエンド**: React + TypeScript + Vite
- **DB**: PostgreSQL 17
- **認証**: Laravel Sanctum
- **インフラ**: Docker (Nginx + PHP-FPM + PostgreSQL)

## ディレクトリ構成

```
sample-slack/
├── docker-compose.yml
├── docker/
│   ├── php/
│   │   └── Dockerfile        # PHP-FPM イメージ
│   └── nginx/
│       └── default.conf      # Nginx 設定
├── backend/                  # Laravel API
└── frontend/                 # React SPA
```

## 環境構築

### 前提条件

- Docker / Docker Compose
- Node.js 20+
- Composer（ローカルで使う場合）

### 1. リポジトリをクローン

```bash
git clone <repository-url>
cd sample-slack
```

### 2. バックエンドの設定

```bash
cp backend/.env.example backend/.env
```

必要に応じて `backend/.env` を編集してください（デフォルト設定のままで動きます）。

### 3. Docker コンテナを起動

```bash
docker compose up -d --build
```

以下のコンテナが起動します：

| コンテナ | 役割 | ポート |
|---|---|---|
| `sample_slack_nginx` | Web サーバー | `8000` |
| `sample_slack_app` | PHP-FPM | - |
| `sample_slack_db` | PostgreSQL | `5432` |

### 4. Laravel のセットアップ

```bash
# 依存パッケージのインストール
docker compose exec app composer install

# アプリケーションキーの生成
docker compose exec app php artisan key:generate

# マイグレーションの実行
docker compose exec app php artisan migrate
```

### 5. フロントエンドのセットアップ

```bash
cd frontend
npm install
npm run dev
```

## アクセス

| URL | 説明 |
|---|---|
| http://localhost:3000 | React フロントエンド |
| http://localhost:8000 | Laravel API |
| http://localhost:8000/up | ヘルスチェック |

## よく使うコマンド

```bash
# コンテナの起動
docker compose up -d

# コンテナの停止
docker compose down

# Laravel コマンドの実行（コンテナ内）
docker compose exec app php artisan <command>

# マイグレーション
docker compose exec app php artisan migrate

# マイグレーションのリセット＋再実行
docker compose exec app php artisan migrate:fresh --seed

# Tinker（DB を対話的に操作）
docker compose exec app php artisan tinker

# ログの確認
docker compose logs -f app
```
