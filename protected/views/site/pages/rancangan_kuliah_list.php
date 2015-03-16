<?php
	foreach ($models as $data):
?>
		<h3><?php echo $data->nama; ?></h3>
		<a href="<?php echo $data->rancangan_kuliah; ?>"><i>Download</i></a>
		</br>
<?php
	endforeach;
?>