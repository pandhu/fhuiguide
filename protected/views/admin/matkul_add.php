<?php 
if(!empty($peminatan_id)){
    $form = $this->beginWidget('CActiveForm', array('id'=>'add-matkul-form',
    'action'=>Yii::app()->baseUrl.'/admin/savematkulpeminatan/'.$peminatan_id));
}
else {
    $form = $this->beginWidget('CActiveForm', array('id'=>'add-matkul-form',
    'action'=>Yii::app()->baseUrl.'/admin/savematkul/'.$matkul_wajib_id));
}
?>
    <div class="row">
        <?php echo $form->labelEx($models, 'nama');?>    
        <?php echo $form->textField($models, 'nama');?>  
        <?php echo $form->error($models, 'nama');?>  
    </div>
    <div class="row buttons">
    <?php echo CHtml::submitButton('save');?>
    </div>
    <?php $this->endWidget();?>