<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="<?php echo Yii::app()->baseUrl?>/asset/js/jquery-1.11.2.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/asset/js/bootstrap.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/asset/js/metisMenu.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/asset/js/raphael-min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/asset/js/sb-admin-2.js"></script>
    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/asset/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/asset/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
    
    <!-- MetisMenu CSS -->
    <link href="<?php echo Yii::app()->baseUrl?>/asset/css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo Yii::app()->baseUrl?>/asset/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo Yii::app()->baseUrl?>/asset/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo Yii::app()->baseUrl?>/asset/css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo Yii::app()->baseUrl?>/asset/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin v2.0</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo Yii::app()->baseUrl?>/login/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->baseUrl?>/admin"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> PKM Guide<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo Yii::app()->baseUrl?>/admin/addpost">Add New</a>
                                </li>
                                <li>
                                    <a href="<?php echo Yii::app()->baseUrl?>/admin/posts?cat_id=2">View All</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href=""><i class="fa fa-bar-chart-o fa-fw"></i> Beasiswa<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo Yii::app()->baseUrl?>/admin/addpost">Add New</a>
                                </li>
                                <li>
                                    <a href="<?php echo Yii::app()->baseUrl?>/admin/posts?cat_id=3">View All</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li><a href="<?php echo Yii::app()->baseUrl?>/admin/tanyalist"><i class="fa fa-wrench fa-fw"></i> Tanya Dosen</a>
                        </li>

                        <li><a href="#"><i class="fa fa-wrench fa-fw"></i> Rancangan Kuliah</a>
                        </li>
                        <li><a href="#"><i class="fa fa-wrench fa-fw"></i> Bahan Kuliah</a>
                        </li>
                        <li><a href=""><i class="fa fa-wrench fa-fw"></i> Bank Soal</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <?php echo $content?>
            </div>       
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->  

</body>

</html>
