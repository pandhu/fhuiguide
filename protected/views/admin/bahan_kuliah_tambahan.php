<?php if(Yii::app()->session['success']):?>
    <div class="alert alert-success" role="alert"><?php echo Yii::app()->session['success']?></div>

<?php 
    unset(Yii::app()->session['success']);
    endif;?>
<h1>Bahan Kuliah Upload</h1>
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
									<th>Deskripsi</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								foreach ($konten as $item):
									?>
								<tr>
									<td><?php echo $item->judul?></td>
									<td><?php echo $item->deskripsi?></td>
									<td>
										<button class="btn btn-warning btn-small btn-delete" data-title="<?php echo $item->judul?>" data-link="<?php echo Yii::app()->baseUrl?>/admin/deletebahankuliahtambahan/<?php echo $item->id?>">
											<i class="fa fa-times-circle"></i> Hapus
										</button>
																		
										<a href="<?php echo Yii::app()->baseUrl.'/uploads/materi/tambahan/'.$item->url.'.'.$item->filetype?>" class="btn btn-primary btn-small">
											<i class="fa fa-refresh"></i> Download Rencana Kuliah
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
        <h4 class="modal-title" id="myModalLabel">Hapus Bahan Kuliah</h4>
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
		$('.modal-body').html('Menghapus File '+judul+'?');
		$('#myModal').modal('show');
	});	
</script>