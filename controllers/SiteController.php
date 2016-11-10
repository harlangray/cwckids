<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionUpdate() {
//        $sql = "ALTER TABLE `parent_guardian` CHANGE `pg_father_email` `pg_father_email` VARCHAR(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, CHANGE `pg_mother_email` `pg_mother_email` VARCHAR(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;";

        $sql = "CREATE TABLE `grade` (
  `gd_id` int(11) NOT NULL,
  `gd_name` varchar(20) NOT NULL,
  `gd_sort_order` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `grade` (`gd_id`, `gd_name`, `gd_sort_order`) VALUES
(1, 'Pre School', 1),
(2, 'Grade 1', 3),
(3, 'Grade 2', 4),
(4, 'Grade 3', 5),
(5, 'Grade 4', 6),
(6, 'Grade 5', 7),
(7, 'Grade 6', 8),
(8, 'Grade 7', 9),
(9, 'Grade 8', 10),
(10, 'Grade 9', 11),
(11, 'Grade 10', 12),
(12, 'Grade 11', 13),
(13, 'Grade 12', 14),
(14, 'Prep', 2);


ALTER TABLE `grade`
  ADD PRIMARY KEY (`gd_id`);

ALTER TABLE `grade`
  MODIFY `gd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;";
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand($sql);
        if($command->execute()){
            echo 'Done';
        }
        else{
            echo 'Could not execute';
        }
    }

    public function actionUpdatesession(){
        $sql = "";
        $connection = Yii::$app->getDb();
        
        $sql = "ALTER TABLE `session_attendance`
  MODIFY `sat_id` int(11) NOT NULL AUTO_INCREMENT;";
                
        $command = $connection->createCommand($sql);        
      
        if($command->execute()){
            echo 'Created Session Table';
        }
        else{
            echo 'Could not execute';
        }        
    }
}
