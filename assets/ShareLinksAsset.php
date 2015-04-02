<?php
/**
 * Created by:  Itella Connexions ©
 * Created at:  15:07 02.04.15
 * Developer:   Pavel Kondratenko
 * Contact:     gustarus@gmail.com
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