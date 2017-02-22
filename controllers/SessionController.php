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
use app\models\ChildSearch;
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
            $children = Child::find()->where("c_active  = 1 AND c_parent_guardian_id > 0")->orderBy(['c_surname' => SORT_ASC, 'c_first_name' => SORT_ASC])->all();

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
    
    public function actionUpdateattendancelist($id){
        $session = $this->findModel($id);
        $searchModel = new SessionAttendanceSearch();
        $searchModel->sat_session_id = $id;
        $idsInList = $session->childIDs;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchNotInListMod = new ChildSearch();
        $searchNotInListMod->excludeIDs = $idsInList;
        $searchNotInListMod->c_active = 1;
        $dataProvNotInList = $searchNotInListMod->search(Yii::$app->request->queryParams);
        
        return $this->render('updateAttendanceList', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            
            'searchNotInListMod' => $searchNotInListMod,
            'dataProvNotInList' => $dataProvNotInList,
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
    
    public function actionRemovefromlist(){
        $message = [];
        if(isset($_POST['sessionAttID'])){
            $sessionAttID = $_POST['sessionAttID'];
            
            $sesAttMod = SessionAttendance::findOne($sessionAttID);
            if(isset($sesAttMod)){
                if($sesAttMod->delete()){
                    $message = ['status' => 'success', 'message' => 'Deleted successfully'];
                }
                else{
                    $message = ['status' => 'failure', 'message' => 'Could not Deleted'];
                }
            }
            else{
                $message = ['status' => 'failure', 'message' => 'Cannot find record'];
            }
        }
        
        echo json_encode($message);
    }
    
       
    public function actionDeletesessionattendance($id, $sessionID)
    {
        if(($model = SessionAttendance::findOne($id)) !== null){
            $model->delete();
            Yii::$app->session->setFlash('success', yii::t('app', 'Removed <i>{attribute}</i> from this attendance list', ['attribute' => $model->child->c_first_name . ' ' . $model->child->c_surname]));                
        }
        else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->redirect(['updateattendancelist', 'id' => $sessionID]);
    }
    
    public function actionAddtosessionattendance($childID, $sessionID){
        $model = SessionAttendance::findOne("sat_session_id = $sessionID AND sat_student_id = $childID");
        $child = Child::findOne($childID);
        if(!isset($model) && isset($child)){
            $model = new SessionAttendance();
            $model->sat_session_id = $sessionID;
            $model->sat_student_id = $childID;
            $model->sat_present = 0;
            if(!$model->save()){
                die(print_r($model->getErrors()));
            }
            else{
                Yii::$app->session->setFlash('success', yii::t('app', 'Added <i>{attribute}</i> to the attendance list', ['attribute' => $child->c_first_name . ' ' . $child->c_surname]));                
            }
        }

        return $this->redirect(['updateattendancelist', 'id' => $sessionID]);        
    }
    
        
    public function actionQuickcreatechild($sessionID){
       $model = new Child();
       $model->c_parent_guardian_id = 0;
       $model->c_toilet_trained = 1;
       $model->c_medical_conditions = 0;
       $model->c_behavioural_issue = 0;
       $model->c_active = 1;
       
       if ($model->load(Yii::$app->request->post())){            
            if($model->validate()){
                $model->save();
                $this->actionAddtosessionattendance($model->c_id, $sessionID);
                //return $this->redirect(['session/updateattendancelist', 'id' => $sessionID]);
            }
            else{
                die(print_r($model->getErrors()));
            }
       }
       else{
            return $this->renderAjax('quick_create_child', [
                     'model' => $model,
             ]);
       }
    }
}
