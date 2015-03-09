<?php
	foreach ($models as $data):
?>
		<h3><?php echo $data->nama; ?></h3>
		<a href="<?php echo $data->url; ?>">
			<?php echo $data->nama; ?>
		</a>
<?php
	endforeach;
?>