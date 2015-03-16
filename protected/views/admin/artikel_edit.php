
<?php if(Yii::app()->session['success']):?>
    <div class="alert alert-success" role="alert"><?php echo Yii::app()->session['success']?></div>

<?php 
    unset(Yii::app()->session['success']);
    endif;?>
<h3>Edit Artikel</h3>
<?php $form = $this->beginWidget('CActiveForm', array('id'=>'login-form', 'action'=>Yii::app()->baseUrl.'/admin/saveeditpost/'.$id));?>
    <div class="form-group">
        <?php echo $form->textField($models, 'judul', array('class'=>'form-control'));?>  
        <?php echo $form->error($models, 'judul');?> 
    </div> 
    <div class="form-group">
        <?php echo $form->dropDownList($models,'kategori_id',$kategoris, array('class'=>'form-control'));?>
    </div> 
   <?php $this->widget('application.extensions.tinymce.ETinyMce',
                array(
                    'name'=>'konten',
                    'value'=>$models->konten,
                    'useSwitch' => false,
                    'editorTemplate'=>'full',
                    )
                ); 
 ?>
    <div class="form-group">
        <?php echo CHtml::submitButton('save', array('class'=>'btn btn-default', 'style'=>'margin-top:10px; float:right'));?>
    </div>
    <?php $this->endWidget();?>