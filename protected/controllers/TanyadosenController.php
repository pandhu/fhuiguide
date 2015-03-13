<?php 
class TanyadosenController extends Controller{
	public $layout = 'main';

	public function actionIndex(){
		$models = Pertanyaan::model();	
		/*gunakan layout store*/
		$this -> layout = 'main';
		/*order by id desc*/
		$criteria = new CDbCriteria( array('order' => 'id ASC', ));
		/*count data product*/
		$count = Pertanyaan::model() -> count($criteria);
		/*panggil class paging*/
		$pages = new CPagination($count);
		/*elements per page*/
		$pages -> pageSize = 8;
		/*terapkan limit page*/
		$pages -> applyLimit($criteria);

		$pertanyaan = Pertanyaan::model()->waktuTanya()->findAll('status = 1');
		$this -> render('/site/pages/tanya_dosen', array('models'=>$models, 'pertanyaan' => $pertanyaan, 'pages' => $pages, ));
	}

	public function actionSavePertanyaan(){
		$pertanyaan = new Pertanyaan();
		var_dump($_POST['Pertanyaan']);
		$pertanyaan->attributes = $_POST['Pertanyaan'];
		$pertanyaan->waktu_tanya = new CDbExpression('NOW()');
		$pertanyaan->save(false);
		$this->redirect('../tanyadosen');
	}
}
?>