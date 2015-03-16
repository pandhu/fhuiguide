<div class="col-md-12" >
	<div class="col-md-8">
<?php
	foreach ($artikel as $data): ?>
		<div class="artikel-item col-md-12">
			<h3 class="artikel-judul"><?php echo $data->judul?></h3>
			<span class="artikel-meta">Diterbitkan pada: <?php echo date('d-m-Y h:m:s',strtotime($data->time_stamp))?></span> 	
			<div class="artikel-konten">
				<?php echo $data->konten; ?>
			</div>
		</div>
<?php
	endforeach;
 ?>
 	</div>
 </div> 	
 <div class="clearfix"></div>