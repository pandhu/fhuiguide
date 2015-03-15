<?php if(Yii::app()->session['success']):?>
    <div class="alert alert-success" role="alert"><?php echo Yii::app()->session['success']?></div>

<?php 
    unset(Yii::app()->session['success']);
    endif;?>
<h1 class="col-md-12">Tanya Dosen</h1>
<h3 class="lead col-md-12">Ajukan pertanyaan</h3>

<?php $form = $this->beginWidget('CActiveForm', array('id'=>'login-form', 'action'=>Yii::app()->baseUrl.'/tanyadosen/savepertanyaan', 'htmlOptions'=>array('class'=>'col-md-8')));?>
    
	<div class="form-group">
	   <?php echo $form->textArea($models, 'pertanyaan', array('class'=>'form-control'));?>
	</div>

	<div class="form-group">
    <?php echo CHtml::submitButton('Tanya!', array('class'=>'btn btn-default'));?>
    </div>
    <?php $this->endWidget();?>
    <div class="clearfix"></div>
    <div class="col-md-12">
<?php
	foreach ($pertanyaan as $item): ?>
		<div class="panel panel-default">
		  <div class="panel-heading"><?php echo $item->pertanyaan?></div>
		  <div class="panel-body">
		    <?php echo $item->jawaban?>
		  </div>
		</div>
	<?php
	endforeach;
?>
 	</div>
    <div class="clearfix"></div>
