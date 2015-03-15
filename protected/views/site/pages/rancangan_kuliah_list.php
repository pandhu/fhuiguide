	<h3>Mata Kuliah Wajib</h3>
<?php
	foreach ($matkul_wajib as $data):
?>
		<h2><?php echo "Semester ".$data->semester; ?></h2>
		<?php
			$link = $data->rancangan_kuliah;
			if($link):
			?>
				<a href="<?php echo $link; ?>"><i>Download</i></a>
		<?php
			else: echo "<i>belum ada dokumen rancangan kuliah</i>";
			endif;
		?>
		</br>
<?php
	endforeach;
?>
	<h3>Peminatan</h3>
<?php
	foreach ($peminatan as $data):
?>
		<h2><?php echo $data->nama; ?></h2>
		<?php
			$link = $data->rancangan_kuliah;
			if($link):
			?>
				<a href="<?php echo $link; ?>"><i>Download</i></a>
		<?php
			else: echo "<i>belum ada dokumen rancangan kuliah</i>";
			endif;
		?>
		</br>
<?php
	endforeach;
?>