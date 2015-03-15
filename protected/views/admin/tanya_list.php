<?php if(Yii::app()->session['success']):?>
    <div class="alert alert-success" role="alert"><?php echo Yii::app()->session['success']?></div>

<?php 
    unset(Yii::app()->session['success']);
    endif;?>
<h1>List Pertanyaan</h1>
<?php
foreach ($pertanyaan as $item): ?>
		<div class="panel panel-default">
		  <div class="panel-heading"><?php echo $item->pertanyaan?></div>
		  <a class="btn btn-default" href="<?php echo Yii::app()->baseUrl?>/admin/jawab/<?php echo $item->id?>">Jawab</a>
		</div>
	<?php
endforeach;
?>