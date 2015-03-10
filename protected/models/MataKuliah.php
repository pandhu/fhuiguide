<?php
class MataKuliah extends CActiveRecord{
	
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	
	public function tableName(){
		return 'matkul';
	}

	public function rules(){
		return array(
			array('id,peminatan_id','required'),
			array('peminatan_id, nama', 'safe', 'on'=>'search'),
		);
	}

	public function relations(){
		return array(
			'konten'=>array(self::HAS_MANY,'Konten','id'),
		);
	}

	public function attributeLabels(){
		return array(
			'id'=>'ID',
			'nama'=>'Nama',
			'peminatan_id'=>'peminatan_id',
		);
	}

	public function search(){
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('peminatan_id',$this->peminatan_id);
		$criteria->compare('nama',$this->nama, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
?>