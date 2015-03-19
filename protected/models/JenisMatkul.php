<?php
use yii\web\UploadedFile;
class JenisMatkul extends CActiveRecord{
	public $file;
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	
	public function tableName(){
		return 'jenis_matkul';
	}

	public function rules(){
		return array(
			array('nama, kategori','required'),
			array('nama, rancangan_kuliah', 'safe', 'on'=>'search'),
		);
	}

	public function relations(){
		return array(
			'matkul'=>array(self::HAS_MANY, 'MataKuliah', 'jenis'),
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