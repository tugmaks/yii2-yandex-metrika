<?php

use yii\widgets\ListView;

echo ListView::widget(['dataProvider' => $provider, 'itemView' => '_counter', 'layout' => "{items} \n {pager}"]);




