<?php 
class DiktatController extends Controller{
	//public $layout = 'sidebar';
	public $layout = 'main';
	public $kategori = 'diktat';

	public function actionIndex(){
		//$this -> layout='sidebar';
		$peminatan_list = JenisMatkul::model() -> findAll('kategori=1');
		$this -> render('/site/pages/konten_list', array('peminatan_list'=>$peminatan_list, 'kategori' => 'diktat'));
	}

	public function actionDownload($id) {
		//$this -> layout='sidebar';
		$peminatan_list = JenisMatkul::model() -> findAll('kategori=1');
		$matkul = MataKuliah::model() -> findByPk($id);
		$this -> render('/site/pages/konten_list', 
			array('peminatan_list'=>$peminatan_list,'matkul' => $matkul, 'kategori' => 'diktat'));
	}

	public function actionMatkulWajib($id) {
		//$this -> layout='sidebar';
		$peminatan_list = JenisMatkul::model() -> findAll('kategori=1');
		$semester = JenisMatkul::model() -> findByPk($id);
		$this -> render('/site/pages/konten_list', 
			array('peminatan_list'=>$peminatan_list,'semester' => $semester, 'kategori' => 'diktat'));
	}
}
?>