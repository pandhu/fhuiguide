<?php 
class BankSoalController extends Controller{
	public $layout = 'sidebar';

	public function actionIndex(){
		$this -> render('/site/pages/konten_list');
	}

	public function actionDownload($id) {
		$matkul = MataKuliah::model() -> findByPk($id);
		$this -> render('/site/pages/konten_list', 
			array('matkul' => $matkul, 'kategori' => 'bank_soal'));
	}
}
?>