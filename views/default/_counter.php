<?php

use yii\widgets\DetailView;
use tugmaks\YandexMetrika\Module;
?>
<div style="margin: 5px;width: 250px; float: left">
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Статус',
                'value' => Module::getCounterStatus($model->counter_status),
            ],
        ],
    ]);
    ?>
</div>
