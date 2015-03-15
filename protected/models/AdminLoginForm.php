<?php
class AdminLoginForm extends CFormModel{
	public $username;
	public $password;
	private $_identity;

	public function authenticate($attribute, $params){
		if(!$this->hasErrors()){
			$this->_identity = new AdminLogin($this->username, $this->password);
			if(!$this->_identity->authenticate()){
				$this->addError('password', 'Incorrect username or password');
			}
		}
	}
	public function rules(){
		return array(
			array('username,password','required'),
			array('password','authenticate')
		);
	}



	public function login(){
		var_dump($this->_identity);
		if($this->_identity === null){
			$this->_identity = new AdminLogin($this->username, $this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode === AdminLogin::ERROR_NONE){
			Yii::app()->user->login($this->_identity);
			return true;
		} else 
			return false;
	}
}
?>