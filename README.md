Yii2 Yandex Metrika module
==========================
Module to rule your yandex metrika counters.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist tugmaks/yii2-yandex-metrika-module "*"
```

or add

```
"tugmaks/yii2-yandex-metrika-module": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \tugmaks\YandexMetrika\AutoloadExample::widget(); ?>```


```php
<?php
    ......
    'modules' => [
        'yandex-metrika' => [
            'class' => 'tugmaks\YandexMetrika\Module',
        ],
    ],
    ......

?>```