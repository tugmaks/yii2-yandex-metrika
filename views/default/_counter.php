<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div style="margin: 5px;width: 250px; float: left">

    <?php
    var_dump($model);
    echo
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Сайт',
                'value' => Html::a($model->site, Url::to($model->site, true), ['target' => '_blank']),
                'format' => 'html',
            ],
            [
                'label' => 'Статус',
                'value' => $this->context->module->getCounterStatus((string) $model->code_status),
            ],
            [
                'label' => 'Уровень доступа',
                'value' => $this->context->module->getCounterPermission((string) $model->permission),
            ],
        ],
    ]);
    ?>
</div>
