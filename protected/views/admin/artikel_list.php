<?php if(Yii::app()->session['success']):?>
	<div class="alert alert-success" role="alert"><?php echo Yii::app()->session['success']?></div>

	<?php 
	unset(Yii::app()->session['success']);
	endif;?>

	<h2>Posts</h2>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<b>Daftar Mata Kuliah</b>
				</div>
				<div class="panel-body">
					<div class="dataTable_wrapper" style="height:450px; overflow-y:scroll">
						<table class="table table-striped table-bordered table-hover" id="dataTables-rancangan">
							<thead>
								<tr>
									<th>Nama File</th>
									<th>Kategori</th>
									<th>Date Published</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								foreach ($models as $data):
									?>
								<tr>
									<td><?php echo $data->judul?></td>
									<td><?php echo $data->kategori['nama']?></td>
									<td><?php echo $data->time_stamp?></td>
									<td>
										<a class="btn btn-warning btn-small btn-delete" data-title="<?php echo $data->judul?>" data-link="<?php echo Yii::app()->baseUrl?>/admin/deletepost/<?php echo $data->id?>">
											<i class="fa fa-times-circle"></i> Hapus
										</a>
										<a class="btn btn-default btn-small " href="<?php echo Yii::app()->baseUrl;?>/admin/editpost/<?php echo $data->id?>">
											Edit
										</a>
										<a class="btn btn-default btn-small " href="<?php echo Yii::app()->baseUrl;?>/artikel/post/<?php echo $data->url?>">
											View
										</a>
										
									</td>
								</tr>
								<?php
								endforeach;
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Hapus Artikel</h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<a href="" class="btn btn-primary btn-delete-modal">Ya</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.btn-delete').click(function(){
		url = $(this).attr('data-link');
		judul = $(this).attr('data-title');
		console.log(url);
		$('.btn-delete-modal').attr('href',url);
		$('.modal-body').html('Menghapus Artikel '+judul+'?');
		$('#myModal').modal('show');
	});	
</script>