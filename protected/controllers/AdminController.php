<?php 
class AdminController extends Controller{
	public $layout = 'main';

	public function actionDashboard(){
		$this->render('/admin/dashboard');
	}

	public function actionIndex(){
		$model = new AdminLoginForm;
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form'){
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		if(isset($_POST['AdminLoginForm'])){
			$model->attributes = $_POST['AdminLoginForm'];
		var_dump($_POST['AdminLoginForm']);
		echo '<br>';
		var_dump($model);
			if ($model->validate() && $model->login()){
				$this->redirect(array('admin/dashboard'));
			}
		}
		$this->render('login', array('model'=> $model));
	}
	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect(array('/admin'));	
	}

	public function actionPosts(){
		/*gunakan layout store*/
		$this -> layout = 'main';
		/*order by id desc*/
		$criteria = new CDbCriteria( array('order' => 'id DESC', ));
		/*count data product*/
		$count = Artikel::model() -> count($criteria);
		/*panggil class paging*/
		$pages = new CPagination($count);
		/*elements per page*/
		$pages -> pageSize = 8;
		/*terapkan limit page*/
		$pages -> applyLimit($criteria);

		/*select data product
		 *cache(1000) digunakan untuk men cache data,
		 * 1000 = 10menit*/
		$models = Artikel::model() -> with('kategori') -> findAll();

		/*render ke file index yang ada di views/product
		 *dengan membawa data pada $models dan
		 *data pada $pages
		 **/
		$this -> render('/admin/artikel_list', array('models' => $models, 'pages' => $pages, ));
	}

	public function actionPeminatan(){
		/*gunakan layout store*/
		$this -> layout = 'main';
		/*order by id desc*/
		$criteria = new CDbCriteria( array('order' => 'id DESC', ));
		/*count data product*/
		$count = Peminatan::model() -> count($criteria);
		/*panggil class paging*/
		$pages = new CPagination($count);
		/*elements per page*/
		$pages -> pageSize = 8;
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
		$this -> render('/admin/peminatan_list', array('models' => $models, 'pages' => $pages, ));
	}

	public function actionEditPost($id){
		$models = Artikel::model()->findByPk($id);
		$kategori = KategoriArtikel::model()->findAll();
		$kategoris = array();
		foreach ($kategori as $data) {
			$kategoris[$data->id] = $data->nama;
		}
		$this -> render('/admin/artikel_edit', array('models' => $models, 'id'=>$id, 'kategoris'=>$kategoris ));
	}

	public function actionSaveEditPost($id){
		$artikel = Artikel::model()->findByPk($id);
		$artikel->attributes = $_POST['Artikel'];
		$artikel->konten = $_POST['konten'];
		$artikel->update();
		$this->redirect('../editpost/'.$id);
	}

	public function actionAddPost(){
		$models = Artikel::model();	
		$kategori = KategoriArtikel::model()->findAll();
		$kategoris = array();
		foreach ($kategori as $data) {
			$kategoris[$data->id] = $data->nama;
		}
		var_dump($kategoris);
		$this -> render('/admin/artikel_add', array('models' => $models, 'kategoris' => $kategoris));
	}

	public function actionSavePost(){

		$artikel = new Artikel();
		$artikel->attributes = $_POST['Artikel'];
		$url = str_replace(' ','-', strtolower($artikel->judul));
		while($tmp = Artikel::model()->find("url='{$url}'")){
			$url_old = explode("-", $tmp->url);
			$count = $url_old[count($url_old)-1];

			if(is_numeric($count)){
				$url_new = array_slice($url_old, 0, count($url_old)-1);
				$url_new = implode('-', $url_new);
				$count++;
				$url = $url_new.'-'.$count; 
			} else {
				$url = $url.'-'.'1';
			}
		}
		$artikel->url = $url;
		$artikel->konten = $_POST['konten'];
		$artikel->save(false);
		$this->redirect('posts/');
	}

	public function actionEditPeminatan($id){
		$models = Peminatan::model()->findByPk($id);
		$this -> render('/admin/artikel_edit', array('models' => $models, 'id'=>$id, 'url'=>$url ));
	}

	public function actionSaveEditPeminatan($id){
		$peminatan = Peminatan::model()->findByPk($id);
		$peminatan->attributes = $_POST['Peminatan'];
		$peminatan->update();
		$this->redirect('../editpeminatan/'.$id);
	}

	public function actionAddPeminatan(){
		$models = Peminatan::model();	
		$this -> render('/admin/peminatan_add', array('models' => $models,));
	}

	public function actionSavePeminatan(){

		$peminatan = new Peminatan();
		$peminatan->attributes = $_POST['Peminatan'];
		$peminatan->save(false);
		$this->redirect('peminatan/');
	}

	public function actionTanyaList(){
		$pertanyaan = Pertanyaan::model()->waktuTanya()->findAll('status = 0');
		$this->render('/admin/tanya_list', array('pertanyaan'=>$pertanyaan));
	}

	public function actionJawab($id){
		$models = Pertanyaan::model();
		$pertanyaan = Pertanyaan::model()->waktuTanya()->findAll('id = '. $id);
		$this->render('/admin/jawab', array('pertanyaan'=>$pertanyaan, 'models'=>$models, 'id' => $id));
	}

	public function actionSubmitjawaban($id){
		$pertanyaan = Pertanyaan::model()->findByPk($id);
		$pertanyaan->jawaban = $_POST['Pertanyaan']['jawaban'];
		$pertanyaan->waktu_jawab = new CDbExpression('NOW()');
		$pertanyaan->status = 1;
		$pertanyaan->update();
		$this->redirect('../tanyalist');
	}

}
?>