<?php

namespace tugmaks\YandexMetrika\models;

use Yii;

/**
 * This is the model class for table "tbl_ym_settings".
 *
 * @property integer $id
 * @property string $token
 */
class YmSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ym_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'token' => 'Token',
        ];
    }
}
