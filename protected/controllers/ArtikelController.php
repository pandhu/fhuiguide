<?php

class ArtikelController extends Controller
{
	public function actionIndex()
	{
		
	}

	public function actionPost($url){
		$artikel = Artikel::model()-> findAll('url = :url', array(':url'=>$url));
		$artikel = $artikel[0];
		$this->render('/site/pages/artikel_single', array('artikel'=>$artikel));
	}

	public function actionKategori($id){
		$artikel = Artikel::model() -> with('kategori') ->bydate()-> findAll('kategori_id = :cat_id', array(':cat_id'=>$id));
		$this->render('/site/pages/artikel_list', array('artikel'=>$artikel));
	}
}

