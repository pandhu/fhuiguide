<?php 
if($kategori == 'bahan_kuliah') {
  $kategori_uri = 'bahankuliah';
  $judul = 'BAHAN KULIAH';
}
elseif($kategori == 'bank_soal') {
  $kategori_uri = 'banksoal';
  $judul = 'BANK SOAL';
}
else {
  $kategori_uri = $kategori;
  $judul = 'DIKTAT';
}
?>
<div class="col-md-12">
  <h1><?php echo $judul; ?></h1>
  <hr>
</div>
<div class="col-md-12">
<div class="col-md-4">
  <h3 class="block-title">Matakuliah Wajib</h3>
  <div class="panel-group" id="accordionWajib" role="tablist" aria-multiselectable="true">
<?php
foreach ($wajib_list as $wajib) :
?>
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="heading<?php echo $wajib->id;?>">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $wajib->id;?>" aria-expanded="false" aria-controls="collapseTwo">
            <?php echo $wajib->nama; ?>
          </a>
        </h4>
      </div>
      <div id="collapse<?php echo $wajib->id;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $wajib->id;?>">
        <div class="panel-body">
<?php
  foreach ($wajib->matkul as $matkul_peminatan) :
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
  
  <h3 class="block-title">Matakuliah Peminatan</h3>
  <div class="panel-group" id="accordionPeminatan" role="tablist" aria-multiselectable="true">
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
</div>