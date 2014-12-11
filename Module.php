<?php

namespace tugmaks\YandexMetrika;

use tugmaks\YandexMetrika\models\YmSettings;
use Curl\Curl;
use yii\web\HttpException;
use yii\helpers\ArrayHelper;

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
    public $counterStatus = [
        'CS_ERR_CONNECT' => 'Не удалось проверить (ошибка соединения).',
        'CS_ERR_DUPLICATED' => 'Установлен более одного раза.',
        'CS_ERR_HTML_CODE' => 'Установлен некорректно.',
        'CS_ERR_OTHER_HTML_CODE' => 'Уже установлен другой счетчик.',
        'CS_ERR_TIMEOUT' => 'Не удалось проверить (превышено время ожидания).',
        'CS_ERR_UNKNOWN' => 'Неизвестная ошибка.',
        'CS_NEW_COUNTER' => 'Недавно создан.',
        'CS_NA' => 'Не применим к данному счетчику.',
        'CS_NOT_EVERYWHERE' => 'Установлен не на всех страницах.',
        'CS_NOT_FOUND' => 'Не установлен.',
        'CS_NOT_FOUND_HOME' => 'Не установлен на главной странице.',
        'CS_NOT_FOUND_HOME_LOAD_DATA' => 'Не установлен на главной странице, но данные поступают.',
        'CS_OBSOLETE' => 'Установлена устаревшая версия кода счетчика.',
        'CS_OK' => 'Корректно установлен.',
        'CS_OK_NO_DATA' => 'Установлен, но данные не поступают.',
        'CS_WAIT_FOR_CHECKING' => 'Ожидает проверки наличия.',
        'CS_WAIT_FOR_CHECKING_LOAD_DATA' => 'Ожидает проверки наличия, данные поступают.',
    ];
    public $counterPermission = [
        'own' => 'Cобственный счетчик пользователя',
        'view' => 'Гостевой счетчик с уровнем доступа «только просмотр»',
        'edit' => 'Гостевой счетчик с уровнем доступа «полный доступ»'
    ];

    public function init() {
        parent::init();
        $settings = YmSettings::findOne(['id' => 1]);
        $this->OAuthToken = $settings->token;
    }

    public function getCounters($params = []) {
        $counters = $this->callApi('counters', $params)->counters->counter;
        return static::asArray($counters);
    }

    /*
     * TODO pass additional params
     */

    private function callApi($resource, $params = [], $method = self::METHOD_GET) {
        if (!array_key_exists($resource, $this->resources)) {
            throw new HttpException(404, "YM: Resource $resource not found.");
        }
        $requiredParams = [];
        $resoursePath = preg_replace_callback("/{\\w+}/", function ($matches) use ($params, &$requiredParams) {
            $match = strtr($matches[0], ['{' => '', '}' => '']);
            if (!array_key_exists($match, $params)) {
                throw new HttpException(404, "YM: Missing required $match parameter.");
            }
            $requiredParams[$match] = $params[$match];
            return $params[$match];
        }, $this->resources[$resource]);
        $resourceUrl = $this->apiUrl . $resoursePath . '?oauth_token=' . $this->OAuthToken;
        $additionalParams = array_diff($params, $requiredParams);
        $curl = new Curl();
        $curl->$method($resourceUrl, $additionalParams);

        return $curl->response;
    }

    public static function asArray($objects) {
        $output = [];
        foreach ($objects as $object) {
            $output[] = $object;
        }

        return $output;
    }

    public function getCounterStatus($code) {
        return $this->counterStatus[$code];
    }

    public function getCounterpermission($permission) {
        return $this->counterPermission[$permission];
    }

}
