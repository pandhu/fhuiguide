<h3>Artikel Baru</h3>

<?php $form = $this->beginWidget('CActiveForm', array('id'=>'login-form', 'action'=>Yii::app()->baseUrl.'/admin/savepost'));?>
    <div class="form-group">
        <?php echo $form->textField($models, 'judul', array('class'=>'form-control', 'placeholder'=>'Judul'));?>  
        <?php echo $form->error($models, 'judul');?>   
    </div>
    <div class="form-group">
        <?php echo $form->dropDownList($models,'kategori_id',$kategoris, array('class'=>'form-control'));?>
    </div>
    <?php $this->widget('application.extensions.tinymce.ETinyMce',
                    array(
                    'name'=>'konten',
                    'useSwitch' => false,
                    'editorTemplate'=>'full',
                    )
                ); 
 ?>
    <div class="form-group">
        <?php echo CHtml::submitButton('Save', array('class'=>'btn btn-default', 'style'=>'margin-top:10px; float:right'));?>
    </div>
    <?php $this->endWidget();?>