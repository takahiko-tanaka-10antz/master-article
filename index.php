<?php

require_once './vendor/autoload.php';

// CSVレコードを直接呼ぶ
$csv = App\Models\CsvManager::create("dungeon/area")->toArray('area');
foreach($csv as $key => $value)
{
	var_dump($key, $value);
}

// CSVレコードをクラスにマッピングしてから呼ぶ
$masters = App\Models\Masters\Area::findAll();
foreach ($masters as $key => $master)
{
	var_dump($key, $master);
}
var_dump($masters[1]->areaReleasedAt);