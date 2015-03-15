<h1>Jawab Pertanyaan</h1>
<?php
foreach ($pertanyaan as $item): ?>
	<div class="panel panel-default">
        <div class="panel-heading">Pertanyaan</div>
        <div class="panel-body">
            <?php echo $item->pertanyaan?>
        </div>
    </div>
	<?php $form = $this->beginWidget('CActiveForm', array('id'=>'login-form', 'action'=>Yii::app()->baseUrl.'/admin/submitjawaban/'.$id, 'htmlOptions'=>array('class'=>'col-md-8')));?>
        <div class="form-group">
            <?php echo $form->textArea($models, 'jawaban', array('class'=>'form-control'));?>  
        </div>
        <div class="form-group">
            <?php echo CHtml::submitButton('Jawab!', array('class'=>'btn btn-default'));?>
        </div>
    <?php $this->endWidget();?>
<?php
endforeach;
?>