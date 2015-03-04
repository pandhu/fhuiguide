<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<section id="login"  class="visible">
     <?php $form = ActiveForm::begin(); ?>
     <div class="form-group">
     <?= $form->field($model, 'username',['template' => "{label}\n<i class='fa fa-envelope'></i>\n{input}\n{hint}\n{error}"]); ?>
     </div>
          <div class="form-group">
             <?= $form->field($model, 'password', ['template' => "{label}\n<i class='fa fa-lock'></i>\n{input}\n{hint}\n{error}"])->passwordInput(); ?>
           </div>
           <div class="form-actions">
           <?= Html::submitButton('Submit', ['class' => 'btn btn-danger', 'name' => 'login-button']) ?>
           </div>
 <?php $form = ActiveForm::end(); ?>