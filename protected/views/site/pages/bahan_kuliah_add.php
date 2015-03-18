<?php if(Yii::app()->session['success']):?>
    <div class="alert alert-success" role="alert"><?php echo Yii::app()->session['success']?></div>

<?php 
    unset(Yii::app()->session['success']);
    endif;?>
<div class="col-md-12">
    <h1>Bahan Kuliah Baru</h1>
    <hr>
    <div class="col-md-6">
        <i>
            Silahkan upload materi-materi kuliah yang kamu miliki 
            agar bisa memberi manfaat bagi teman maupun adik kelasmu
        </i> <br><br>
    </div>
</div>
<div class="col-md-12">
<?php $form = $this->beginWidget('CActiveForm', array('id'=>'login-form', 'action'=>Yii::app()->baseUrl.'/uploadbahankuliah/savebahankuliah', 'htmlOptions'=>array('class'=>'col-md-8', 'enctype'=>'multipart/form-data')));?>
    
    <div class="form-group">
        <?php echo $form->textField($konten,'judul', array('class'=>'form-control', 'required'=>'true', 'placeholder'=>'Judul'));?>
    </div>
    <div class="form-group">
        <?php echo $form->textArea($konten, 'deskripsi', array('class'=>'form-control',
            'placeholder'=>"Mata kuliah, semester, peminatan, pertemuan ke berapa, bab ke berapa",
            'rows'=>'3',
            'required'=>'true'));?>  
        <?php echo $form->error($konten, 'deskripsi');?>   
    </div>  
    <div class="form-group">
        <?php echo $form->fileField($konten,'file', array('class'=>'form-control', 'required'=>'true'));?>
        <p class="help-block">Format file doc, docx, atau pdf</p>
    </div>
    <div class="form-group">
        <?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-primary', 'style'=>'margin-top:10px; float:right'));?>
    </div>
    <?php $this->endWidget();?>
</div>