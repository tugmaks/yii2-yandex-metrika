<?php

use yii\db\Schema;
use yii\db\Migration;

class m01012015_000000_init extends Migration {

    public function safeUp() {
        $this->createTable('tbl_ym_settings', [
            'id' => 'pk',
            'token' => Schema::TYPE_STRING . " NULL DEFAULT NULL COMMENT'Yandex Token'",
                ], "COMMENT'Module Settings'"
        );
    }

    public function down() {
        $this->dropTable('tbl_ym_settings');
    }

}
