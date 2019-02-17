<h2 align="center">二週間課題</h2>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>


##背景

- 面接課題

- 予定時間:二週間

- 目標:二週間で作成できるあアプリを考えて、完成します。

- 


##要件定義

- ユーザー対象

　1.ゲスト

　2.会員

　3.管理者


##APIドキュメント
---

###RESTfulとは

REpresentational State Transferの略で、分散型システムにおける複数のソフトウェアを連携させるのに適した設計原則の集合、考え方のこと。Roy Fieldingが2000年に提唱した。

###RESTの原則

主に以下の4つの原則から成る。

- アドレス可能性(Addressability)
提供する情報がURIを通して表現できること。全ての情報はURIで表現される一意なアドレスを持っていること。

- ステートレス性(Stateless)
HTTPをベースにしたステートレスなクライアント/サーバプロトコルであること。セッション等の状態管理はせず、やり取りされる情報はそれ自体で完結して解釈できること。
- 接続性(Connectability)
情報の内部に、別の情報や(その情報の別の)状態へのリンクを含めることができること。
- 統一インターフェース(Uniform Interface)
情報の操作(取得、作成、更新、削除)は全てHTTPメソッド(GET、POST、PUT、DELETE)を利用すること。

###RESTful APIを使うメリット

>URIに規律が生まれることで、APIを利用するサービス開発者が楽になる
URIに規律が生まれることで、API開発者もURIからソースのどの部分なのかが容易にわかる
ブラウザのアドレスバーにURIを入力すればリソースが参照できる
サーバ、クライアント間で何も共有しないことにより、負荷に応じたスケーラビリティが向上する。ステートレス性に値するもので、一番のメリットされている。
GET、POST、PUT、DELETE等のHTTP標準のメソッドを使うことで、シンプルで一貫性のあるリクエスト標準化が円滑に行える。統一インターフェースに値する。
