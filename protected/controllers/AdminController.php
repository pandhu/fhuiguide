<?php 
class AdminController extends Controller{
	public $layout = 'admin';


	public function init(){
		if(Yii::app()->user->id==null){
			$this->redirect(array('/login'));	
		}
		$this -> layout = 'admin';

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
		$this->redirect('posts?cat_id='.$cat_id);
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

	public function actionBahanKuliah($id){
		$this -> layout = 'admin';
		$models = Konten::model();
		$konten = Konten::model()->with('matkul', 'jenisMatkul')->findAll(array('condition'=>"t.kategori = 'bahan_kuliah' and matkul_id =".$id));
		$isEmpty = false;
		$matkul = MataKuliah::model()->with('jenisMatkul')->findAll('t.id='.$id); 
		$matkul = $matkul[0];
		if(count($konten)==0){
			$isEmpty = true;
		}
		$this -> render('/admin/bahan_kuliah', array('konten' => $konten, 'models' => $models, 'isEmpty' => $isEmpty, 'matkul' => $matkul));
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

	public function actionSaveBahanKuliah($id){
		$konten=new Konten;
        if(isset($_POST['Konten']))
        {
            $konten->judul=$_POST['Konten']['judul'];
            $konten->kategori='bahan_kuliah';
            $konten->matkul_id=$id;
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
   		Yii::app()->session['success'] = "Bahan Kuliah Berhasil Diupload";
        $this->redirect('../bahankuliah/'.$id);
	}

	public function actionDeleteBahanKuliah($id){
		$konten = Konten::model()->findByPk($id);
		$matkul_id = $konten->matkul_id;
		$filename = $konten->url;
		$filetype = $konten->filetype;
		Konten::model()->deleteAll("id = ".$id);
		Yii::app()->session['success'] = "Bahan Kuliah Berhasil Dihapus";
		unlink(Yii::app()->basePath . '/../uploads/materi/'.$filename.'.'.$filetype);
		$this -> redirect('../bahankuliah/'.$matkul_id);

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
	public function actionBankSoal($id){
		$this -> layout = 'admin';
		$models = Konten::model();
		$konten = Konten::model()->with('matkul', 'jenisMatkul')->findAll(array('condition'=>"t.kategori = 'bank_soal' and matkul_id =".$id));
		$isEmpty = false;
		$matkul = MataKuliah::model()->with('jenisMatkul')->findAll('t.id='.$id); 
		$matkul = $matkul[0];
		if(count($konten)==0){
			$isEmpty = true;
		}
		$this -> render('/admin/bank_soal', array('konten' => $konten, 'models' => $models, 'isEmpty' => $isEmpty, 'matkul' => $matkul));
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

	public function actionSaveBankSoal($id){
		$konten=new Konten;
        if(isset($_POST['Konten']))
        {
            $konten->judul=$_POST['Konten']['judul'];
            $konten->kategori='bank_soal';
            $konten->matkul_id=$id;
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
        $this->redirect('../banksoal/'.$id);
	}

	public function actionDeleteBankSoal($id){
		$konten = Konten::model()->findByPk($id);
		$matkul_id = $konten->matkul_id;
		$filename = $konten->url;
		$filetype = $konten->filetype;
		Konten::model()->deleteAll("id = ".$id);
		Yii::app()->session['success'] = "Bank Soal Berhasil Dihapus";
		unlink(Yii::app()->basePath . '/../uploads/banksoal/'.$filename.'.'.$filetype);
		$this -> redirect('../banksoal/'.$matkul_id);

	}

	public function actionBankSoalUpload(){
		$this -> layout = 'admin';
		$konten = Konten::model() ->with('matkul')->findAll("kategori = 'bahan_kuliah'");
		$this -> render('/admin/bank_soal', array('konten' => $konten));
	}

	/**--------JenisMatkul----------**/
	public function actionJenisMatkul(){
		$jenisMatkul = JenisMatkul::model()->findAll();
		$models = JenisMatkul::model();
		
		$this -> render('/admin/jenis_matkul_list', array('jenisMatkul' => $jenisMatkul, 'models' => $models));
	}

	public function actionEditJenisMatkul($id){
		$models = JenisMatkul::model()->findByPk($id);
		$this -> render('/admin/jenis_matkul_edit', array('models' => $models, 'id'=>$id));
	}

	public function actionSaveEditJenisMatkul($id){
		$peminatan = JenisMatkul::model()->findByPk($id);
		$peminatan->nama = $_POST['JenisMatkul']['nama'];
		$peminatan->kategori = 1;
		if($_POST['JenisMatkul']['file'] != "")
        {
	        $url = str_replace(' ','-', strtolower($peminatan->nama));

                 
			$temp= CUploadedFile::getInstance($peminatan,'file');
            $fileExt = explode('.', $temp->name);
            $fileExt = $fileExt[count($fileExt)-1];
            $fileName = $url.'.'.$fileExt;
            $peminatan->rancangan_kuliah=$fileName;
            
            if($peminatan->update())
            {
	           	 $temp->saveAs(Yii::app()->basePath . '/../uploads/rencana_kuliah/' . $fileName);
            }
        } else $peminatan->update();
		Yii::app()->session['success'] = "Peminatan Berhasil Diedit";

		$this->redirect('../jenismatkul');
	}

	public function actionAddJenisMatkul(){
		$models = JenisMatkul::model();	
		$this -> render('/admin/jenis_matkul_add', array('models' => $models,));
	}

	public function actionSaveJenisMatkul(){
		$peminatan = new JenisMatkul();
		$peminatan->nama = $_POST['JenisMatkul']['nama'];
		$peminatan->rancangan_kuliah = Null;
		$peminatan->kategori = 1;
		if($_POST['JenisMatkul']['file'] != "")
        {
	        $url = str_replace(' ','-', strtolower($peminatan->nama));

                 
			$temp= CUploadedFile::getInstance($peminatan,'file');
            $fileExt = explode('.', $temp->name);
            $fileExt = $fileExt[count($fileExt)-1];
            $fileName = $url.'.'.$fileExt;
            $peminatan->rancangan_kuliah=$fileName;
            
            if($peminatan->save(false))
            {
	           	 $temp->saveAs(Yii::app()->basePath . '/../uploads/rencana_kuliah/' . $fileName);
            }
        } else $peminatan->save(false);
		Yii::app()->session['success'] = "Peminatan Berhasil Disimpan";

		$this->redirect('../jenismatkul');
	}

/**-------------------------------MATKUL----------------------------------**/	
	public function actionMatkul(){
		$models = MataKuliah::model();
		$matkuls = MataKuliah::model() ->bypeminatan()->with('jenisMatkul')-> findAll();
		$peminatan = JenisMatkul::model()->findAll();
		$peminatans = array();
		foreach ($peminatan as $data) {
			$peminatans[$data->id] = $data->nama;
		}
		$this -> render('/admin/matkul_list',array('matkuls' => $matkuls, 'models' => $models, 'peminatans' => $peminatans));
	}

	public function actionEditMatkul($id){

		$peminatan = JenisMatkul::model()->findAll();
		$peminatans = array();
		foreach ($peminatan as $data) {
			$peminatans[$data->id] = $data->nama;
		}
		$models = MataKuliah::model()->findByPk($id);
		$this -> render('/admin/matkul_edit', array('models' => $models, 'id' => $id, 'peminatans' => $peminatans));
	}

	public function actionSaveEditMatkul($id){
		$matkul = MataKuliah::model()->findByPk($id);
		$matkul->nama = $_POST['MataKuliah']['nama'];
		$matkul->jenis = $_POST['MataKuliah']['jenis'];
		$matkul->update();
		Yii::app()->session['success'] = "Mata Kuliah Berhasil Diedit";
		$this->redirect('../matkul/');
	}

	public function actionAddMatkul(){
		$models = MataKuliah::model();
		$this -> render('/admin/matkul_add',
			array('models' => $models));
	}

	public function actionSaveMatkul(){
		$matkul = new MataKuliah();
		$matkul->nama = $_POST['MataKuliah']['nama'];
		$matkul->jenis = $_POST['MataKuliah']['jenis'];
		$matkul->save(false);
		Yii::app()->session['success'] = "Mata Kuliah Berhasil Disimpan";
		$this->redirect('../matkul/');
	}

	public function actionDeleteMataKuliah($id){
		MataKuliah::model()->deleteAll("id = ".$id);
		Yii::app()->session['success'] = "Bank Soal Berhasil Dihapus";
		$this -> redirect('../matkul/');

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

	/**-------BAHAN KULIAH--------
	public function actionBahanKuliah(){
		$this -> layout = 'main';
		$peminatan = Peminatan::model() -> findAll();
		$matkul_wajib = MataKuliahWajib::model() -> findAll();
		$this -> render('/admin/konten_list/',
			array('peminatan' => $peminatan, 'matkul_wajib'=>$matkul_wajib, 'kategori'=>0));
	}

	/**-------BANK SOAL--------
	public function actionBankSoal(){
		$this -> layout = 'main';
		$peminatan = Peminatan::model() -> findAll();
		$matkul_wajib = MataKuliahWajib::model() -> findAll();
		$this -> render('/admin/konten_list/',
			array('peminatan' => $peminatan, 'matkul_wajib'=>$matkul_wajib, 'kategori'=>1));
	}
	*/
	/**-------DIKTAT--------*/
	public function actionDiktat($id){
		$this -> layout = 'admin';
		$models = Konten::model();
		$konten = Konten::model()->with('matkul', 'jenisMatkul')->findAll(array('condition'=>"t.kategori = 'diktat' and matkul_id =".$id));
		$isEmpty = false;
		$matkul = MataKuliah::model()->with('jenisMatkul')->findAll('t.id='.$id); 
		$matkul = $matkul[0];
		if(count($konten)==0){
			$isEmpty = true;
		}
		$this -> render('/admin/diktat', array('konten' => $konten, 'models' => $models, 'isEmpty' => $isEmpty, 'matkul' => $matkul));
	}

	public function actionSaveDiktat($id){
		$konten=new Konten;
        if(isset($_POST['Konten']))
        {
            $konten->judul=$_POST['Konten']['judul'];
            $konten->kategori='diktat';
            $konten->matkul_id=$id;
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
	           	 $temp->saveAs(Yii::app()->basePath . '/../uploads/diktat/' . $fileName);
            }
        }
        $this->redirect('../diktat/'.$id);
	}

	public function actionDeleteDiktat($id){
		$konten = Konten::model()->findByPk($id);
		$matkul_id = $konten->matkul_id;
		$filename = $konten->url;
		$filetype = $konten->filetype;
		Konten::model()->deleteAll("id = ".$id);
		Yii::app()->session['success'] = "Bank Soal Berhasil Dihapus";
		unlink(Yii::app()->basePath . '/../uploads/diktat/'.$filename.'.'.$filetype);
		$this -> redirect('../diktat/'.$matkul_id);

	}
}
?>