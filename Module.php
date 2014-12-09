<?php

namespace tugmaks\YandexMetrika;

class Module extends \yii\base\Module {

    public $allowedRoles = ['Superadministrator'];
    public $controllerNamespace = 'tugmaks\YandexMetrika\controllers';
    public $OAuthToken;
    public $OAuthPassword;

    public function init() {
        parent::init();

        // custom initialization code goes here
    }

}
