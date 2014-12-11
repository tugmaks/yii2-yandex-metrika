<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div style="margin: 5px;width: 300px; float: left">

    <?php
    var_dump($model);
    echo
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Сайт',
                'value' => Html::a($model->site, "http://$model->site", ['target' => '_blank']),
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
            [
                'label' => 'Название',
                'value' => (string) $model->name,
            ],
            [
                'label' => 'id',
                'value' => Html::a($model->id, ['counter','id'=>(integer)$model->id]),
                'format' => 'html',
            ],
            [
                'label' => 'Тип',
                'value' => $this->context->module->getCounterType((string) $model->type),
            ],
            [
                'label' => 'Владелец',
                'value' => (string) $model->owner_login,
            ],
        ],
    ]);
    ?>
</div>
