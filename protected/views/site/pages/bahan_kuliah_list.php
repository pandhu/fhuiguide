<h1>Peminatan</h1>
<?php
	foreach ($peminatan as $data):
		echo "<b>".$data->nama."</b>";
		echo "<br>";
		$matkul_list = $data->matkul;
		if($matkul_list):
			foreach ($matkul_list as $matkul) {
				echo "<b> - ".$matkul->nama."</b></br>";
?>
				[materi1]<br>
				[materi2]</br>
<?php
			}
		else:
			echo "<i>belum ada pilhan mata kuliah</i>";
		endif;
?>
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
				echo "<b> - ".$matkul->nama."</b></br>";
?>
				[materi1]</br>
				[materi2]</br>
<?php
			}
		else:
			echo "<i>belum ada pilhan mata kuliah</i>";
		endif;
?>
		</br>
		</br>
<?php
	endforeach;
 ?>