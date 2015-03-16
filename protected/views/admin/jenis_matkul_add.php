<h3>Jenis Mata Kuliah Baru</h3>

<?php $form = $this->beginWidget('CActiveForm', array('id'=>'login-form', 'action'=>Yii::app()->baseUrl.'/admin/savejenismatkul', 'htmlOptions'=>array('class'=>'col-md-6', 'enctype'=>'multipart/form-data')));?>
    <div class="form-group">
        <?php echo $form->textField($models, 'nama', array('class'=>'form-control', 'placeholder'=>'Nama Peminantan / matkul wajib(semester)', 'required'=>'true'));?>  
        <?php echo $form->error($models, 'nama');?>   
    </div>
    <div class="form-group">
        <?php echo $form->dropDownList($models,'kategori', array('wajib', 'peminatan'), array('class'=>'form-control', 'required'=>'true'));?>
    </div>
    <div class="form-group">
        <?php echo $form->fileField($models,'rancangan_kuliah', array('class'=>'form-control', 'required'=>'true'));?>
    </div>
  
    <div class="form-group">
        <?php echo CHtml::submitButton('Save', array('class'=>'btn btn-default', 'style'=>'margin-top:10px; float:right'));?>
    </div>
    <?php $this->endWidget();?>