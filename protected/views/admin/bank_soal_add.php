<h3>Bank Soal Baru</h3>

<?php $form = $this->beginWidget('CActiveForm', array('id'=>'login-form', 'action'=>Yii::app()->baseUrl.'/admin/savebanksoal', 'htmlOptions'=>array('class'=>'col-md-6', 'enctype'=>'multipart/form-data')));?>
    <div class="form-group">
        <?php echo $form->textField($konten, 'judul', array('class'=>'form-control', 'placeholder'=>'Judul', 'required'=>'true'));?>  
        <?php echo $form->error($konten, 'judul');?>   
    </div>
    <div class="form-group">
        <?php echo $form->dropDownList($konten,'matkul_id',$matkuls, array('class'=>'form-control', 'required'=>'true'));?>
    </div>
    <div class="form-group">
        <?php echo $form->fileField($konten,'file', array('class'=>'form-control', 'required'=>'true'));?>
    </div>
  
    <div class="form-group">
        <?php echo CHtml::submitButton('Save', array('class'=>'btn btn-default', 'style'=>'margin-top:10px; float:right'));?>
    </div>
    <?php $this->endWidget();?>