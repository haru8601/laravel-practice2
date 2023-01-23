# laravel 練習 2

# 概要

laravel 練習プロジェクト 2 つ目

# 環境構築

## git clone

```sh
git clone git@github.com:haru8601/laravel-practice2.git
```

## 環境変数ファイル生成

```sh
cd $PROJECT_ROOT/src
cp .env.example .env
# 必要に応じて.envを編集
```

## submodule 取り込み

```sh
git submodule update --init
```

## docker-compose 修正

DB データの永続化を防ぐため、<br>
`/laradock/docker-compose.yml`ファイルから`services.postgers.volumes`プロパティを削除(またはコメントアウト)

<br>

# 起動・停止

## 起動

```sh
cd $PROJECT_ROOT/laradock
docker-compose up -d workspace nginx postgres
```

## 停止

```sh
cd $PROJECT_ROOT/laradock
docker-compose down
```

## 再起動

```sh
cd $PROJECT_ROOT/laradock
docker-compose restart
```

# Docker

## docker アクセス開始

```sh
cd $PROJECT_ROOT/laradock
docker-compose exec workspace bash
```

## postgres アクセス開始

```sh
psql -h laradock-postgres-1 -U {ユーザー名} -p 5432
```

## postgres アクセス終了

```sh
\q
```

## docker アクセス終了

```sh
exit
```

# URL 設計

| URL                    | Method | ページ名                    |
| ---------------------- | ------ | --------------------------- |
| /                      | GET    | ホーム                      |
| /bbs                   | GET    | 投稿画面                    |
| /bbs                   | POST   | 投稿                        |
| /bbs/like/${bbs_id}    | GET    | 投稿いいね                  |
| /bbs/delete/${商品 ID} | GET    | 投稿削除                    |
| /login/github          | GET    | github ログイン             |
| /login/github/callback | GET    | github ログインコールバック |
