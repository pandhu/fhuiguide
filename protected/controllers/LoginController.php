<?php

class LoginController extends Controller
{
	
	public function actionIndex()
	{
		if(Yii::app()->user->id!==null){
			$this->redirect(array('/admin'));	
		}
		$model = new AdminLoginForm;
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form'){
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		if(isset($_POST['AdminLoginForm'])){
			$model->attributes = $_POST['AdminLoginForm'];
			if ($model->validate() && $model->login()){
				$this->redirect(array('/admin'));
			}
		}
		$this->render('/admin/login', array('model'=> $model));
	}

	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect(array('/login'));	
	}
}

