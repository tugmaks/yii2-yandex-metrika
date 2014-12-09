<?php

namespace tugmaks\YandexMetrika;

use tugmaks\YandexMetrika\models\YmSettings;

class Module extends \yii\base\Module {

    public $allowedRoles = ['Superadministrator'];
    public $controllerNamespace = 'tugmaks\YandexMetrika\controllers';
    public $appId;
    public $appPassword;
    public $OAuthToken = null;
    public $apiUrl = 'http://api-metrika.yandex.ru';
    public $OAuthUrl = 'https://oauth.yandex.ru';

    public function init() {
        parent::init();
        $settings = YmSettings::findOne(['id' => 1]);
        $this->OAuthToken = $settings->token;

        // custom initialization code goes here
    }

}
