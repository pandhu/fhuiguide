<?php 
class Admin extends CActiveRecord{

	protected function afterValidate(){
		parent::afterValidate();
		$this->password = $this->encrypt($this->password);
	}

	public function encrypt($value){
		return md5($value);
	}

	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	public function tableName(){
		return 'admin';
	}

	public function rules(){
		return array(
			array('username,password', 'required'),
		);
	}

	public function attributLabels(){
		return array(
			'username' => 'Username',
			'password' => 'Password'
		);
	}

	public function search(){
		$criteria = new CDbCriteria;
		$criteria->compare('username', $this->username, true);
		$criteria->compare('password', $this->password, true);
		return new CActiveDataProvider($this, array('criteria'=> $criteria));
	}

}
?>