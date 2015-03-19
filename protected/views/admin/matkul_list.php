<?php if(Yii::app()->session['success']):?>
	<div class="alert alert-success" role="alert"><?php echo Yii::app()->session['success']?></div>

	<?php 
	unset(Yii::app()->session['success']);
	endif; ?>

<!-- HEADER -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Mata Kuliah</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<!-- Aw yisss breadcrumbs -->


<!-- dataTable -->
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
								<th>Nama Mata Kuliah</th>
								<th>Kategori</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							foreach($matkuls as $matkul):
								?>
							<tr>
								<td><?php echo $matkul->nama?></td>
								<td><?php echo ($matkul->jenisMatkul['nama'])?></td>
								<td>
									<button class="btn btn-warning btn-small btn-delete" data-title="<?php echo $matkul->nama?>" data-link="<?php echo Yii::app()->baseUrl?>/admin/deletematakuliah/<?php echo $matkul->id?>">
											<i class="fa fa-times-circle"></i> Hapus
									</button>
									<a href="<?php echo Yii::app()->baseUrl.'/admin/editmatkul/'.$matkul->id?>" class="btn btn-primary btn-small">
										<i class="fa fa-refresh"></i> Edit
									</a>
									<a href="<?php echo Yii::app()->baseUrl.'/admin/bahankuliah/'.$matkul->id?>" class="btn btn-outline btn-info">
                                	    <i class="fa fa-folder"></i> Bahan Kuliah
                                	</a>
                                	<a href="<?php echo Yii::app()->baseUrl.'/admin/diktat/'.$matkul->id?>" class="btn btn-outline btn-info">
                                	    <i class="fa fa-folder"></i> Diktat
                                	</a>
                                	<a href="<?php echo Yii::app()->baseUrl.'/admin/banksoal/'.$matkul->id?>" class="btn btn-outline btn-info">
                                	    <i class="fa fa-folder"></i> Bank Soal
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
				Tambah/Ubah Peminatan &amp; Rancangan Kuliah
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<?php $form = $this->beginWidget('CActiveForm', array('id'=>'edit-matkul-form', 'action'=>Yii::app()->baseUrl.'/admin/savematkul/'));?>
						<div class="form-group">
							<?php echo $form->textField($models, 'nama', array('class'=>'form-control', 'required'=>'true', 'placeholder'=>'Nama Mata Kuliah'));?>  
							<?php echo $form->error($models, 'nama');?>  
						</div>
						<div class="form-group">
							<?php echo $form->dropDownList($models,'jenis',$peminatans, array('class'=>'form-control'));?> 
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


	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Hapus Mata Kuliah</h4>
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
			$('.modal-body').html('Menghapus Mata Kuliah '+judul+'?');
			$('#myModal').modal('show');
		});	
	</script>