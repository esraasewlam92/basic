<?php

namespace app\models;

use Yii;

class Users extends \yii\db\ActiveRecord
{
    /*
    public $name;
    public $address;
    */
    public static function tableName()
    {
        return 'users';
    }
    public function rules()
    {
        return [
            // define validation rules here
            [['name', 'age'], 'required'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'age' => 'Age',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

}
