<?php $form = $this->beginWidget('CActiveForm', array('id'=>'edit-konten-form', 'action'=>Yii::app()->baseUrl.'/admin/saveeditkonten/'.$id.'/'.$kategori));?>
    <div class="row">
        <?php echo $form->labelEx($models, 'judul');?>    
        <?php echo $form->textField($models, 'judul');?>  
        <?php echo $form->error($models, 'judul');?>  
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