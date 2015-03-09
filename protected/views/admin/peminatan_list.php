<?php
	foreach ($models as $data):
		echo $data->nama;
		echo "<br>";
		echo $data->url?>
		<a href="<?php echo Yii::app()->baseUrl;?>/admin/editpeminatan/<?php echo $data->id?>">edit</a>
<?php
		echo "<br>";
	endforeach;
 ?>