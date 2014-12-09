<?php

namespace tugmaks\YandexMetrika;

class Module extends \yii\base\Module {

    public $allowedRoles = ['Superadministrator'];
    public $controllerNamespace = 'tugmaks\YandexMetrika\controllers';
    public $OAuthToken;
    public $OAuthPassword;
    public $apiUrl = 'http://api-metrika.yandex.ru';

    public function init() {
        parent::init();

        // custom initialization code goes here
    }

}
