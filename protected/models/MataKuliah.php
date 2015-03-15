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
			array('nama','required'),
			array('peminatan_id, matkul_wajib_id, nama', 'safe', 'on'=>'search'),
		);
	}

	public function relations(){
		return array(
			'konten'=>array(self::HAS_MANY,'Konten','id'),
		);
	}

	public function attributeLabels(){
		return array(
			'nama'=>'Nama',
			'peminatan_id'=>'Peminatan',
			'matkul_wajib_id'=>'Matakuliah Wajib',
		);
	}

	public function search(){
        $criteria->compare('matkul_wajib_id',$this->matkul_wajib_id);
		$criteria->compare('peminatan_id',$this->peminatan_id);
		$criteria->compare('nama',$this->nama, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
?>