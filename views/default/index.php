<?php

use yii\widgets\ListView;

echo ListView::widget(['dataProvider' => $provider, 'itemView' => '_counter', 'layout' => "{items} \n {pager}"]);
?>
<?php foreach ($this->context->module->getCounters() as $counter): ?>
    <?php var_dump($counter) ?>
<?php endforeach; ?>

