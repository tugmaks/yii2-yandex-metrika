Yii2 Yandex Metrika module
==========================
Module to rule your yandex metrika counters.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist tugmaks/yii2-yandex-metrika "*"
```

or add

```
"tugmaks/yii2-yandex-metrika": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply activate module in config file:

```php
<?php
    ......
   'modules' => [
        'yandex-metrika' => [
            'class' => 'tugmaks\YandexMetrika\Module',
            'allowedRoles'=>['@'],
            /*
             * Or if you use RBAC roles something like that
             * 'allowedRoles'=>['Admin','Seo-Manager'],
             */
            'appId' => 'd6abf71d461d4f41ae3c8aed3b533f56',
            'appPassword' => '48596fb6a18a4f509596252c77a9e5b3',
        ],
    ],
    ......

?>
```