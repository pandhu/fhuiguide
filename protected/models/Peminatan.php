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
			array('peminatan_id, nama, url','required'),
			array('nama, url', 'safe', 'on'=>'search'),
		);
	}

	public function relations(){
		return array(
			'matkul'=>array(self::HAS_MANY,'MataKuliah','id'),
		);
	}

	public function attributeLabels(){
		return array(
			'id'=>'ID',
			'nama'=>'nama',
			'rancangan_kuliah'=>'url',
		);
	}

	public function search(){
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('nama',$this->nama,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
?>