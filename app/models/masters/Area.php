<?php

namespace App\Models\Masters;

use App\Models\Master;

class Area extends Master
{
	/** @var string ファイル名 */
	static $filename = 'dungeon/area';
	/** @var string 主キー */
	static $primaryKey = 'area';

	public $area;
	public $areaClearReward;
	public $areaClearRewardNum;
	public $areaReleasedAt;
}