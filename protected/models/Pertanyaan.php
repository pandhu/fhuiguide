<?php
class Pertanyaan extends CActiveRecord{

	
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	
	public function tableName(){
		return 'pertanyaan';
	}

	public function rules(){
		return array(
			array('pertanyaan','required'),
			array('id, pertanyaan, jawaban', 'safe', 'on'=>'search'),
		);
	}

	public function attributeLabels(){
		return array(
			'id'=>'ID',
			'pertanyaan'=>'Pertanyaan',
			'status'=>'Status',
			'jawaban'=>'Jawaban',
			'waktu_tanya'=>'Waktu Tanya',
			'waktu_jawab'=>'Waktu Jawab',
		);
	}

	public function search(){
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('pertanyaan',$this->pertanyaan,true);
		$criteria->compare('jawaban',$this->jawaban);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function scopes() {
	    return array(
	        'waktuTanya' => array('order' => 'waktu_tanya DESC'),
	    );
	}
}
?>