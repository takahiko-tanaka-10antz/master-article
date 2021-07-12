# ブラウザゲームで使われるマスターデータの解説

ブログへのリンク
* [#1 マスターデータの扱い方](https://developers.10antz.co.jp/archives/1897)
* [#2 マスターデータをコード側でどう扱うのか](https://developers.10antz.co.jp/archives/1925)

フォルダ構成

```
├── README.md
├── app
│   ├── models
│   │   ├── CsvManager.php  CSV管理用クラス
│   │   ├── Master.php  マスターデータ管理用クラス
│   │   └── masters  マッピングするクラスオブジェクト用フォルダ
│   └── resources
│    　└── csv  マスターデータ用フォルダ
│   　　├── dungeon
│  　　 │   ├── area.csv
│   　　│   └── floor.csv
├── composer.json
├── index.php
└── vendor
```
