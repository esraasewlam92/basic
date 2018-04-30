<?php
namespace app\controllers;

use yii;
use yii\rest\ActiveController;
use app\models\todo;

//use linslin\yii2\curl;//this was added

class TodoController extends ActiveController
{
    public $modelClass='app\models\Todo';

    /*public function behaviors()
    {
        return array(
            'restAPI' => array('class' => '\rest\controller\Behavior')
        );
    }*/
/*
    public function Actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }
*/
    public function actionCreate()
    {
        $model= new Todo();
        $model->load(Yii::$app->post(),'');
        $model->status = 10;
        $model->save();
        return $model;
    }
    public function actionCreateTodo()
    {

        \Yii::$app-> $reponse->format = \Yii\web\Response::FORMAT_JSON;
        return array('status'=>true);
        $todo = new Todo();
        $todo ->scenario =Todo::SCENARIO_CREATE;
        $todo->attributes = \Yii::$app->request->post();
        if($todo->validate())
        {
            return array('status'=>true);
        }
        else
            {
                return array('status'=>false,'data'=>$todo->getErrors());
            }
    }

}