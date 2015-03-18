<div class="col-md-12">
  <h1>RANCANGAN KULIAH</h1>
  <hr>
</div>
<div class="row"> 
	<div class='col-md-1'></div>
	<div class="col-md-4">
	  	<div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseWajib" aria-expanded="true" aria-controls="collapseOne">
                Mata Kuliah Wajib
              </a>
            </h4>
          </div>
          <div id="collapseWajib" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
              	<?php
				foreach ($models as $data) :
					if($data->kategori == 0) :
						if(!empty($data->rancangan_kuliah)) :
				?>
							<a href="<?php echo $data->rancangan_kuliah; ?>">
						  		<i><?php echo $data->nama; ?></i>
						  	</a><br>
				<?php
						else : echo $data->nama." (belum ada rancangan kuliah)<br>";
						endif;
					endif;
				endforeach;
				?>
            </div>
          </div>
        </div>
	</div>
	<div class='col-md-1'></div>
	<div class="col-md-4">
	  	<div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapsePeminatan" aria-expanded="true" aria-controls="collapseOne">
                Mata Kuliah Peminatan
              </a>
            </h4>
          </div>
          <div id="collapsePeminatan" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
              	<?php
				foreach ($models as $data) :
					if($data->kategori == 1) :
						if(!empty($data->rancangan_kuliah)) :
				?>
							<a href="<?php echo $data->rancangan_kuliah; ?>">
						  		<i><?php echo $data->nama; ?></i>
						  	</a><br>
				<?php
						else : echo $data->nama." (belum ada rancangan kuliah)<br>";
						endif;
					endif;
				endforeach;
				?>
            </div>
          </div>
        </div>
	</div>
</div>