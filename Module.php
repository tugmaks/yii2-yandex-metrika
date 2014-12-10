<?php

namespace tugmaks\YandexMetrika;

use tugmaks\YandexMetrika\models\YmSettings;
use Curl\Curl;
use yii\web\HttpException;

class Module extends \yii\base\Module {

    const METHOD_GET = 'get';
    const METHOD_POST = 'post';
    const METHOD_PUT = 'put';
    const METHOD_DELETE = 'delete';

    public $allowedRoles = ['Superadministrator'];
    public $controllerNamespace = 'tugmaks\YandexMetrika\controllers';
    public $appId;
    public $appPassword;
    public $OAuthToken = null;
    public $apiUrl = 'http://api-metrika.yandex.ru';
    public $OAuthUrl = 'https://oauth.yandex.ru';
    public $resources = [
        'counters' => '/counters',
        'counter' => '/counter/{id}',
        'counter_goals' => '/counter/{id}/goals',
        'counter_goal' => '/counter/{id}/goal/{goal_id}',
        'counter_filters' => '/counter/{id}/filters',
        'counter_filter' => '/counter/{id}/filter/{filter_id}',
        'counter_operations' => '/counter/{id}/operations',
        'counter_operation' => '/counter/{id}/operation/{operation_id}',
        'counter_grants' => '/counter/{id}/grants',
        'counter_grant' => '/counter/{id}/grant/{user_login}',
        'delegates' => '/delegates',
        'delegate' => '/delegate/{user_login}',
        'accounts' => '/accounts',
        'account' => '/account/{user_login}',
    ];

    public function init() {
        parent::init();
        $settings = YmSettings::findOne(['id' => 1]);
        $this->OAuthToken = $settings->token;
    }

    public function callApi($resource, $params = [], $method = self::METHOD_GET) {
        if (!array_key_exists($resource, $this->resources)) {
            throw new HttpException(404, 'YM: Resource not found');
        }
    }

}
