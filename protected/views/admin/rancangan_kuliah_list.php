<h1>Peminatan</h1>
<?php
	foreach ($peminatan as $data):
		echo "<b>".$data->nama."</b>";
		echo "<br>";
		$link = $data->rancangan_kuliah;
		if($link) : echo $link;
		else : echo "<i>belum ada dokumen rancangan kuliah</i>";
		endif;
?>
		<a href="<?php echo Yii::app()->baseUrl;?>/admin/editpeminatan/<?php echo $data->id?>">edit</a>
<?php
		echo "<br>";
	endforeach;
 ?>
 <h1>Matkul Wajib</h1>
<?php
	foreach ($matkul_wajib as $data):
		echo "<b>Semester ".$data->semester."</b>";
		echo "<br>";
		$link = $data->rancangan_kuliah;
		if($link) : echo $link;
		else : echo "<i>belum ada dokumen rancangan kuliah</i>";
		endif;
?>
		<a href="<?php echo Yii::app()->baseUrl;?>/admin/editmatkulwajib/<?php echo $data->semester?>">edit</a>
<?php
		echo "<br>";
	endforeach;
 ?>