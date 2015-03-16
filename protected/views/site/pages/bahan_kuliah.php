<a class="btn btn-default" href="<?php Yii::app()->baseUrl?>addbahankuliah">Tambah</a>
<?php if(Yii::app()->session['success']):?>
    <div class="alert alert-success" role="alert"><?php echo Yii::app()->session['success']?></div>

<?php 
    unset(Yii::app()->session['success']);
    endif;?>
<h1>Bahan Kuliah</h1>
<?php foreach ($konten as $data): ?>

<div class="col-md-4">
<h3><?php echo $data[0]->matkul->nama?></h3>
	<table class="table">
	<thead>
		<tr>
			<th>Nama File</th>		
		</tr>
	</thead>
	<tbody>

	<?php
	foreach ($data as $item): ?>
		<tr>
			<td><?php echo $item->judul?></td>
			<td><a class="btn btn-default" href="<?php echo Yii::app()->baseUrl?>/uploads/materi/<?php echo $item->url.'.'.$item->filetype?>">Download</a></td>
		</tr>
		<?php
	endforeach;
	?>
	</tbody>
	</table>
	</div>
<?php 
	endforeach
?>

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