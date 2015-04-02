Webulla Yii2 sharing links widget
======================

Usage
-----

First, you need to connect the widget:
```php
use webulla\sharelinks\ShareLinks;
```

Then, you can use widget with default configurations:
```php
<? echo ShareLinks::widget([
	'links' => [
		'vkontakte' => [],
		'email' => [],
	]
]); ?>
```

Or, you can override any default settings:
```php
<? echo ShareLinks::widget([
	'links' => [
        // use default service
		'facebook' => [],

		// use custom service in popup window
		['label' => 'Share via Service', 'url' => 'http://service.com/share?title={title}&body={body}&url={url}'],

		// yse custom service in new tab
		['label' => 'Share via Service', 'url' => 'http://service.com/share?title={title}&body={body}&url={url}', 'options' => [
		    'class' => 'share-link-manual',  // disable on click event listening
		    'target' => '_blank', // open link in new tab
        ]],
	]
]); ?>
```


