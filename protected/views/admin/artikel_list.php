<?php if(Yii::app()->session['success']):?>
    <div class="alert alert-success" role="alert"><?php echo Yii::app()->session['success']?></div>

<?php 
    unset(Yii::app()->session['success']);
    endif;?>

<h2>Posts</h2>
<table class="table">
	<thead>
		<td>Judul</td>
		<td>Kategori</td>
		<td>Tanggal</td>
		<td></td>
		<td></td>
		<td></td>
	</thead>
<?php
	foreach ($models as $data): ?>
	<tr>
		<td><?php echo $data->judul?></td>
		<td><?php echo $data->kategori['nama']?></td>
		<td><?php echo $data->time_stamp?></td>
		<td>
			<a class="btn btn-default" href="<?php echo Yii::app()->baseUrl;?>/admin/editpost/<?php echo $data->id?>">Edit</a>
		</td>
		<td>
			<a class="btn btn-default btn-delete" data-title="<?php echo $data->judul?>" data-link="<?php echo Yii::app()->baseUrl;?>/post<?php echo $data->id?>">View</a>
		</td> 	
		<td>
			<a class="btn btn-default btn-delete" data-title="<?php echo $data->judul?>" data-link="<?php echo Yii::app()->baseUrl;?>/admin/deletepost/<?php echo $data->id?>">Delete</a>
		</td> 
		</div>
	</tr>
<?php
	endforeach;
 ?>
 </table>

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