<?php

namespace app\models;

use Yii;
class User_old extends \yii\db\ActiveRecord
{

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            array(
                'ext.starship.RestfullYii.filters.ERestFilter + 
			 	REST.GET, REST.PUT, REST.POST, REST.DELETE'
            ),
        );
    }
    public function actions()
    {
        return array(
            'REST.'=>'ext.starship.RestfullYii.actions.ERestActionProvider',
        );
    }
    public function accessRules()
    {
        return array(
            array('allow', 'actions'=>array('REST.GET', 'REST.PUT', 'REST.POST', 'REST.DELETE'),
                'users'=>array('*'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
}