<?php

class ArtikelController extends Controller
{
	public function actionIndex($id_kategori)
	{
		$model=new Artikel($id_kategori);
		$this->render('artikel', array('model'=>$model));
	}
}

