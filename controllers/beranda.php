<?php
/**
 * Created by PhpStorm.
 * User: saqib
 * Date: 3/5/15
 * Time: 5:24 AM
 */

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\bootstrap\ActiveForm;

class BerandaController extends Controller
{
    public function actionIndex()
    {
        if(true){
            $this->redirect('admin/login');
        }
        return $this->render('//site/admin/index');
    }
}