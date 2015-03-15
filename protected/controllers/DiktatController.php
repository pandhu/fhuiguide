<?php 
class BahanKuliahController extends Controller{
	public $layout = 'main';

	public function actionIndex(){
		$this -> layout = 'main';
		$peminatan = Peminatan::model() -> findAll();
		$matkul_wajib = MataKuliahWajib::model() -> findAll();
		$this -> render('/site/pages/diktat_list', 
			array('peminatan' => $peminatan, 'matkul_wajib'=>$matkul_wajib));
	}
}
?>