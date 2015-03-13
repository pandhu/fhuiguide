<h1>List Pertanyaan</h1>
<?php
foreach ($pertanyaan as $item): ?>
	<div>
		<?php echo $item->pertanyaan?>
		<a href="<?php echo Yii::app()->baseUrl.'/admin/jawab/'.$item->id?>">jawab</a>
	</div>
<?php
endforeach;
?>