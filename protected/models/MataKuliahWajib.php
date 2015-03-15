<?php
class MataKuliahWajib extends CActiveRecord{
	
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	
	public function tableName(){
		return 'matkul_wajib';
	}

	public function rules(){
		return array(
			array('semester','required'),
			array('semester', 'safe', 'on'=>'search'),
		);
	}

	public function relations(){
		return array(
			'matkul'=>array(self::HAS_MANY,'MataKuliah','id'),
		);
	}

	public function attributeLabels(){
		return array(
			'semester'=>'semester',
			'rancangan_kuliah'=>'rancangan_kuliah',
		);
	}

	public function search(){
		$criteria=new CDbCriteria;
		$criteria->compare('semester',$this->semester);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
?>