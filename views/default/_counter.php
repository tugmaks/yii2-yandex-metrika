<?php

use yii\widgets\DetailView;
?>
<div style="margin: 5px;width: 250px; float: left">

    <?php
    var_dump($model->code_status);
    echo
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Статус',
                'value' => $this->context->module->getCounterStatus((string)$model->code_status),
            ],
        ],
    ]);
    ?>
</div>
