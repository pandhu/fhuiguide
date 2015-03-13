<h1>Jawab Pertanyaan</h1>
<?php
foreach ($pertanyaan as $item): ?>
	<div>
		<?php echo $item->pertanyaan?>
	</div>
	<?php $form = $this->beginWidget('CActiveForm', array('id'=>'login-form', 'action'=>Yii::app()->baseUrl.'/admin/submitjawaban/'.$id));?>
    <div class="row">
        <?php echo $form->textArea($models, 'jawaban');?>  
    </div>
    <div class="row buttons">
    <?php echo CHtml::submitButton('save');?>
    </div>
    <?php $this->endWidget();?>
<?php
endforeach;
?>