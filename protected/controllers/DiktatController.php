<?php 
class DiktatController extends Controller{
	public $layout = 'main';
	public $kategori = 'diktat';

	public function actionIndex(){
		$wajib_list = JenisMatkul::model() -> findAll('kategori=0');
		$peminatan_list = JenisMatkul::model() -> findAll('kategori=1');
		$this -> render('/site/pages/konten_list',
			array('peminatan_list'=>$peminatan_list, 'wajib_list'=>$wajib_list, 'kategori' => $this->kategori));
	}

	public function actionDownload($id) {
		$wajib_list = JenisMatkul::model() -> findAll('kategori=0');
		$peminatan_list = JenisMatkul::model() -> findAll('kategori=1');
		$matkul = MataKuliah::model() -> findByPk($id);
		$this -> render('/site/pages/konten_list', 
			array('peminatan_list'=>$peminatan_list,'matkul' => $matkul, 'wajib_list'=>$wajib_list, 'kategori' => $this->kategori));
	}
}
?>