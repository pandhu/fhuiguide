<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/asset/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/asset/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	
	<script src="<?php echo Yii::app()->baseUrl?>/asset/js/jquery-1.11.2.min.js"></script>
	<script src="<?php echo Yii::app()->baseUrl?>/asset/js/bootstrap.min.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">FHUI Guide</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="">Home</a></li>
            <li><a href="#">Rancangan Kuliah</a></li>
            <li><a href="#">Bahan Kuliah</a></li>
            <li><a href="#">Bank Soal</a></li>
            <li><a href="<?php echo Yii::app()->baseUrl?>/tanyadosen">Tanya Dosen</a></li>
            <li><a href="<?php echo Yii::app()->baseUrl?>/artikel?cat_id=2">PKM Guide</a></li>
            <li><a href="<?php echo Yii::app()->baseUrl?>/artikel?cat_id=3">Beasiswa</a></li>
          </ul>
        </div>
      </div>
    </nav><!-- mainmenu -->
    <div id="content" class="col-md-12">
	<?php echo $content; ?>
	</div>
	<div class="clearfix"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
