<?php

use yii\widgets\ListView;

ListView::widget(['dataProvider' => $provider, 'itemView' => '_counter', 'layout' => "{items} \n {pager}"]);


