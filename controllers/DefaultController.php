<?php

namespace tugmaks\YandexMetrika\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use tugmaks\YandexMetrika\models\YmSettings;
use tugmaks\YandexMetrika\Module;

class DefaultController extends Controller {

    public function init() {
        parent::init();
        if ($this->module->OAuthToken === null) {
            $this->redirect($this->module->OAuthUrl . '/authorize?response_type=code&client_id=' . $this->module->appId);
        }
    }

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $this->module->allowedRoles,
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $result = $this->module->callApi('counters1');
        return $this->render('index', ['result' => $result]);
    }

    public function actionVerificationCode() {
        $code = Yii::$app->request->get('code');
        $curl = new Curl();
        $curl->post($this->module->OAuthUrl . '/token', [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'client_id' => $this->module->appId,
            'client_secret' => $this->module->appPassword,
        ]);

        $token = $curl->response->access_token;
        $settings = YmSettings::findOne(['id' => 1]);
        $settings->token = $token;
        $settings->save();

        $this->redirect('/yandex-metrika/default/index');
    }

    public function actionAuth() {
        $this->redirect($this->module->OAuthUrl . '/authorize?response_type=code&client_id=' . $this->module->appId);
    }

}
