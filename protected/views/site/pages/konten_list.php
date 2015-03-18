<?php 
if($kategori == 'bahan_kuliah') {
  $kategori_uri = 'bahankuliah';
}
elseif($kategori == 'bank_soal') {
  $kategori_uri = 'bank_soal';
}
else {
  $kategori_uri = $kategori;
}
?>
<div class="col-md-4">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingWajib">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseWajib" aria-expanded="false" aria-controls="collapseWajib">
            Mata Kuliah Wajib
          </a>
        </h4>
      </div>
      <div id="collapseWajib" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingWajib">
        <div class="panel-body">
<?php
$i=0;
while($i<7) {
?>
          <a href="<?php echo Yii::app()->baseUrl.'/'.$kategori_uri.'/matkulwajib/'.$i++;?>">
            Semester <?php echo $i;?>
          </a><br>
<?php
}
?>
        </div>
      </div>
    </div>
<?php
foreach ($peminatan_list as $peminatan) :
?>
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="heading<?php echo $peminatan->id;?>">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $peminatan->id;?>" aria-expanded="false" aria-controls="collapseTwo">
            <?php echo $peminatan->nama; ?>
          </a>
        </h4>
      </div>
      <div id="collapse<?php echo $peminatan->id;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $peminatan->id;?>">
        <div class="panel-body">
<?php
  foreach ($peminatan->matkul as $matkul_peminatan) :
?>
          <a href="<?php echo Yii::app()->baseUrl.'/'.$kategori_uri.'/download/'.$matkul_peminatan->id; ?>">
            <?php echo $matkul_peminatan->nama; ?>
          </a><br>
<?php
  endforeach;
?>
        </div>
      </div>
    </div>
<?php
endforeach;
?>
  </div>
</div>
<div class="col-md-8">
  <h4><?php
  if(!empty($matkul)) {
    echo $matkul->nama;
    ?></h4>
<?php
    $i=0;
    foreach ($matkul->konten as $konten) :
      if($konten->kategori == $kategori) :
?>
        <a href="<?php echo $konten->url; ?>"><?php echo $konten->judul; ?></a><br>
<?php
      $i++;
      endif;
    endforeach;
    if($i==0) {
      echo "<i>Belum ada ".$kategori." untuk mata kuliah ".$matkul->nama."</i>";
    }
  }
  else {
    echo "<i>Silahkan pilih mata kuliah</i><br><br>";
    if(!empty($semester)) :
      foreach ($semester->matkul as $matkul) :
?>
        <a href="<?php echo Yii::app()->baseUrl.'/'.$kategori_uri.'/download/'.$matkul->id; ?>">
            <?php echo $matkul->nama; ?>
          </a><br>
<?php
      endforeach;
    endif;
  }
?>
</div>