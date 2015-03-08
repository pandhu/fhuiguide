<?php
class Artikel extends CActiveRecord{

	
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	
	public function tableName(){
		return 'artikel';
	}

	public function rules(){
		return array(
			array('kategori_id,judul,konten','required'),
			array('id, kategori_id, judul', 'safe', 'on'=>'search'),
		);
	}

	public function relations(){
		return array(
			'kategori'=>array(self::BELONGS_TO,'KategoriArtikel','kategori_id'),
		);

	}

	public function attributeLabels(){
		return array(
			'id'=>'ID',
			'kategori_id'=>'Kategori',
			'judul'=>'Judul',
			'konten'=>'Konten',
			'url'=>'Url',
			'time_stamp'=>'Tanggal',
		);
	}

	public function search(){
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('judul',$this->judul,true);
		$criteria->compare('kategori_id',$this->kategori_id);
		$criteria->compare('konten',$this->konten);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
?>