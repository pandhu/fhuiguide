<?php 
class BahankuliahController extends Controller{
	public $layout = 'main';

	public function actionIndex(){
		$konten = Konten::model() ->with('matkul')->bymatkul()->findAll("kategori = 'bahan_kuliah'");
		$data = array();
		$cat_id = -1;
		$matkul;
		$count = 0;
		foreach ($konten as $item) {
			if ($item->matkul_id != $cat_id){
				if ($count != 0){
					$data[$cat_id] = $matkul;
				}
				$cat_id = $item->matkul_id;
				$matkul = array();
			}
			array_push($matkul, $item);
			$count++;
		}
		$data[$cat_id] = $matkul;

		$this -> render('/site/pages/bahan_kuliah', array('konten' => $data));
	}

	public function actionAddBahanKuliah(){
		$konten = MateriTambahan::model();	
		$this -> render('/site/pages/bahan_kuliah_add', array('konten' => $konten));
	}

	public function actionSaveBahanKuliah(){
		$konten=new MateriTambahan;
        if(isset($_POST['MateriTambahan']))
        {
            $konten->judul=$_POST['MateriTambahan']['judul'];
            $konten->deskripsi=$_POST['MateriTambahan']['deskripsi'];
            //$model->image=CUploadedFile::getInstance($model,'image');
            $url = str_replace(' ','-', strtolower($konten->judul));
			while($tmp = MateriTambahan::model()->find("url='{$url}'")){
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

			//if($_POST['MateriTambahan']['file'] == null) $this->redirect('/admin/addbahankuliah');
			$temp= CUploadedFile::getInstance($konten,'file');
			$fileExt = explode('.', $temp->name);
            $fileExt = $fileExt[count($fileExt)-1];
            $fileName = $url.'.'.$fileExt;
            $konten->url = $url;
            $konten->filetype = $fileExt;
            if($konten->save(false))
            {
            	var_dump($temp->type);
	           	 $temp->saveAs(Yii::app()->basePath . '/../uploads/materi/tambahan/' . $fileName);
            }
        }
        $this->redirect('../bahankuliah');
	}

	public function actionDeleteBahanKuliah($id){
		$konten = MateriTambahan::model()->findByPk($id);
		
		$filename = $konten->url;
		$filetype = $konten->filetype;
		MateriTambahan::model()->deleteAll("id = ".$id);
		Yii::app()->session['success'] = "Bahan Kuliah Berhasil Dihapus";
		unlink(Yii::app()->basePath . '/../uploads/materi/'.$filename.'.'.$filetype);
		$this -> redirect('../bahankuliah');

	}

	public function actionBahanKuliahUpload(){
		$this -> layout = 'admin';
		$konten = MateriTambahan::model() ->with('matkul')->findAll("kategori = 'bahan_kuliah'");
		$this -> render('/admin/bahan_kuliah', array('konten' => $konten));
	}
}
?>

