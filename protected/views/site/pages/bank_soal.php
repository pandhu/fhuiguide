<div>
  <h1>Bank Soal</h1>
</div>
<div class="row">
<?php
  foreach ($soal_list as $soal) :
?>
    <div class="col-md-4">
      <a href="<?php echo $soal->url; ?>"><?php echo $soal->judul; ?></a>
    </div>
<?php
  endforeach;
?>
</div>