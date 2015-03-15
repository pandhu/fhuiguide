<?php
class Konten extends CActiveRecord{
	
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	
	public function tableName(){
		return 'konten';
	}

	public function rules(){
		return array(
			array('judul, url','required'),
			array('kategori, judul, url', 'safe', 'on'=>'search'),
		);
	}

	public function attributeLabels(){
		return array(
			'judul'=>'judul',
			'matkul_id'=>'matkul_id',
			'url' => 'url',
			'kategori' => 'kategori',
		);
	}

	public function search(){
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('matkul_id',$this->matkul_id);
		$criteria->compare('kategori',$this->kategori);
		$criteria->compare('judul',$this->nama, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
?>