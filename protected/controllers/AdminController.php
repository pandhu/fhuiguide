<?php 
class AdminController extends Controller{
	public $layout = 'main';

	public function actionIndex(){
		$model = new AdminLoginForm;
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form'){
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		if(isset($_POST['AdminLoginForm'])){
			$model->attributes = $_POST['AdminLoginForm'];
		var_dump($_POST['AdminLoginForm']);
		echo '<br>';
		var_dump($model->attributes);
			if ($model->validate() && $model->login()){
				$this->redirect(array('admin/dashboard'));
			}
		}
		$this->render('login', array('model'=> $model));
	}
	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect(array('/admin'));	
	}
}
?>