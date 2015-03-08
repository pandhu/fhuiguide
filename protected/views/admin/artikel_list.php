<?php
	foreach ($models as $data):
		echo $data->judul;
		echo "<br>";
		echo substr($data->konten, 0, 300); ?>
		<a href="<?php echo Yii::app()->baseUrl;?>/admin/editpost/<?php echo $data->id?>">edit</a>
<?php
		echo "<br>";
	endforeach;
 ?>