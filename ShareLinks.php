<?php

namespace webulla\sharelinks;

use Yii;
use webulla\sharelinks\assets\ShareLinksAsset;
use yii\helpers\Html;
use yii\helpers\VarDumper;

class ShareLinks extends \yii\base\Widget {

	/**
	 * @var string
	 */
	public $url;

	/**
	 * @var string
	 */
	public $title;

	/**
	 * @var string
	 */
	public $body;

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
		'email' => ['label' => 'Share via E-mail', 'url' => 'mailto:?subject={title}&body={body} {url}', 'options' => ['class' => 'share-link-manual']],
	];

	/**
	 * @var array
	 */
	private $_links = [];


	/**
	 * @param $data
	 */
	public function setLinks($data) {
		foreach($data as $key => $link) {
			if(isset($this->services[$key])) {
				$link = array_merge($this->services[$key], $link);
			}

			$this->_links[$key] = $link;
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
		$this->title = $this->title ?: Yii::$app->view->title;
		$this->url = $this->url ?: Yii::$app->request->absoluteUrl;

		ShareLinksAsset::register($this->view);
	}

	/**
	 * @inheritdoc
	 */
	public function run() {
		$this->view->registerJs('$("' . $this->selector . '").sharelinks(' . ($this->clientOptions ? json_encode($this->clientOptions) : '') . ');');

		$items = [];
		foreach($this->getLinks() as $link) {
			if(isset($link['options'])) {
				$link['options'] = array_merge($this->linkOptions, $link['options']);
				if(isset($this->linkOptions['class'])) {
					Html::addCssClass($link['options'], $this->linkOptions['class']);
				}
			} else {
				$link['options'] = $this->linkOptions;
			}

			$items[] = Html::a($link['label'], $this->renderUrl($link['url']), $link['options']);
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