<?php

namespace app\modules\api\controllers;
use Yii;
use app\models\Employee;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;


/**
 * EmployeeController implements the CRUD actions for loyeeEmp model.
 */
class EmployeeController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index'=>['get'],
                    'view'=>['get'],
                    'create'=>['post'],
                    'update'=>['post'],
                    'delete' => ['delete'],
                    'deleteall'=>['post'],
                ],

            ]
        ];
    }

    public function beforeAction($event)
    {
        $action = $event->id;
        if (isset($this->actions[$action])) {
            $verbs = $this->actions[$action];
        } elseif (isset($this->actions['*'])) {
            $verbs = $this->actions['*'];
        } else {
            return $event->isValid;
        }
        $verb = Yii::$app->getRequest()->getMethod();

        $allowed = array_map('strtoupper', $verbs);

        if (!in_array($verb, $allowed)) {

            $this->setHeader(400);
            echo json_encode(array('status'=>0,'error_code'=>400,'message'=>'Method not allowed'),JSON_PRETTY_PRINT);
            exit;

        }

        return true;
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {


        $params=$_REQUEST;
        $filter=array();
        $sort="";

        $page=1;
        $limit=10;

        if(isset($params['page']))
            $page=$params['page'];


        if(isset($params['limit']))
            $limit=$params['limit'];

        $offset=$limit*($page-1);


        /* Filter elements */
        if(isset($params['filter']))
        {
            $filter=(array)json_decode($params['filter']);
        }

        if(isset($params['datefilter']))
        {
            $datefilter=(array)json_decode($params['datefilter']);
        }


        if(isset($params['sort']))
        {
            $sort=$params['sort'];
            if(isset($params['order']))
            {
                if($params['order']=="false")
                    $sort.=" desc";
                else
                    $sort.=" asc";

            }
        }


        $query=new Query;
        $query->offset($offset)
            ->limit($limit)
            ->from('employee')
            ->andFilterWhere(['like', 'id', $filter['id']])
            ->andFilterWhere(['like', 'name', $filter['name']])
            ->andFilterWhere(['like', 'age', $filter['age']])
            ->orderBy($sort)
            ->select("id,name,age,createdAt,updatedAt");

        if($datefilter['from'])
        {
            $query->andWhere("createdAt >= '".$datefilter['from']."' ");
        }
        if($datefilter['to'])
        {
            $query->andWhere("createdAt <= '".$datefilter['to']."'");
        }
        $command = $query->createCommand();
        $models = $command->queryAll();

        $totalItems=$query->count();

        $this->setHeader(200);

        echo json_encode(array('status'=>1,'data'=>$models,'totalItems'=>$totalItems),JSON_PRETTY_PRINT);

    }
}
