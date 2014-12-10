<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
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
                'value' => Html::a($model->site, $model->site, ['target' => '_blank']),
                'format' => 'html',
            ],
            [
                'label' => 'Статус',
                'value' => $this->context->module->getCounterStatus((string) $model->code_status),
            ],
        ],
    ]);
    ?>
</div>
