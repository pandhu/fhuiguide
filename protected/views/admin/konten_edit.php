<?php $form = $this->beginWidget('CActiveForm', array('id'=>'edit-matkul-form', 'action'=>Yii::app()->baseUrl.'/admin/saveeditmatkul/'.$id));?>
    <div class="row">
        <?php echo $form->labelEx($models, 'nama');?>    
        <?php echo $form->textField($models, 'nama');?>  
        <?php echo $form->error($models, 'nama');?>  
    </div>
    <div class="row buttons">
    <?php echo CHtml::submitButton('save');?>
    </div>
    <?php $this->endWidget();?>