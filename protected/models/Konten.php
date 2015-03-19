<?php
use yii\web\UploadedFile;

class Konten extends CActiveRecord{
	public $file;

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

	public function relations(){
		return array(
			'matkul'=>array(self::BELONGS_TO,'MataKuliah','matkul_id'),
			'jenisMatkul'=>array(self::BELONGS_TO,'JenisMatkul',array('jenis'=>'id'),'through'=>'matkul'),
		);
	}

	public function attributeLabels(){
		return array(
			'id'=>'ID',
			'nama'=>'Nama',
			'matkul_id'=>'matkul_id',
			'url' => 'url',
			'filetype' => 'filetype',
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

	public function scopes() {
	    return array(
	        'bymatkul' => array('order' => 'matkul_id ASC'),
	    );
	}
}
?>