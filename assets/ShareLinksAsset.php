<?php
/**
 * Created by:  Pavel Kondratenko.
 * Created at:  04.04.15 17:21
 * Email:       gustarus@gmail.com
 * Web:         http://webulla.ru
 */

namespace webulla\sharelinks\assets;

use yii\web\AssetBundle;

class ShareLinksAsset extends AssetBundle {

	public $sourcePath = '@webulla/sharelinks/public';

	public $js = [
		'js/script.js'
	];

	public $depends = [
		'yii\web\JqueryAsset',
	];
} 