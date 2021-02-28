# Vue.js + laravel で作る生産記録アプリ

アプリ名 : **生産記録・指示書管理アプリ**

アプリイメージGIF  
![preview](https://user-images.githubusercontent.com/64804227/109412552-018a0f80-79ec-11eb-8c57-b3d0289931af.gif)

アプリへ移動  
[https://portfolio-vue-laravel.herokuapp.com/](https://portfolio-vue-laravel.herokuapp.com/)

[GitHub : nakaji0501/portfolio](https://github.com/nakaji0501/portfolio)

# アプリ説明

## コンセプト

### 製造現場で生産状況を記録に残し過去の生産履歴として閲覧しやすくする手段として発案。
- 生産時の注意点や過去の異常・トラブルを記録として残す。
- 検索機能ですぐにデータを表示できる。
- 忘れやすい指示書を写真として残し閲覧できる。

## 使い方

### 非ログイン状態で利用できる事
1. 記録を閲覧する
2. 記録に対するコメントを閲覧する
3. 指示書の写真を閲覧する

### ログイン状態で利用できる事
1. 記録を残す
2. 記録に対してコメントする
3. 自分の記録およびにコメントを削除する
4. 指示書の写真を保存する

# 開発環境

- Vue.js
    - vue:2.6.12
    - vue-router:3.4.9
    - vuex:3.6.
    - vue/cli:4.5.9

- PHP:7.4.13
- Laravel:2.3.0

- npm:6.14.9
- node:v14.14.0

- Docker:19.03.13
- MySQL:8.0.22 for osx10.13 on x86_64 (Homebrew)

- macOS High Sierra 10.13.6

# 参考にしたサイト

https://www.hypertextcandy.com/vue-laravel-tutorial-introduction/

https://github.com/natsukoshi/Laravel_Vue_Board

# 実装した機能
- ユーザー認証
- ログイン・ログアウト
- 記録・コメントを投稿
- 記録・コメントを削除
- バリデーションエラー
- エラーページ

# 制作期間

第一部 2020/12/08 ~ 2021/1/30  
上記、"実装した機能を参照"
第二部 2021/2/1 ~ 色々な機能を追加予定 (2021/2/28)
- 写真の保存(実装済み)  
- 自身の記録・コメントを一覧で表示(未実装)

# 製作者について

ご閲覧頂きありがとうございます。  
製作者の 中島 と申します。  

2020年5月から独学でプログラミングを学習しています。  
興味本位でプログラミングに触れてみたところ、自分で書いたコードがWEB上で表示され動いていることが嬉しくなり、もっと色々なサービスを作ってみたいと考え始めました。  
それからはフロントエンド開発の業務に携わりたいと思い毎日学習を続けています。  

私の自己紹介として下記のサイトもご覧いただけますと嬉しいです。  

> [自己紹介サイト : https://vuefolio0501.web.app/](https://vuefolio0501.web.app/)

> [Twitter : @nakaji_junk](https://twitter.com/@nakaji_junk)

> [GitHub : nakaji0501/portfolio](https://github.com/nakaji0501/portfolio)

最後に、お忙しい中ここまで見てくださりありがとうございました。

# Licence

[MIT : https://portfolio-vue-laravel.herokuapp.com/](https://portfolio-vue-laravel.herokuapp.com/)