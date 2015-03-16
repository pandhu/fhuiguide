<?php 
class AdminController extends Controller{
	public $layout = 'admin';


	public function init(){
		if(Yii::app()->user->id==null){
			$this->redirect(array('/login'));	
		}
	}

	public function actionIndex(){
		$this->render('/admin/dashboard');

	}

	public function actionPosts(){

		$this -> layout = 'admin';
		$criteria = new CDbCriteria( array('order' => 'id DESC', ));
		
		$count = Artikel::model() -> count($criteria);
		$pages = new CPagination($count);
		$pages -> pageSize = 8;
		$pages -> applyLimit($criteria);
		
		if (isset($_GET['cat_id']))
			$artikel = Artikel::model() -> with('kategori') ->bydate()-> findAll('kategori_id = :cat_id', array(':cat_id'=>$_GET['cat_id']));
		else 
			$artikel = Artikel::model() -> with('kategori') ->bydate()-> findAll();
		
		$this -> render('/admin/artikel_list', array('models' => $artikel, 'pages' => $pages, ));
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

	public function actionDeletePost($id){
		$artikel = Artikel::model()->findByPk($id);
		$cat_id = $artikel->kategori_id;
		Artikel::model()->deleteAll("id = ".$id);
		Yii::app()->session['success'] = "Artikel Berhasil Dihapus";
		$this -> redirect('../posts?cat_id='.$cat_id);
	}
	
	public function actionSaveEditPost($id){
		$artikel = Artikel::model()->findByPk($id);
		$artikel->attributes = $_POST['Artikel'];
		$artikel->konten = $_POST['konten'];
		$artikel->update();
		Yii::app()->session['success'] = "Artikel Berhasil Diubah";
		$this->redirect('../editpost/'.$id);
	}

	public function actionAddPost(){
		$models = Artikel::model();	

		$kategori = KategoriArtikel::model()->findAll();
		$kategoris = array();
		foreach ($kategori as $data) {
			$kategoris[$data->id] = $data->nama;
		}
		$this -> render('/admin/artikel_add', array('models' => $models, 'kategoris' => $kategoris));
	}

	public function actionSavePost(){

		$artikel = new Artikel();
		$artikel->attributes = $_POST['Artikel'];
		$cat_id = $artikel->kategori_id;
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
		Yii::app()->session['success'] = "Artikel Berhasil Dibuat";
		$this->redirect('posts?cat_id='.$cat_i);
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
		Yii::app()->session['success'] = "Pertanyaan Dijawab";
		$this->redirect('../tanyalist');
	}

	public function actionBahanKuliah(){
		$this -> layout = 'admin';
		$konten = Konten::model() ->with('matkul')->findAll("kategori = 'bahan_kuliah'");
		$this -> render('/admin/bahan_kuliah', array('konten' => $konten));
	}

	public function actionAddBahanKuliah(){
		$this -> layout = 'admin';
		$konten = Konten::model();	

		$matkul = MataKuliah::model()->findAll();
		$matkuls = array();
		foreach ($matkul as $data) {
			$matkuls[$data->id] = $data->nama;
		}
		$this -> render('/admin/bahan_kuliah_add', array('konten' => $konten, 'matkuls' => $matkuls));
	}

	public function actionSaveBahanKuliah(){
		$konten=new Konten;
        if(isset($_POST['Konten']))
        {
            $konten->judul=$_POST['Konten']['judul'];
            $konten->kategori='bahan_kuliah';
            $konten->matkul_id=$_POST['Konten']['matkul_id'];
            //$model->image=CUploadedFile::getInstance($model,'image');
            $url = str_replace(' ','-', strtolower($konten->judul));
			while($tmp = Konten::model()->find("url='{$url}'")){
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

			//if($_POST['Konten']['file'] == null) $this->redirect('/admin/addbahankuliah');
			$temp= CUploadedFile::getInstance($konten,'file');
			$fileExt = explode('.', $temp->name);
            $fileExt = $fileExt[count($fileExt)-1];
            $fileName = $url.'.'.$fileExt;
            $konten->url = $url;
            $konten->filetype = $fileExt;
            if($konten->save(false))
            {
            	var_dump($temp->type);
	           	 $temp->saveAs(Yii::app()->basePath . '/../uploads/materi/' . $fileName);
            }
        }
        $this->redirect('bahankuliah');
	}

	public function actionDeleteBahanKuliah($id){
		$konten = Konten::model()->findByPk($id);
		
		$filename = $konten->url;
		$filetype = $konten->filetype;
		Konten::model()->deleteAll("id = ".$id);
		Yii::app()->session['success'] = "Bahan Kuliah Berhasil Dihapus";
		unlink(Yii::app()->basePath . '/../uploads/materi/'.$filename.'.'.$filetype);
		$this -> redirect('../bahankuliah');

	}

	public function actionBahanKuliahUpload(){
		$this -> layout = 'admin';
		$konten = MateriTambahan::model() ->findAll();
		$this -> render('/admin/bahan_kuliah_tambahan', array('konten' => $konten));
	}
	public function actionDeleteBahanKuliahTambahan($id){
		$konten = MateriTambahan::model()->findByPk($id);
		
		$filename = $konten->url;
		$filetype = $konten->filetype;
		MateriTambahan::model()->deleteAll("id = ".$id);
		Yii::app()->session['success'] = "Bahan Kuliah Berhasil Dihapus";
		unlink(Yii::app()->basePath . '/../uploads/materi/tambahan/'.$filename.'.'.$filetype);
		$this -> redirect('../bahankuliahupload');

	}
	public function actionBankSoal(){
		$this -> layout = 'admin';
		$konten = Konten::model() ->with('matkul')->findAll("kategori = 'bank_soal'");
		$this -> render('/admin/bank_soal', array('konten' => $konten));
	}

	public function actionAddBankSoal(){
		$this -> layout = 'admin';
		$konten = Konten::model();	

		$matkul = MataKuliah::model()->findAll();
		$matkuls = array();
		foreach ($matkul as $data) {
			$matkuls[$data->id] = $data->nama;
		}
		$this -> render('/admin/bank_soal_add', array('konten' => $konten, 'matkuls' => $matkuls));
	}

	public function actionSaveBankSoal(){
		$konten=new Konten;
        if(isset($_POST['Konten']))
        {
            $konten->judul=$_POST['Konten']['judul'];
            $konten->kategori='bank_soal';
            $konten->matkul_id=$_POST['Konten']['matkul_id'];
            //$model->image=CUploadedFile::getInstance($model,'image');
            $url = str_replace(' ','-', strtolower($konten->judul));
			while($tmp = Konten::model()->find("url='{$url}'")){
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

			//if($_POST['Konten']['file'] == null) $this->redirect('/admin/addbahankuliah');
			$temp= CUploadedFile::getInstance($konten,'file');
			$fileExt = explode('.', $temp->name);
            $fileExt = $fileExt[count($fileExt)-1];
            $fileName = $url.'.'.$fileExt;
            $konten->url = $url;
            $konten->filetype = $fileExt;
            if($konten->save(false))
            {
            	var_dump($temp->type);
	           	 $temp->saveAs(Yii::app()->basePath . '/../uploads/banksoal/' . $fileName);
            }
        }
        $this->redirect('banksoal');
	}

	public function actionDeleteBankSoal($id){
		$konten = Konten::model()->findByPk($id);
		
		$filename = $konten->url;
		$filetype = $konten->filetype;
		Konten::model()->deleteAll("id = ".$id);
		Yii::app()->session['success'] = "Bank Soal Berhasil Dihapus";
		unlink(Yii::app()->basePath . '/../uploads/banksoal/'.$filename.'.'.$filetype);
		$this -> redirect('../banksoal');

	}

	public function actionBankSoalUpload(){
		$this -> layout = 'admin';
		$konten = Konten::model() ->with('matkul')->findAll("kategori = 'bahan_kuliah'");
		$this -> render('/admin/bank_soal', array('konten' => $konten));
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
		var_dump($peminatan);
		//$this->redirect('/admin/rancangankuliah/');
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

/**------------KONTEN-------------------*/
	public function actionEditKonten($id, $kategori){
		$models = Konten::model()->findByPk($id);
		$this -> render('/admin/konten_edit', array('models' => $models, 'id' => $id, 'kategori'=>$kategori));
	}

	public function actionSaveEditKonten($id, $kategori){
		$matkul = Konten::model()->findByPk($id);
		$matkul->nama = $_POST['konten']['judul']['url'];
		$matkul->kategori = $kategori;
		$matkul->update();
		$this->redirect('../editkonten/'.$id);
	}

	public function actionAddKonten($id, $kategori){
		$models = Konten::model();
		$this -> render('/admin/konten_add',
			array('models' => $models, 'peminatan_id' => $id, 'kategori'=>$kategori));
	}

	public function actionSaveKonten($id, $kategori){
		$matkul = new Konten();
		$matkul->nama = $_POST['konten']['judul']['url'];
		$matkul->peminatan_id = $id;
		$matkul->kategori = $kategori;
		$matkul->save(false);
		$this->redirect('/admin/konten/');
	}

	/**-------BAHAN KULIAH--------*/
	public function actionBahanKuliah(){
		$this -> layout = 'main';
		$peminatan = Peminatan::model() -> findAll();
		$matkul_wajib = MataKuliahWajib::model() -> findAll();
		$this -> render('/admin/konten_list/',
			array('peminatan' => $peminatan, 'matkul_wajib'=>$matkul_wajib, 'kategori'=>0));
	}

	/**-------BANK SOAL--------*/
	public function actionBankSoal(){
		$this -> layout = 'main';
		$peminatan = Peminatan::model() -> findAll();
		$matkul_wajib = MataKuliahWajib::model() -> findAll();
		$this -> render('/admin/konten_list/',
			array('peminatan' => $peminatan, 'matkul_wajib'=>$matkul_wajib, 'kategori'=>1));
	}

	/**-------DIKTAT--------*/
	public function actionDiktat(){
		$this -> layout = 'main';
		$peminatan = Peminatan::model() -> findAll();
		$matkul_wajib = MataKuliahWajib::model() -> findAll();
		$this -> render('/admin/konten_list/',
			array('peminatan' => $peminatan, 'matkul_wajib'=>$matkul_wajib, 'kategori'=>2));
	}
}
?>
?>