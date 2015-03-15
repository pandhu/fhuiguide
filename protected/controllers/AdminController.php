<?php 
class AdminController extends Controller{
	public $layout = 'main';

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
		var_dump($model->attributes);
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
}
/**------------RANCANGAN KULIAH---------------**/
	public function actionRancanganKuliah(){
		$this -> layout = 'main';
		$peminatan = Peminatan::model() -> findAll();
		$matkul_wajib = MataKuliahWajib::model() -> findAll();
		$this -> render('/admin/rancangan_kuliah_list',
			array('peminatan' => $peminatan, 'matkul_wajib'=>$matkul_wajib));
	}

	/**--------PEMINATAN----------**/
	public function actionEditPeminatan($id){
		$models = Peminatan::model()->findByPk($id);
		$this -> render('/admin/peminatan_edit', array('models' => $models, 'id'=>$id));
	}

	public function actionSaveEditPeminatan($id){
		$peminatan = Peminatan::model()->findByPk($id);
		$peminatan->nama = $_POST['Peminatan']['nama'];
		$peminatan->rancangan_kuliah = $_POST['Peminatan']['rancangan_kuliah'];
		$peminatan->update();
		$this->redirect('../editpeminatan/'.$id);
	}

	public function actionAddPeminatan(){
		$models = Peminatan::model();	
		$this -> render('/admin/peminatan_add', array('models' => $models,));
	}

	public function actionSavePeminatan(){
		$peminatan = new Peminatan();
		$peminatan->nama = $_POST['Peminatan']['nama'];
		$peminatan->rancangan_kuliah = $_POST['Peminatan']['rancangan_kuliah'];
		$peminatan->save(false);
		$this->redirect('/admin/rancangankuliah/');
	}

	/**--------MATKUL WAJIB----------*/
	public function actionEditMatkulWajib($id){
		$models = MataKuliahWajib::model()->findByPk($id);
		$this -> render('/admin/matkul_wajib_edit', array('models' => $models, 'semester'=>$id));
	}
	
	public function actionSaveEditMatkulWajib($id){
		$matkul_wajib = MataKuliahWajib::model()->findByPk($id);
		$matkul_wajib->rancangan_kuliah = $_POST['MataKuliahWajib']['rancangan_kuliah'];
		$matkul_wajib->update();
		$this->redirect('/admin/rancangankuliah/');
	}

/**-------------------------------MATKUL----------------------------------**/	
	public function actionMatkul(){
		$this -> layout = 'main';
		$peminatan = Peminatan::model() -> findAll();
		$matkul_wajib = MataKuliahWajib::model() -> findAll();
		$this -> render('/admin/matkul_list',
			array('peminatan' => $peminatan, 'matkul_wajib'=>$matkul_wajib));
	}

	public function actionEditMatkul($id){
		$models = MataKuliah::model()->findByPk($id);
		$this -> render('/admin/matkul_edit', array('models' => $models, 'id' => $id));
	}

	public function actionSaveEditMatkul($id){
		$matkul = MataKuliah::model()->findByPk($id);
		$matkul->nama = $_POST['MataKuliah']['nama'];
		$matkul->update();
		$this->redirect('../editMatkul/'.$id);
	}

	public function actionAddMatkulPeminatan($id){
		$models = MataKuliah::model();
		$this -> render('/admin/matkul_add',
			array('models' => $models, 'peminatan_id' => $id));
	}

	public function actionSaveMatkulPeminatan($id){
		$matkul = new MataKuliah();
		$matkul->nama = $_POST['MataKuliah']['nama'];
		$matkul->peminatan_id = $id;
		$matkul->save(false);
		$this->redirect('/admin/Matkul/');
	}
	
	public function actionAddMatkul($id){
		$models = MataKuliah::model();
		$this -> render('/admin/matkul_add',
			array('models' => $models, 'matkul_wajib_id' => $id ));
	}

	public function actionSaveMatkul($id){
		$matkul = new MataKuliah();
		$matkul->nama = $_POST['MataKuliah']['nama'];
		$matkul->matkul_wajib_id = $id;
		$matkul->save(false);
		$this->redirect('/admin/Matkul/');
	}

	/**-------BAHAN KULIAH--------*/
	public function actionBahanKuliah(){
		$this -> layout = 'main';
		$peminatan = Peminatan::model() -> findAll();
		$matkul_wajib = MataKuliahWajib::model() -> findAll();
		$this -> render('/admin/bahan_kuliah_list',
			array('peminatan' => $peminatan, 'matkul_wajib'=>$matkul_wajib));
	}

	/**-------DIKTAT--------*/
	public function actionDiktat(){
		$this -> layout = 'main';
		$peminatan = Peminatan::model() -> findAll();
		$matkul_wajib = MataKuliahWajib::model() -> findAll();
		$this -> render('/admin/bahan_kuliah_list',
			array('peminatan' => $peminatan, 'matkul_wajib'=>$matkul_wajib));
	}
	
	/**-------BANK SOAL--------*/
	public function actionBankSoal(){
		$this -> layout = 'main';
		$peminatan = Peminatan::model() -> findAll();
		$matkul_wajib = MataKuliahWajib::model() -> findAll();
		$this -> render('/admin/soal_list',
			array('peminatan' => $peminatan, 'matkul_wajib'=>$matkul_wajib));
	}
}
?>
?>