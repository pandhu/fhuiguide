<div class="col-md-12" >
	<div class="col-md-8">
		<div class"col-md-12">
			<h1 class="artikel-judul"><?php echo $artikel->judul?></h1>
			<span class="artikel-meta">Diterbitkan pada: <?php echo date('d-m-Y h:m:s',strtotime($artikel->time_stamp))?></span>
			<hr>
		</div>
		<div class="artikel-item col-md-12"> 	
			<div class="artikel-konten">
				<?php echo $artikel->konten; ?>
			</div>
		</div>
 	</div>
 </div> 	
 <div class="clearfix"></div>