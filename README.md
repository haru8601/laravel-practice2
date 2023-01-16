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

# Docker

## アクセス開始

```sh
cd $PROJECT_ROOT/laradock
docker-compose exec workspace bash
```

## アクセス終了

```sh
exit
```