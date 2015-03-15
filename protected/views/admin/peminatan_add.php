<?php $form = $this->beginWidget('CActiveForm', array('id'=>'add-peminatan-form', 'action'=>Yii::app()->baseUrl.'/admin/savepeminatan'));?>
    <div class="row">
        <?php echo $form->labelEx($models, 'nama');?>    
        <?php echo $form->textField($models, 'nama');?>  
        <?php echo $form->error($models, 'nama');?>  
    </div>
    <div class="row">
        <?php echo $form->labelEx($models, 'rancangan_kuliah');?>    
        <?php echo $form->textField($models, 'rancangan_kuliah');?>  
        <?php echo $form->error($models, 'rancangan_kuliah');?>
    </div>
    <div class="row buttons">
    <?php echo CHtml::submitButton('save');?>
    </div>
    <?php $this->endWidget();?>