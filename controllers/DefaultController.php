<?php

namespace tugmaks\YandexMetrika\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use Curl\Curl;

class DefaultController extends Controller {

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

    public function actionIndex(){
        $curl = new Curl();
        $curl->get($this->module->apiUrl . '/counters?oauth_token=' . $this->module->OAuthToken);
        return $this->render('index', ['curl' => $curl]);
    }

    public function actionAuth() {
        $this->redirect('https://oauth.yandex.ru/authorize?response_type=token&client_id='.$this->module->appId.'&display=popup');
    }
    
    public function actionVerificationCode() {
        var_dump(Yii::$app->request);
    }

}
