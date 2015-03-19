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
			'konten'=>array(self::HAS_MANY,'Konten','matkul_id'),
			'jenisMatkul'=>array(self::BELONGS_TO,'JenisMatkul','jenis'),
		);
	}

	public function attributeLabels(){
		return array(
			'id'=>'ID',
			'nama'=>'Nama',
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

	public function scopes() {
	    return array(
	        'bypeminatan' => array('order' => 'jenis Asc'),
	    );
	}
}
?>