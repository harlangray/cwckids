<?php

namespace app\controllers;

use Yii;
use app\models\Child;
use app\models\ChildSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChildController implements the CRUD actions for Child model.
 */
class ChildController extends Controller {

    public function behaviors() {
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
     * Lists all Child models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ChildSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Child model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Child model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new Child();
//                
//        if ($model->load(Yii::$app->request->post())){            
//                
//            $valid = $model->validate();
//                        
//            if ($valid) {
//                $transaction = \Yii::$app->db->beginTransaction();
//                try {            
//                    if ($flag = $model->save(false)) {
//                    
//                        if ($flag) {
//                            $transaction->commit();
//                            Yii::$app->session->setFlash('success', yii::t('app', 'Created <i>{attribute}</i> successfully', ['attribute' => $model->c_first_name]));
//                            //return $this->redirect(['view', 'id' => $model->c_id]);
//                            return $this->redirect(['index']);
//                        }                
//                    }
//                } catch (Exception $e) {
//                    $transaction->rollBack();
//                }
//        }
//            else{
//                Yii::$app->session->setFlash('danger', yii::t('app', 'There are validation errors in your form. Please check your input details.'));
//            }   
//        }
//        return $this->render('create', [
//            'model' => $model,
//            
//        ]);
//        
//        
//        /*
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->c_id]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
//        */
//    }

    
 

    /**
     * Updates an existing Child model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $valid = $model->validate();

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {


                        if ($flag) {
                            $transaction->commit();
                            Yii::$app->session->setFlash('success', yii::t('app', 'Saved <i>{attribute}</i> successfully', ['attribute' => $model->c_first_name]));
                            //return $this->redirect(['view', 'id' => $model->c_id]);
                            return $this->redirect(['index']);
                        }
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            } else {
                Yii::$app->session->setFlash('danger', yii::t('app', 'There are validation errors in your form. Please check your input details.'));
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Child model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $child = $this->findModel($id);
        if(count($child->sessionAttendance) == 0){//if child is used in attendance, don't allow deleting
            $child->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Child model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Child the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Child::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
