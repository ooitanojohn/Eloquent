# DB接して表示

## DB用のmodelとマイグレーションを設定する
- php artisan make:model movie
- php artisan make:migration movie -c=movies

## model:movieに設定を書き込む
- movie.php 参照
## migrationに設定を書き込む
- 日時を現時刻に
- idオートインクリメント
- 2022_01_19_212555~.php 参照
## マイグレーションする
- php artisan migrate
## testデータ seeder or factory migration時にusefactory

## MovieContorollerにリソースオプションを指定してindexメソッドを設定する
- php artisan make:controller MovieController --resource

## route 設定 200 get blade