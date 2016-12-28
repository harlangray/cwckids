<?php

namespace app\controllers;

use Yii;
use app\models\Session;
use app\models\SessionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Child;
use app\models\SessionAttendance;
use app\models\SessionAttendanceSearch;
/**
 * SessionController implements the CRUD actions for Session model.
 */
class SessionController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Session models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SessionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Session model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Session model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Session();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {            
            //~~mark attendance for each child~~
            $children = Child::find()->where("c_active  = 1")->orderBy(['c_surname' => SORT_ASC, 'c_first_name' => SORT_ASC])->all();

            foreach ($children as $child){
                $sessionAttendance = new SessionAttendance();
                $sessionAttendance->sat_session_id = $model->ssn_id;
                $sessionAttendance->sat_student_id = $child->c_id;
                $sessionAttendance->sat_present = $model->markPresentByDefault;
                $sessionAttendance->save();
            }
            //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            
            if(isset($_POST['saveandmark'])){
                return $this->redirect(['attendance', 'id' => $model->ssn_id]);                
            }
            else{
                return $this->redirect(['view', 'id' => $model->ssn_id]);                
            }
        } else {
            $model->ssn_date = date('Y-m-d');
            $model->ssn_name = "Sunday School (" . date('Y-m-d') . ")";
            $model->ssn_marked_by = yii::$app->user->id;
            $model->markPresentByDefault = 1;
            
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Session model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            //~~mark attendance for each child~~
//            $children = Child::find()->where("c_active  = 1")->all();
//            foreach ($children as $child){
//                $sessionAttendance = new SessionAttendance();
//                $sessionAttendance->sat_session_id = $model->ssn_id;
//                $sessionAttendance->sat_student_id = $child->c_id;
//                $sessionAttendance->sat_present = 1;//$model->markPresentByDefault;
//                if(!$sessionAttendance->save()){
//                    die(print_r($sessionAttendance->getErrors()));
//                }
//            }
            //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            
            if(isset($_POST['saveandmark'])){
                return $this->redirect(['attendance', 'id' => $model->ssn_id]);                
            }
            else{
                return $this->redirect(['view', 'id' => $model->ssn_id]);                
            }           
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Session model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $attendance = $model->sessionAttendance;
        foreach ($attendance as $attMod){
            $attMod->delete();
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    
    public function actionAttendance_old($id){
        $model = $this->findModel($id);
        
        //$children = Child::find()->where("c_active  = 1")->all();
        $sesAttendance = $model->sessionAttendance;
        
        return $this->render('attendance', [
            'model' => $model,
            'sesAttendance' => $sesAttendance,
            //'children' => $children
        ]);        
    }

    public function actionAttendance($id)
    {
        $session = $this->findModel($id);
        $searchModel = new SessionAttendanceSearch();
        $searchModel->sat_session_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('attendance', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'session' => $session
        ]);
    }    
    
        /**
     * Finds the Session model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Session the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Session::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    public function actionMarkattendance(){
        if(isset($_POST['childID'])){
            $sessionID = $_POST['sessionID'];
            $childID = $_POST['childID'];
            $present = $_POST['present'];
            
            $sesAtt = SessionAttendance::find()->where("sat_session_id = $sessionID AND sat_student_id = $childID")->one();
            
            if(!isset($sesAtt)){
                $sesAtt = new SessionAttendance();
                $sesAtt->sat_session_id = $sessionID;
                $sesAtt->sat_student_id = $childID;               
            }
            $sesAtt->sat_present = $present;
            
            if($sesAtt->save()){
                echo '1';
            }
            else{
                echo print_r($sesAtt->getErrors());
            }
        }
    }
}
