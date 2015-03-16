<?php if(Yii::app()->session['success']):?>
    <div class="alert alert-success" role="alert"><?php echo Yii::app()->session['success']?></div>

<?php 
    unset(Yii::app()->session['success']);
    endif;?>

<h2>Jenis Matkul</h2>
<div class="row"> 
    <div class="col-md-12">
	    <h2>Wajib</h2>
	    <table>
<?php
		foreach ($matkul_wajib as $data):
?>
			<td><?php echo $data->nama?></td>
			<td><?php echo $data->rancangan_kuliah?></td>
			<td>
				<a class="btn btn-default" href="<?php echo Yii::app()->baseUrl;?>/admin/editjenismatkul/<?php echo $data->id?>">Edit</a>
			</td>
			<td>
				<a class="btn btn-danger btn-delete" data-title="<?php echo $data->judul?>" data-link="<?php echo Yii::app()->baseUrl;?>/admin/deletejenismatkul/<?php echo $data->id?>">Delete</a>
			</td> 
<?php
	endforeach;
?>
		</table>
	</div>
	<div class="col-md-4">
      <h2>Mata Kuliah Peminatan</h2>
	    <table>
<?php
		foreach ($peminatan as $data):
?>
			<td><?php echo $data->nama?></td>
			<td><?php echo $data->rancangan_kuliah?></td>
			<td>
				<a class="btn btn-default" href="<?php echo Yii::app()->baseUrl;?>/admin/editjenismatkul/<?php echo $data->id?>">Edit</a>
			</td>
			<td>
				<a class="btn btn-danger btn-delete" data-title="<?php echo $data->judul?>" data-link="<?php echo Yii::app()->baseUrl;?>/admin/deletejenismatkul/<?php echo $data->id?>">Delete</a>
			</td> 
<?php
	endforeach;
?>
		</table>
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
<h1>Peminatan</h1>
<?php
	foreach ($models as $data):
		echo $data->nama;
		echo "<br>";
		echo $data->url?>
		<a href="<?php echo Yii::app()->baseUrl;?>/admin/editpeminatan/<?php echo $data->id?>">edit</a>
<?php
		echo "<br>";
	endforeach;
 ?>