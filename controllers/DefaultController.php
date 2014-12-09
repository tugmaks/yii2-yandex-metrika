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

    public function actionIndex() {
        $curl = new Curl();
        $curl->get($this->module->apiUrl . '/counters?oauth_token=' . $this->module->OAuthToken);
        return $this->render('index', ['curl' => $curl]);
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
        $this->module->OAuthToken = $token;
        $this->redirect('index');
    }

    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            if (null === $this->module->OAthToken) {
                $this->redirect('auth');
            }
        }
    }

    public function actionAuth() {
        $this->redirect($this->module->OAuthUrl . '/authorize?response_type=code&client_id=' . $this->module->appId);
    }

}
