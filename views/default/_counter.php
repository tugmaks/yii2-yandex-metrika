<?php

use yii\widgets\DetailView;
?>
<div style="margin: 5px;width: 250px; float: left">
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Статус',
                'value' => $model->code_status,
            ],
        ],
    ]);
    ?>
</div>
