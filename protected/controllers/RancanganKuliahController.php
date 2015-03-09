<?php 
class RancanganKuliahController extends Controller{
	public $layout = 'main';

	public function actionIndex(){
		/*gunakan layout store*/
		$this -> layout = 'main';
		/*order by id desc*/
		$criteria = new CDbCriteria;
		$criteria->order = 'nama ASC';
		/*count data product*/
		$count = Peminatan::model() -> count($criteria);
		/*panggil class paging*/
		$pages = new CPagination($count);
		/*elements per page*/
		$pages -> pageSize = 2;
		/*terapkan limit page*/
		$pages -> applyLimit($criteria);

		/*select data product
		 *cache(1000) digunakan untuk men cache data,
		 * 1000 = 10menit*/
		$models = Peminatan::model() -> findAll();

		/*render ke file index yang ada di views/product
		 *dengan membawa data pada $models dan
		 *data pada $pages
		 **/
		$this -> render('/site/pages/rancangan_kuliah_list', array('models' => $models, 'pages' => $pages, ));
	}
}
?>