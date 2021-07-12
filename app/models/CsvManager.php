<?php


namespace App\Models;


class CsvManager extends \SplFileObject
{
	/** @var array  */
	private static $_instances = array();

	/**
	 * インスタンス作成
	 * ・一度開いたCSVファイルのインスタンスは保存しておく（Singleton パターン）
	 * @param $_fileName
	 * @return $this
	 */
	public static function create($_fileName)
	{
		if(array_key_exists($_fileName, static::$_instances) === false)
		{
			static::$_instances[$_fileName] = new static($_fileName);
		}
		return static::$_instances[$_fileName];
	}

	/**
	 * CsvManager constructor.
	 * @param string $_fileName
	 */
	public function __construct($_fileName)
	{
		parent::__construct(static::getFilePath($_fileName), 'r', false);
		$this->setFlags(parent::READ_CSV);
	}

	/**
	 * 対象CSVまでのファイルパスを取得
	 * @param string $_filename
	 * @return string
	 */
	private static function getFilePath($_filename = '')
	{
		return sprintf('%s/../resources/csv/'. $_filename .'.csv', __DIR__);
	}

	/**
	 * CSVを配列として取得する
	 * @param string $_primaryKey
	 * @return array
	 */
	public function toArray($_primaryKey = 'id')
	{
		$arrayedCsv = array();
		foreach($this as $key => $row)
		{
			if($key === 0)
			{
				// 1行目はヘッダー行として取り込み
				$headers = $row;
			}
			else
			{
				// 正しくない形式のレコードは除外する
				if(count($headers) != count($row) || $row[0] === null)
				{
					continue;
				}

				// ヘッダーを配列のキーとして新しい配列を作成する
				$combinedArray = array_combine($headers, $row);

				if (is_array($combinedArray))
				{
					// プライマリーキーを配列のキーとして配列を追加
					$arrayedCsv[$combinedArray[$_primaryKey]] = $combinedArray;
				}
			}
		}

		return $arrayedCsv;
	}
}