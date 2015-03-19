<!-- NEW ENTRY PANEL -->
	<div class="col-lg-12">
		<div class="panel panel-green">
			<div class="panel-heading">
				Tambah/Ubah Peminatan &amp; Rancangan Kuliah
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<?php $form = $this->beginWidget('CActiveForm', array('id'=>'edit-matkul-form', 'action'=>Yii::app()->baseUrl.'/admin/saveeditmatkul/'.$id));?>
						<div class="form-group">
							<?php echo $form->textField($models, 'nama', array('class'=>'form-control', 'required'=>'true', 'placeholder'=>'Nama Mata Kuliah'));?>  
							<?php echo $form->error($models, 'nama');?>  
						</div>
						<div class="form-group">
							<?php echo $form->dropDownList($models,'jenis',$peminatans, array('class'=>'form-control'));?> 
						</div>
						<div class="form-group">
							<?php echo CHtml::submitButton('Simpan', array('class'=>'btn btn-default', 'style'=>'margin-top:10px;'));?>
						</div>
						<?php $this->endWidget();?>
					</div>
				</div>
			</div>
		</div>
	</div>