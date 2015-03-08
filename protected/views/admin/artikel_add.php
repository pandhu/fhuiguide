<?php $form = $this->beginWidget('CActiveForm', array('id'=>'login-form', 'action'=>Yii::app()->baseUrl.'/admin/savepost'));?>
    <div class="row">
        <?php echo $form->labelEx($models, 'judul');?>    
        <?php echo $form->textField($models, 'judul');?>  
        <?php echo $form->error($models, 'judul');?>  
    </div>
    <?php echo $form->dropDownList($models,'kategori_id',$kategoris);?>
   <?php $this->widget('application.extensions.tinymce.ETinyMce',
                array(
                    'name'=>'konten',
                    'useSwitch' => false,
                    'editorTemplate'=>'full',
                    )
                ); 
 ?>
    <div class="row buttons">
    <?php echo CHtml::submitButton('save');?>
    </div>
    <?php $this->endWidget();?>