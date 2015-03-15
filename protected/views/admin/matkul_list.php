<h1>Peminatan</h1>
<?php
	foreach ($peminatan as $data):
		echo "<b>".$data->nama."</b>";
		echo "<br>";
		$matkul_list = $data->matkul;
		if($matkul_list):
			foreach ($matkul_list as $matkul) {
				echo "<b> - ".$matkul->nama."</b>";
?>
				<a href="<?php echo Yii::app()->baseUrl;?>/admin/editmatkul/<?php echo $matkul->id?>">edit matkul</a>
				</br>
<?php
			}
		else:
			echo "<i>belum ada pilhan mata kuliah</i>";
		endif;
?>
		<a href="<?php echo Yii::app()->baseUrl;?>/admin/addmatkulpeminatan/<?php echo $data->id?>">add matkul</a>
		</br>
		</br>
<?php
	endforeach;
?>
 <h1>Matkul Wajib</h1>
<?php
	foreach ($matkul_wajib as $data):
		echo "<b>Semester ".$data->semester."</b>";
		echo "<br>";
		$matkul_list = $data->matkul;
		if($matkul_list):
			foreach ($matkul_list as $matkul) {
				echo "<b> - ".$matkul->nama."</b>";
?>
				<a href="<?php echo Yii::app()->baseUrl;?>/admin/editmatkul/<?php echo $matkul->id?>">edit matkul</a>
				</br>
<?php
			}
		else:
			echo "<i>belum ada pilhan mata kuliah</i>";
		endif;
?>
		<a href="<?php echo Yii::app()->baseUrl;?>/admin/addmatkul/<?php echo $data->semester?>">add matkul</a>
		</br>
		</br>
<?php
	endforeach;
 ?>