<?php 
class RancanganKuliahController extends Controller{
	public $layout = 'main';

	public function actionIndex(){
		$models = JenisMatkul::model() -> findAll();
		$this -> render('/site/pages/rancangan_kuliah_list', array('models' => $models));
	}
}
?>