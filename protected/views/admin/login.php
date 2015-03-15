<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Silahkan login untuk ke Admin Area</h1>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
   				<?php $form = $this->beginWidget('CActiveForm', array('id'=>'login-form', 'htmlOptions'=>array('class'=>'form-signin')));?>
	                <?php echo $form->textField($model, 'username', array('class'=>'form-control', 'placeholder'=>'Username'));?>
	           		<?php echo $form->error($model, 'username');?>		
		
	           		<?php echo $form->textField($model, 'password', array('class'=>'form-control', 'placeholder'=>'Password'));?>
	           		<?php echo $form->error($model, 'password');?>
	           		<?php echo CHtml::submitButton('Login', array('class'=>'btn btn-lg btn-primary btn-block', 'style'=>'margin-top:10px;'));?>
           		<?php $this->endWidget();?>
            </div>
        </div>
    </div>
</div>