<?php $form = $this->beginWidget('CActiveForm', array('id'=>'edit-matkulwajib-form',
'action'=>Yii::app()->baseUrl.'/admin/saveeditmatkulwajib/'.$semester));?>
    <div class="row">
        <?php echo "Rancangan Kuliah Semester: ".$semester;?>  
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