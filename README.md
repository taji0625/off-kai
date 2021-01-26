# オフ会.com
「イベントを企画・告知し、交流しよう！」  

オフラインイベントを企画し、告知することで、ユーザー同士がオフラインで交流することを目的にしたアプリです。<br>
イベントの告知を主とし、コメント機能、フォロー機能も追加し、SNSの要素も加えました。


<img width="1676" alt="スクリーンショット 2021-01-26 10 25 46" src="https://user-images.githubusercontent.com/63524359/105786732-fbee7380-5fc0-11eb-8cb4-c9fcf54bfb3f.png">


# URL
https://o-ff-kai.com 

※ゲストログインボタンを設置しており、簡単にログインできます。  


# 開発の背景

「地方でも同じ志を持った方とリアルで繋がりたい」<br>
そんな想いがありこのアプリを開発しました。<br>
私が所属しているエンジニア向けのオンラインサロンでは、オフラインイベントとして、定期的に交流会やもくもく会が開催されていました。<br>
しかし、それは東京、大阪など大都市圏での開催でした。
私は熊本県在住の為、参加することはできませんでした。<br>
そこで地方でも、同じ志を持った方と交流できるイベントを企画し告知できるサービスがあれば、私のような想いを持った地方在住者の方の課題解決になると思い、このサービスを開発しました。




# 使用技術
### フロントエンド
- HTML 
- Sass  
- JavaScript
- Vue.js
- jQuery
- Bootstrap  
### バックエンド
- PHP 7.3.23
- Laravel 8.24.0  
### データベース
- MySQL 5.7.31
### 開発環境  
- Docker
- Docker Compose
### 本番環境
- AWS(EC2、VPC、S3、RDS for MySQL、Route53、ALB、ACM)  
- Nginx 1.18.0 
### その他
- AWS・ACMにてSSL証明書を発行しSSL化   


# 機能一覧
### ユーザー機能
- ユーザー登録・ログイン（laravel/uiを使用) 
- ゲストログイン 
- プロフィール画像の登録・編集
- プロフィール画像アップロード時のプレビュー 
- ユーザー詳細ページにて自分の投稿、興味あり！を押した投稿の一覧表示(タブで切替)  
### オフ会プラン投稿機能
- 新規投稿・編集・削除 
- 画像アップロード時のプレビュー 
- 未入力項目がある時のバリデーション 
- 編集時、前回の値の保持 
### 興味あり！（いいね!）機能
- 非同期通信 (Vue.jsを使用)
- ボタンを押した際のハートマークのアニメーション 
### コメント機能
- 新規投稿・削除 
- 削除ができるのはコメントしたユーザーと、コメントされた投稿をしたユーザー  
### 参加ボタン機能
- 参加ボタンを押す際に確認ダイアログの表示 
- 定員に達すると参加ボタンを押せなくなる  
- 開催日時を過ぎると参加ボタンを押せなくなる
### フォロー機能
- 非同期通信 (Vue.jsを使用)
- 以下のページにフォロータグを配置 
  + ユーザー詳細ページ  
  + フォロー・フォロワー一覧ページ
### タグ機能
- 非同期通信 (Vue.jsを使用)
- タグ毎のオフ会一覧ページ
- 登録済みタグの自動補完

### その他
- 検索機能
- フラッシュメッセージ (Toastrを使用)
- バリデーションエラーメッセージ (日本語化)
- レスポンシブ対応 (Bootstrap)
- 以下のページにてページネーションを採用
  + オフ会一覧ページ 


# 工夫した点
- 定員に達した時・開催日時が過ぎた時に、参加ボタンを押せなくなるようにした点
- 画像プレビュー機能を付け、画像のアップロードをわかりやすくした点
- ユーザーが操作しやすいUIを意識した点

# 躓いて克服した点
- 画像をS3にアップロードする設定  
- composer関連のエラー
  + メモリ不足エラー
  + バージョンエラー

# 今後実装予定の機能
- PHPUnitを用いたテストコードの実装
- Google Maps APIを用いた地図機能の実装


# AWS構成図
<img width="981" alt="スクリーンショット 2021-01-26 11 14 36" src="https://user-images.githubusercontent.com/63524359/105790471-c8631780-5fc7-11eb-954a-3f776480bf14.png">

# ER図
<img width="765" alt="スクリーンショット 2021-01-24 17 49 27" src="https://user-images.githubusercontent.com/63524359/105786428-6b179800-5fc0-11eb-9784-ea8b4e2158cf.png">