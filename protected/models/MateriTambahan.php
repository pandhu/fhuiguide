<?php
use yii\web\UploadedFile;

class MateriTambahan extends CActiveRecord{
	public $file;

	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	
	public function tableName(){
		return 'materi_tambahan';
	}

	public function rules(){
		return array(
			array('id,deskripsi','required'),
			array('id, deskripsi', 'safe', 'on'=>'search'),
		);
	}

	public function attributeLabels(){
		return array(
			'id'=>'ID',
			'judul'=>'Judul',
			'deskripsi'=>'Deskripsi',
			'url'=>'Url',
			'filetype'=>'Filetype',
		);
	}

	public function search(){
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('deskripsi',$this->deskripsi);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
?>