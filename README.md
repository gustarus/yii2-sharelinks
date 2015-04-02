Webulla Yii2 sharing links widget
======================

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ ./composer require "webulla/yii2-share_links":"*"
```

## Usage

First, you need to connect the widget:
```php
use webulla\sharelinks\ShareLinks;
```

Then, you can use widget with default configurations:
```php
echo ShareLinks::widget([
	'links' => [
		'vkontakte' => [],
		'email' => [],
	]
]);
```

Or, you can override any default settings:
```php
echo ShareLinks::widget([
	'links' => [
        // default service
		'facebook' => ['label' => 'Facebook'],

		// custom service in popup window
		'service' => ['label' => 'Share via Service',
		    'url' => 'http://service.com/share?title={title}&body={body}&url={url}'
        ],

		// custom service in new tab
		'service-manual' => ['label' => 'Share via Service',
		    'url' => 'http://service.com/share?title={title}&body={body}&url={url}',
            'options' => [
                'class' => 'share-link-manual',  // disable on click event listening
                'target' => '_blank', // open link in new tab
            ]
        ],
	]
]);
```

Predefined services:
```php
$services = [
	'twitter' => ['label' => 'Share via twitter'],
	'facebook' => ['label' => 'Share via Facebook'],
	'vkontakte' => ['label' => 'Share via Vkontakte'],
	'gplus' => ['label' => 'Share via Google Plus'],
	'linkedin' => ['label' => 'Share via Linkedin'],
	'kindle' => ['label' => 'Share via Kindle'],
	'email' => ['label' => 'Share via E-mail'],
];
```
