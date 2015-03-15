<?php 
$form = $this->beginWidget('CActiveForm', array('id'=>'add-konten-form',
'action'=>Yii::app()->baseUrl.'/admin/savekonten/'.$matkul_wajib_id.'/'.$kategori));
?>
    <div class="row">
        <?php echo $form->labelEx($models, 'nama');?>    
        <?php echo $form->textField($models, 'nama');?>  
        <?php echo $form->error($models, 'nama');?>  
    </div>
    <div class="row">
        <?php echo $form->labelEx($models, 'url');?>    
        <?php echo $form->textField($models, 'url');?>  
        <?php echo $form->error($models, 'url');?>  
    </div>
    <div class="row buttons">
    <?php echo CHtml::submitButton('save');?>
    </div>
    <?php $this->endWidget();?>