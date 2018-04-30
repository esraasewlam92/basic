<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "todo".
 *
 * @property int $id
 * @property string $todo_name
 * @property int $status
 * @property string $created_date
 */
class Todo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const SCENARIO_CREATE = 'create';
    public static function tableName()
    {
        return 'todo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['todo_name', 'status', 'created_date'], 'required'],
            [['status'], 'integer'],
            [['created_date'], 'safe'],
            [['todo_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'todo_name' => 'Todo Name',
            'status' => 'Status',
            'created_date' => 'Created Date',
        ];
    }

    public function Scenarios()
    {
        $scenarios = parent::Scenarios();
        $scenarios['create']=['todo_name','status','created_date'];
        return $scenarios;
    }
}
