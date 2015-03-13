<h1>Tanya Dosen</h1>
<h2>Ajukan pertanyaan</h2>

<?php $form = $this->beginWidget('CActiveForm', array('id'=>'login-form', 'action'=>Yii::app()->baseUrl.'/tanyadosen/savepertanyaan'));?>
    <div class="row">
        <?php echo $form->textArea($models, 'pertanyaan');?>  
    </div>
    <div class="row buttons">
    <?php echo CHtml::submitButton('Tanya!');?>
    </div>
    <?php $this->endWidget();?>

<?php
	foreach ($pertanyaan as $item): ?>
		<div>
			<div>	
				<?php echo $item->pertanyaan?>
			</div>
			<div>
				<?php echo $item->jawaban?>
			</div>
		</div>
		<br>
	<?php
	endforeach;
?>