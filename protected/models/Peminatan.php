<?php
class Peminatan extends CActiveRecord{
	
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	
	public function tableName(){
		return 'peminatan';
	}

	public function rules(){
		return array(
			array('id, nama','required'),
			array('nama', 'safe', 'on'=>'search'),
		);
	}

	public function relations(){
		return array(
			'matkul'=>array(self::HAS_MANY,'MataKuliah','id'),
		);
	}
	
	public function attributeLabels(){
		return array(
			'nama'=>'Nama Peminatan',
			'rancangan_kuliah'=>'URL Rancangan Kuliah',
		);
	}

	public function search(){
		$criteria=new CDbCriteria;
		$criteria->compare('nama',$this->nama,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
?>