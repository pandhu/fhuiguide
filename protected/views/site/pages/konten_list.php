<div>
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
    echo "<i>Silahkan pilih mata kuliah</i>";
  }
?>
</div>