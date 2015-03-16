<?php

class ArtikelController extends Controller
{
	public function actionIndex()
	{
		$id = $_GET['cat_id'];
		$artikel = Artikel::model() -> with('kategori') ->bydate()-> findAll('kategori_id = :cat_id', array(':cat_id'=>$_GET['cat_id']));
		$this->render('/site/pages/artikel_list', array('artikel'=>$artikel));
	}

	public function actionPost($url){
		$artikel = Artikel::model()-> findAll('url = :url', array(':url'=>$_GET['url']));
		$artikel = $artikel[0];
		$this->render('/site/pages/artikel_single', array('artikel'=>$artikel));
	}
}

