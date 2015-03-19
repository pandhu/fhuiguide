<?php if(Yii::app()->session['success']):?>
	<div class="alert alert-success" role="alert"><?php echo Yii::app()->session['success']?></div>

	<?php 
	unset(Yii::app()->session['success']);
	endif; ?>
	

	<!-- HEADER -->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Diktat</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	
	<!-- dataTable -->
	<div class="row">
		<div class="col-lg-12">

			<div class="row">
				<div class="col-lg-4 col-md-8">
					<div class="panel panel-primary">
						<div class="panel-heading">
							Nama Mata Kuliah
						</div>
						<div class="panel-body">
						<?php echo $matkul->nama?>
						</div>
					</div>
				</div>

				<div class="col-lg-2 col-md-4">
					<div class="panel panel-primary">
						<div class="panel-heading">
							Detail
						</div>
						<div class="panel-body">
						<?php echo ($matkul->jenisMatkul->nama)?>
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-primary">
				<div class="panel-heading">
					<b>Daftar Bahan Kuliah</b>
				</div>
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover" id="dataTables-rancangan">
							<thead>
								<tr>
									<th>Timestamp</th>
									<th>Judul</th>
									<th>Nama File</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							foreach ($konten as $item):
							?>
								<tr>
									<td><?php echo $item->time_stamp?></td>
									<td><?php echo $item->judul?></td>
									<td><i class="fa fa-file-pdf-o"></i> <?php echo $item->url.'.'.$item->filetype?></td>
									<td>
										<button class="btn btn-warning btn-small btn-delete" data-title="<?php echo $item->judul?>" data-link="<?php echo Yii::app()->baseUrl?>/admin/deletediktat/<?php echo $item->id?>">
											<i class="fa fa-times-circle"></i> Hapus
										</button>
										<a href="<?php echo Yii::app()->baseUrl.'/uploads/diktat/'.$item->url.'.'.$item->filetype?>" target="_blank" class="btn btn-primary btn-small">
											<i class="fa fa-refresh"></i> Download
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

	<div class="row">

		<!-- NEW ENTRY PANEL -->
		<div class="col-lg-12">
			<div class="panel panel-green">
				<div class="panel-heading">
					<b>
						Tambah Bahan Kuliah
					</b>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?php $form = $this->beginWidget('CActiveForm', array('id'=>'login-form', 'action'=>Yii::app()->baseUrl.'/admin/savediktat/'.$matkul->id, 'htmlOptions'=>array('class'=>'col-md-6', 'enctype'=>'multipart/form-data')));?>
						    <div class="form-group">
						        <?php echo $form->textField($models, 'judul', array('class'=>'form-control', 'placeholder'=>'Judul', 'required'=>'true'));?>  
						        <?php echo $form->error($models, 'judul');?>   
						    </div>
						    <div class="form-group">
						        <?php echo $form->fileField($models,'file', array('class'=>'form-control', 'required'=>'true'));?>
						    </div>
						  
						    <div class="form-group">
						        <?php echo CHtml::submitButton('Simpan', array('class'=>'btn btn-default', 'style'=>'margin-top:10px;'));?>
						    </div>
						    <?php $this->endWidget();?>
						</div>
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