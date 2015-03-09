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
			array('id,matkul_id,kategori','required'),
			array('kategori, nama, judul', 'safe', 'on'=>'search'),
		);
	}

	public function attributeLabels(){
		return array(
			'id'=>'ID',
			'nama'=>'Nama',
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
		$criteria->compare('nama',$this->nama, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
?>