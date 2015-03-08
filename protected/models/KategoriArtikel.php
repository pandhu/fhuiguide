<?php
class KategoriArtikel extends CActiveRecord{

	
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	
	public function tableName(){
		return 'kategori_artikel';
	}

	public function rules(){
		return array(
			array('id,nama','required'),
			array('id, nama', 'safe', 'on'=>'search'),
		);
	}

	public function relations(){
		return array(
			'kategori'=>array(self::HAS_MANY,'Artikel','kategori_id'),
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
		$criteria->compare('nama',$this->nama,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
?>