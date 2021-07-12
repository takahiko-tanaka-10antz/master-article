<?php

namespace App\Models;

class Master
{
	/** @var string ファイル名(拡張子除く) */
	static $filename = '';
	/** @var string 対象CSVファイルのプライマリーキー */
	static $primaryKey = 'id';

	public function __construct(Array $properties = array())
	{
		// 配列の中身をクラスのプロパティにマッピングする
		foreach($properties as $key => $value)
		{
			// 数値形式ならint型にキャストする
			$this->{$key} = is_numeric($value) ? (int)$value : $value;
		}
	}

	/**
	 * 全件検索
	 * @return array
	 */
	public static function findAll()
	{
		$lines = self::getCSV();
		return self::toObject($lines);
	}

	/**
	 * プライマリーキーの値で検索
	 * @param null $id
	 * @return mixed
	 */
	public static function findById($id = null)
	{
		$lines = self::getCSV();
		return self::toObject($lines)[$id];
	}

	/**
	 * 対象のCSVファイルからデータを取得
	 * @return array
	 */
	private static function getCsv()
	{
		return CsvManager::create(static::$filename)->toArray(static::$primaryKey);
	}

	/**
	 * 取得したCSVデータの配列をクラスオブジェクトにマッピングする
	 * @param $lines
	 * @return array
	 */
	protected static function toObject($lines)
	{
		$objects = array();
		foreach ($lines as $line)
		{
			// 継承先のプロパティにCSVレコードを設定する
			$instance = new static($line);
			// 配列のキーをCSVレコードの主キーにする
			$objects[$instance->{static::$primaryKey}] = $instance;
		}
		return $objects;
	}
}