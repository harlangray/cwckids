<?php

namespace app\controllers;

use Yii;
use app\models\ParentGuardian;
use app\models\ParentGuardianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;

/**
 * ParentGuardianController implements the CRUD actions for ParentGuardian model.
 */
class ParentGuardianController extends Controller {

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
     * Lists all ParentGuardian models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ParentGuardianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ParentGuardian model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ParentGuardian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ParentGuardian();
        $childMods = [];

        if ($model->load(Yii::$app->request->post())) {
            $childMods = Model::createMultiple(\app\models\Child::classname(), $childMods);
            Model::loadMultiple($childMods, Yii::$app->request->post());


            $valid = $model->validate();
            $valid = Model::validateMultiple($childMods) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {

                        foreach ($childMods as $childMod) {
                            $childMod->c_parent_guardian_id = $model->pg_id;
                            if (!($flag = $childMod->save(false))) {
                                break;
                            }
                        }

                        if ($flag) {
                            $transaction->commit();
                            Yii::$app->session->setFlash('success', yii::t('app', 'Created <i>{attribute}</i> successfully', ['attribute' => $model->pg_father_first_name]));
                            //return $this->redirect(['view', 'id' => $model->pg_id]);
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
        else{
            $model->pg_court_orders = 0;
            $model->pg_authorize_medical = 1;
            $model->pg_photo_permission = 1;
            $model->pg_date = date('Y-m-d');
            
//            $model->pg_name_parent_guardian = 'Hans';
        }
        return $this->render('create', [
                    'model' => $model,
                    'childMods' => $childMods,
        ]);


        /*
          if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return $this->redirect(['view', 'id' => $model->pg_id]);
          } else {
          return $this->render('create', [
          'model' => $model,
          ]);
          }
         */
    }

    /**
     * Updates an existing ParentGuardian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $childMods = $model->children;

        if ($model->load(Yii::$app->request->post())) {
            $oldchildIDs = \yii\helpers\ArrayHelper::map($childMods, 'c_id', 'c_id');
            $childMods = Model::createMultiple(\app\models\Child::classname(), $childMods);
            Model::loadMultiple($childMods, Yii::$app->request->post());
            $deletedchildIDs = array_diff($oldchildIDs, array_filter(\yii\helpers\ArrayHelper::map($childMods, 'c_id', 'c_id')));

            //$aa = array_filter(\yii\helpers\ArrayHelper::map($childMods, 'c_id', 'c_id'));
//die(print_r($deletedchildIDs));

            $valid = $model->validate();
            $valid = Model::validateMultiple($childMods) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedchildIDs)) {
                            \app\models\Child::deleteAll(['c_id' => $deletedchildIDs]);
                        }
                        foreach ($childMods as $childMod) {
                            if (!($flag = $childMod->save(false))) {
                                break;
                            }
                        }


                        if ($flag) {
                            $transaction->commit();
                            Yii::$app->session->setFlash('success', yii::t('app', 'Saved <i>{attribute}</i> successfully', ['attribute' => $model->pg_father_first_name]));
                            //return $this->redirect(['view', 'id' => $model->pg_id]);
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
                    'childMods' => $childMods,
        ]);
    }

    /**
     * Deletes an existing ParentGuardian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ParentGuardian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ParentGuardian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ParentGuardian::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
