# DockerBuilder


![screenshot](https://raw.github.com/aozora0000/dockerbuilder/master/screen.gif)

## はじめに
[jenkins-ci-php](https://github.com/aozora0000/jenkins-ci-php)の様にGitブランチ別でDockerfileをビルド・ビルドテストする為のスクリプトです。

## 依存関係
- osx 10.9.5のみ確認
- php5.3.3以上
- docker1.4.1のみ確認
- git1.9.3のみ確認

## インストール
### /usr/bin以下にインストール
```
$ curl -L https://raw.githubusercontent.com/aozora0000/dockerbuilder/master/update.sh | bash
$ chmod a+x dockerbuilder.phar && mv dockerbuilder.phar /usr/bin/dockerbuilder
```

### /usr/local/bin以下にインストール
```
$ curl -L https://raw.githubusercontent.com/aozora0000/dockerbuilder/master/update.sh | bash
$ chmod a+x dockerbuilder.phar && mv dockerbuilder.phar /usr/local/bin/dockerbuilder
```

### ビルドインストール(要[box](http://box-project.org/))
```
$ git clone https://github.com/aozora0000/dockerbuilder.git && cd dockerbuilder
$ composer install
$ box build
```

## 使い方
### ビルド(build)
ブランチで区切られたDockerfileをビルドします。

結果は表示され、ビルド成功したDockerイメージはそのままです。
```
$ cd /path/to
$ git branch

  dev
* staging
  master

$ dockerbuilder build [imagename] [-v|--verbose]
```

### テスト(test)
ブランチで区切られたDockerfileをテストビルドします。

結果は表示され、ビルド成功したDockerイメージは削除されています。
```
$ cd /path/to
$ git branch

dev
* staging
master

$ dockerbuilder test [imagename] [-v|--verbose]
```
### オプションについて
#### imagename
ビルド用のDockerimageの名前です。デフォルトでは[ディレクトリ名]になります。

#### -v|--verbose
ビルド結果の詳細表示です。掛かった時間やビルド失敗の場合はビルドステップの詳細が表示されます。

## アップデート
```
$ curl -L https://raw.githubusercontent.com/aozora0000/dockerbuilder/master/update.sh | bash
$ chmod a+x dockerbuilder.phar && mv --force dockerbuilder.phar $(which dockerbuilder)
```

## ログについて
$HOME/dockerbuilder.log に出力されます。

## 免責事項
当スクリプトをご利用、もしくはご利用になれないことにより生じるいかなるトラブルや損害には、当方は一切の責任を負いません。
