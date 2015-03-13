<?php

class BerandaController extends Controller
{
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/beranda.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('/site/beranda');
	}
}

