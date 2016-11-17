<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
//use app\models\Child;
use app\models\ChildSearch;
use app\models\ParentGuardianSearch;
use kartik\mpdf\Pdf;
use app\models\Session;

/**
 * Description of ReportsController
 *
 * @author harla
 */
class ReportsController extends Controller {

    //put your code here
    public function actionMedical() {
        $searchModel = new ChildSearch();

        $searchModel->c_medical_conditions = 1;

        if (!$searchModel->load(Yii::$app->request->post())) {
            $searchModel->c_active = 1;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider = $searchModel->search(['ChildSearch' => ['c_active' => 1, 'c_medical_conditions' => 1]]);

        return $this->render('medical', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $searchModel,
        ]);
    }

    public function actionCourtorders() {
        $searchModel = new ParentGuardianSearch();
        $searchModel->pg_court_orders = 1;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//        $dataProvider = $searchModel->search(['ParentGuardianSearch' => ['pg_court_orders' => 1]]);

        return $this->render('courtOrder', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionBehavioural() {
        $searchModel = new ChildSearch();

        $searchModel->c_behavioural_issue = 1;
        if (!$searchModel->load(Yii::$app->request->post())) {
            $searchModel->c_active = 1;
        } else {
//            die('aaa-' . $searchModel->birthdayMonth);
        }

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider = $searchModel->search(['ChildSearch' => ['c_active' => 1, 'c_behavioural_issue' => 1]]);

        return $this->render('behavioural', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $searchModel,
        ]);
    }

    public function actionBirthdays() {
        $searchModel = new ChildSearch();


//        die(print_r(Yii::$app->request->queryParams));
        if (!$searchModel->load(Yii::$app->request->post())) {
            $searchModel->birthdayMonth = date('n');
            $searchModel->c_active = 1;
        } else {
//            die('aaa-' . $searchModel->birthdayMonth);
        }

//die(print_r(Yii::$app->request->queryParams));
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//        $dataProvider = $searchModel->search(['ChildSearch' => ['c_active' => 1]]);


        return $this->render('birthdays', [
                    'model' => $searchModel,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAgegroups() {
        $searchModel = new ChildSearch();
        //$searchModel->c_active = 1;

        if (!$searchModel->load(Yii::$app->request->post())) {
            $searchModel->ageGroup = 1;
            $searchModel->c_active = 1;
        } else {
//            die('aaa-' . $searchModel->birthdayMonth);
        }
//die(print_r(Yii::$app->request->queryParams));
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider = $searchModel->search(['ChildSearch' => ['c_active' => 1]]);

        return $this->render('ageGroups', [
                    'model' => $searchModel,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAttendance(){
        $fromDate = isset($_POST['fromDate'])?$_POST['fromDate']:date('Y-m-d', strtotime('-1 month'));
        $toDate = isset($_POST['toDate'])?$_POST['toDate']:date('Y-m-d');
        
        $whereCond = " s.ssn_date >= '$fromDate' AND s.ssn_date <= '$toDate' ";

        //~~~sessions~~~~
        $sql = "SELECT s.ssn_id, s.ssn_name, s.ssn_date FROM session s WHERE $whereCond ORDER BY s.ssn_date";
        
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        
        $sessionSelect = '';
        foreach ($result as $row){
            $sessionSelect .= " SUM(IF(s.ssn_id = {$row['ssn_id']}, sa.sat_present, 0)) AS session_{$row['ssn_id']}, ";
            $sessionCols["session_{$row['ssn_id']}"] = $row['ssn_date'];
        }  //die($sessionSelect);      
        //~~~~~~~~~~~~~~~
        
        $sql = "SELECT $sessionSelect c.c_id, c.c_first_name, c.c_surname, 
            SUM(IF(sa.sat_present = 1, 1, 0)) as present, 
            SUM(IF(sa.sat_present = 0, 1, 0)) AS absent 
            FROM `child` c LEFT JOIN session_attendance sa ON c.c_id = sa.sat_student_id
            LEFT JOIN session s ON sa.sat_session_id = s.ssn_id
            WHERE sa.sat_id IS NOT NULL AND $whereCond 
             
            GROUP BY c.c_id ORDER BY c.c_first_name, c.c_surname";
        //die($sql);
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
                
       return $this->render('attendance', [
                    'fromDate' => $fromDate,
                    'toDate' => $toDate,
                    'sessionCols' => $sessionCols,
                    'result' => $result,
        ]);    
       
            
    }

    public function actionTestpdf() {
        $searchModel = new ChildSearch();
        $searchModel->c_medical_conditions = 1;
        $searchModel->c_active = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $content = $this->renderPartial('medical', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

//        $content = $this->renderPartial('medical');
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => ['Krajee Report Header'],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

}
