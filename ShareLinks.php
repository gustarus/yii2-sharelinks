<?php
namespace webulla\sharelinks;

use Yii;
use webulla\sharelinks\assets\ShareLinksAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class ShareLinks extends \yii\base\Widget {

	/**
	 * @var string
	 */
	public $url;

	/**
	 * @var string
	 */
	public $selector = '.share .share-link';

	/**
	 * @var array
	 */
	public $clientOptions = [];

	/**
	 * @var array
	 */
	public $containerOptions = [
		'class' => 'share',
	];

	/**
	 * @var array
	 */
	public $linkOptions = [
		'class' => 'share-link',
	];

	/**
	 * @var array
	 */
	public $services = [
		'twitter' => ['label' => 'Share via twitter', 'url' => 'https://twitter.com/intent/tweet?url={url}'],
		'facebook' => ['label' => 'Share via Facebook', 'url' => 'https://www.facebook.com/sharer/sharer.php?u={url}'],
		'vkontakte' => ['label' => 'Share via Vkontakte', 'url' => 'http://vk.com/share.php?url={url}'],
		'gplus' => ['label' => 'Share via Google Plus', 'url' => 'https://plus.google.com/share?url={url}'],
		'linkedin' => ['label' => 'Share via Linkedin', 'url' => 'http://www.linkedin.com/shareArticle?url={url}'],
		'kindle' => ['label' => 'Share via Kindle', 'url' => 'http://fivefilters.org/kindle-it/send.php?url={url}'],
	];

	/**
	 * @var array
	 */
	private $_links = [];


	/**
	 * @param $data
	 */
	public function setLinks($data) {
		foreach($data as $service => $options) {
			$link = isset($this->services[$service]) ? $this->services[$service] : [];
			$link = array_merge($link, $options);
			$this->_links[] = $link;
		}
	}

	/**
	 * @return array
	 */
	public function getLinks() {
		return $this->_links;
	}

	/**
	 * @inheritdoc
	 */
	public function init() {
		$this->url = (empty($this->url)) ? Yii::$app->request->absoluteUrl : $this->url;
		ShareLinksAsset::register($this->view);
	}

	/**
	 * @inheritdoc
	 */
	public function run() {
		$this->view->registerJs('$("' . $this->selector . '").shareLinks(' . json_encode($this->options) . ');');

		$items = [];
		foreach($this->getLinks() as $link) {
			$items[] = Html::a($link['label'], $this->renderUrl($link['url']), isset($link['options']) ? array_merge($this->linkOptions, $link['options']) : $this->linkOptions);
		}

		echo Html::tag('div', implode('', $items), $this->containerOptions);
	}

	/**
	 * @param string $url
	 * @return string
	 */
	public function renderUrl($url) {
		return str_replace(['{url}', '{title}', '{body}'], [urlencode($this->url), urlencode($this->title), urlencode($this->body)], $url);
	}
}