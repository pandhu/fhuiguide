<h1 class="text-center artikel-kategori-title"><?php echo $artikel[0]->kategori['nama']?></h1>
<div class="col-md-12" >
	<div class="col-md-8">
<?php
	foreach ($artikel as $data): ?>
		<div class="artikel-item col-md-12">
			<h3 class="artikel-judul"><?php echo $data->judul?></h3>
			<span class="artikel-meta">Diterbitkan pada: <?php echo date('d-m-Y h:m:s',strtotime($data->time_stamp))?></span>
			<div class="artikel-konten">
				<?php echo substr($data->konten, 0, 799) ?>
				<br>
				<a class="btn btn-default" href="<?php echo Yii::app()->baseUrl?>/artikel/post?url=<?php echo $data->url?>">More</a>
			</div>
		</div>
<?php
	endforeach;
 ?>
 	</div>
 </div> 	
 <div class="clearfix"></div>