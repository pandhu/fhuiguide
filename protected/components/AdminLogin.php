<?php
class AdminLogin extends CUserIdentity{
	private $_username;
	public function authenticate(){
		$user = Admin::model()->findByAttributes(array('username'=>$this->username));
		if ($user === null){
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} else if ($user->password !== md5($this->password) ) {
		    $this->errorCode=self::ERROR_PASSWORD_INVALID;
		} else {
			$this->_username = $user->username;
			$this->setState('username', $user->username);
			$this->errorCode = self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
	public function getUsername(){
		return $this->_username;
	}

}
?>