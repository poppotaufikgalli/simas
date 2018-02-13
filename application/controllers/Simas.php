<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simas extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
        parent::__construct();
        //$this->load->library('session');
        
        $this->opd = $this->t_simas_model->load_singel('tb_var_global', 'item','opd');
        $this->menu = $this->t_simas_model->load_data('tb_menu', 'aktif', 1, 'idx');
        foreach ($this->menu as $nm_menu) {
            $this->nm_menu[$nm_menu->idx] = $nm_menu->nm_menu;
        }
        $this->unker = $this->t_simas_model->load_data('tb_unker');
        foreach ($this->unker as $ref_unker) {
            if($ref_unker->nm_unker == "Sekretariat"){
                $this->ref_unker[$ref_unker->kd_unker] = "Sekretaris"; 
            }else{
                if($ref_unker->kese !== '99'){
                    $this->ref_unker[$ref_unker->kd_unker] = "Kepala ".$ref_unker->nm_unker;
                }else{
                    $this->ref_unker[$ref_unker->kd_unker] = $ref_unker->nm_unker;
                }
                
            }
        }

        $this->field = array('2' => ['kd_jns_surat', 'nomor_urut', 'nomor_surat', 'tgl_surat', 'asal','perihal'], '3'=> ['kd_jns_surat','nomor_surat', 'tgl_surat','sifat','tgl_terima','asal','perihal','cp'], '4'=> ['kd_jns_surat','nomor_urut', 'nomor_surat', 'tgl_surat', 'nomor_sisip', 'asal_bidang', 'tujuan', 'perihal','ref_surat_masuk','nomor_nodin', 'tgl_nodin'], '5' => ['tgl_disposisi','ref_surat_masuk','kd_unker_asal','kd_unker_tujuan', 'isi'], '6' => ['nip', 'glr_dpn', 'glr_blk', 'nama', 'tmpt_lhr', 'tgl_lhr', 'kd_jab', 'tmt_jab','kd_pangkat', 'tmt_pangkat','kd_pangkat_cpns', 'tmt_cpns', 'tmt_kgb', 'uname', 'password','pmk_thn', 'pmk_bln','cpns_ms_thn', 'cpns_ms_bln']);

        $this->pangkat = array('111' => "Juru Muda (I/a)", '112' => "Juru Muda Tk.I (I/b)", '113' => "Juru (I/c)", '114' => "Juru Tk.I (I/d)", '121' => "Pengatur Muda (II/a)", '122' => "Pengatur Muda Tk.I  (II/b)", '123' => "Pengatur (II/c)", '124' => "Pengatur Tk.I (II/d)", '131' => "Penata Muda (III/a)", '132' => "Penata Muda Tk.I (III/b)", '133' => "Penata (III/c)", '134' => "Penata Tk.I (III/d)", '141' => "Pembina (IV/a)", '142' => "Pembina Tk.I (IV/b)", '143' => "Pembina Utama Muda (IV/c)", '144' => "Pembina Utama (IV/d)", '145' => "Pembina Utama Madya (IV/e)");

        $this->thn_global = date('Y');

        date_default_timezone_set("Asia/Bangkok");        
    }

	public function index()
	{
		$this->dashboard();
	}

	function dashboard($kd_jns_surat='2,3,4,5')
    {
    	$data['opd'] = $this->opd;
    	$this->header('Dashboard');
    	$sql = "SELECT a.idx, a.nm_menu, COUNT(b.idx) as jml FROM tb_menu a JOIN tb_surat b ON (a.idx = b.kd_jns_surat) WHERE lvl=1 GROUP BY a.idx UNION ALL SELECT a.idx, 'disposisi', COUNT(b.idx) as jml FROM tb_menu a JOIN viw_disposisi b ON (a.idx = 5) GROUP BY a.idx";
    	$rekap = $this->t_simas_model->load_data_sql($sql);
    	if(empty($rekap)==false){
    		foreach ($rekap as $rekap) {
    			$data['rekap'][$rekap->idx] = $rekap->jml;
    		}
    	}

        $sql = "SELECT * FROM tb_akses where nip = '".$this->session->nip."' and akses like '[\"1\",%'";
        $data['dashboard_akses'] = $this->t_simas_model->load_singel_sql($sql);

        $sql2 = "SELECT a.idx, a.kd_jns_surat, TO_CHAR(a.tgl_surat, 'DD-MM-YYYY') as tgl_surat, a.asal as perihal, d.nm_menu, d.icon, d.color2, a.perihal as isi FROM tb_surat a LEFT JOIN tb_menu d on (a.kd_jns_surat=d.idx) WHERE a.kd_jns_surat = 2 ";
        
        if(substr($this->session->nip, 0,1) !== 'A'){
            $sql3 = "SELECT a.idx, a.kd_jns_surat, TO_CHAR(a.tgl_surat, 'DD-MM-YYYY') as tgl_surat, a.perihal, d.nm_menu, d.icon, d.color2, b.isi FROM tb_surat a LEFT JOIN tb_disposisi b ON (a.idx = b.ref_surat_masuk) LEFT JOIN tb_pegawai c on (b.kd_unker_tujuan = c.kd_jab) LEFT JOIN tb_menu d on (a.kd_jns_surat=d.idx) WHERE a.kd_jns_surat = 3 AND c.nip = '".$this->session->nip."'";
        }else{
            $sql3 = "SELECT a.idx, a.kd_jns_surat, TO_CHAR(a.tgl_surat, 'DD-MM-YYYY') as tgl_surat, a.perihal, d.nm_menu, d.icon, d.color2, a.perihal as isi FROM tb_surat a LEFT JOIN tb_menu d on (a.kd_jns_surat=d.idx) WHERE a.kd_jns_surat = 3 UNION ALL SELECT a.ref_surat_masuk as idx, '5', a.tgl_disposisi as tgl_surat, a.isi as perihal, d.nm_menu, d.icon, d.color2, a.surat_masuk || '<br>' || a.idx2 as isi FROM viw_disposisi a LEFT JOIN tb_menu d on (d.idx = 5)";
        }
        $sql4 = "SELECT a.idx, a.kd_jns_surat, TO_CHAR(a.tgl_surat, 'DD-MM-YYYY') as tgl_surat, a.tujuan as perihal, d.nm_menu, d.icon, d.color2, a.perihal as isi FROM tb_surat a LEFT JOIN tb_menu d on (a.kd_jns_surat=d.idx) WHERE a.kd_jns_surat = 4 AND a.asal_bidang like '".substr($this->session->kd_jab, 0,8)."%'";

        
        $data['sel_jns_surat'] = explode(',', $kd_jns_surat);
        $sql = $sql2." UNION ALL ".$sql3." UNION ALL ".$sql4." ORDER BY tgl_surat desc , idx desc";

        $data['surat'] = $this->t_simas_model->load_data_sql($sql);

		$this->load->view('dashboard', $data);
		$this->footer();
    }

    function getTimeline($offset, $limit=5){
        $sql2 = "SELECT a.idx, a.kd_jns_surat, TO_CHAR(a.tgl_surat, 'DD-MM-YYYY') as tgl_surat, a.asal as perihal, d.nm_menu, d.icon, d.color2, a.perihal as isi FROM tb_surat a LEFT JOIN tb_menu d on (a.kd_jns_surat=d.idx) WHERE a.kd_jns_surat = 2 ";
        
        if(substr($this->session->nip, 0,1) !== 'A'){
            $sql3 = "SELECT a.idx, a.kd_jns_surat, TO_CHAR(a.tgl_surat, 'DD-MM-YYYY') as tgl_surat, a.perihal, d.nm_menu, d.icon, d.color2, b.isi FROM tb_surat a LEFT JOIN tb_disposisi b ON (a.idx = b.ref_surat_masuk) LEFT JOIN tb_pegawai c on (b.kd_unker_tujuan = c.kd_jab) LEFT JOIN tb_menu d on (a.kd_jns_surat=d.idx) WHERE a.kd_jns_surat = 3 AND c.nip = '".$this->session->nip."'";
        }else{
            $sql3 = "SELECT a.idx, a.kd_jns_surat, TO_CHAR(a.tgl_surat, 'DD-MM-YYYY') as tgl_surat, a.perihal, d.nm_menu, d.icon, d.color2, a.perihal as isi FROM tb_surat a LEFT JOIN tb_menu d on (a.kd_jns_surat=d.idx) WHERE a.kd_jns_surat = 3 UNION ALL SELECT a.ref_surat_masuk as idx, '5', a.tgl_disposisi as tgl_surat, a.isi as perihal, d.nm_menu, d.icon, d.color2, a.surat_masuk || '<br>' || a.idx2 as isi FROM viw_disposisi a LEFT JOIN tb_menu d on (d.idx = 5)";
        }
        $sql4 = "SELECT a.idx, a.kd_jns_surat, TO_CHAR(a.tgl_surat, 'DD-MM-YYYY') as tgl_surat, a.tujuan as perihal, d.nm_menu, d.icon, d.color2, a.perihal as isi FROM tb_surat a LEFT JOIN tb_menu d on (a.kd_jns_surat=d.idx) WHERE a.kd_jns_surat = 4 AND a.asal_bidang like '".substr($this->session->kd_jab, 0,8)."%'";

        
        //$data['sel_jns_surat'] = explode(',', $kd_jns_surat);
        $sql = $sql2." UNION ALL ".$sql3." UNION ALL ".$sql4." ORDER BY tgl_surat desc, idx desc limit ".$limit." offset ".$offset;

        $json = $this->t_simas_model->load_data_sql($sql);

        echo json_encode($json);
    }

	function header($title)
	{
		$data['title'] = ucfirst($title);
		$data['menu'] = $this->menu;
        $data['akses'] = $this->t_simas_model->load_singel('tb_akses', 'nip', $this->session->nip);
		$this->load->view('header', $data);
		if($title !== 'login'){
			$this->load->view('session_check');
			$this->load->view('menu');
		}
	}

	function footer()
	{
		$this->load->view('footer');
	}

	function login()
	{
		$this->form_validation->set_rules('username','Username','trim|strip_tags');
        $this->form_validation->set_rules('password','Password','trim');
        $this->form_validation->set_rules('token','token','callback_check_login');

        if ($this->form_validation->run() == TRUE){
            redirect(base_url('index.php/simas/dashboard'));
        }else{
            redirect(base_url('index.php/simas/login_form'));
        }        
	}

	function login_form()
	{
		$this->header('login');
		$this->load->view('login');
		$this->footer();
	}

	function logout()
    {
        $this->access->logout();
        $this->index();
    }

    function check_login()
    {
        $user = $this->input->post('username', TRUE);
        $pass = $this->input->post('password', TRUE);

        $login = $this->access->login($user, $pass);
        if ($login){
            return true;
        }  else {
            $this->form_validation->set_message('check_login','username atau password salah');
            return false;
        }
    }

    function tambah($jns_surat)
    {
    	$data['jns_surat'] = $jns_surat;
    	$nm_menu =  $this->nm_menu[$jns_surat];
    	$data['unker'] = $this->unker;

    	$this->header('Tambah '.$nm_menu);
    	$this->load->view('tambah\form_tambah_'.$jns_surat, $data);
    	$this->footer();
    }

    function edit($idx)
    {
        $sql = "SELECT * FROM tb_surat WHERE idx =".$idx;
        $data['surat'] = $this->t_simas_model->load_singel_sql($sql);
        $jns_surat = $data['surat']->kd_jns_surat;
        $nm_menu =  $this->nm_menu[$jns_surat];
        $data['unker'] = $this->unker;

        $this->header('Edit '.$nm_menu);
        $this->load->view('edit/form_edit_'.$jns_surat, $data);
        $this->footer();
    }

    function edit_disposisi()
    {
        $idx = filter_input(INPUT_POST, 'idx_to_edit');
        $sql = "SELECT * FROM viw_disposisi WHERE idx ='".$idx."'";
        $data['disposisi'] = $this->t_simas_model->load_singel_sql($sql);
        $jns_surat = '5';
        $nm_menu =  $this->nm_menu[$jns_surat];
        $data['unker'] = $this->unker;

        $this->header('Edit '.$nm_menu);
        $this->load->view('edit/form_edit_5', $data);
        $this->footer();
    }

    function upload_file($jns_surat, $idx=null){
        $data['jns_surat'] = $jns_surat;
        $data['nm_menu'] =  $this->nm_menu[$jns_surat];
        $data['idx'] = $idx;
        //$data['unker'] = $this->unker;

        $this->header('Upload File '.$data['nm_menu']);
        $this->load->view('upload/upload_file', $data);
        $this->footer();
    }

    function lihat($kd_jns_surat, $status=null)
    {
    	$data['kd_jns_surat'] = $kd_jns_surat;
    	$nm_menu =  $this->nm_menu[$kd_jns_surat];
        $dir = FCPATH."/asset/file_surat/".$kd_jns_surat;

    	switch ($kd_jns_surat) {
    		case 2:
    			$sql = "select a.idx, a.kd_jns_surat, a.nomor_surat, TO_CHAR(a.tgl_surat, 'DD-MM-YYYY') as tgl_surat, a.perihal, a.asal from tb_surat a where a.kd_jns_surat = ".$kd_jns_surat." order by a.tgl_surat desc";
    			break;

    		case 3:
    			$sql = "select a.idx, a.kd_jns_surat, a.nomor_surat, TO_CHAR(a.tgl_surat, 'DD-MM-YYYY') as tgl_surat, a.perihal, a.asal, TO_CHAR(a.tgl_terima, 'DD-MM-YYYY') as tgl_terima, a.sifat, a.cp, (select max(TO_CHAR(b.tgl_disposisi, 'DD-MM-YYYY')) from tb_disposisi b where b.ref_surat_masuk = a.idx) as disposisi from tb_surat a where a.kd_jns_surat = ".$kd_jns_surat." order by a.tgl_surat desc";
    			break;

    		case 4:
    			$sql = "select a.idx, a.kd_jns_surat, a.nomor_surat, TO_CHAR(a.tgl_surat, 'DD-MM-YYYY') as tgl_surat, a.perihal, a.asal_bidang, c.nm_unker, b.nomor_surat as ref_nomor_surat_masuk, TO_CHAR(b.tgl_surat, 'DD-MM-YYYY') as ref_tgl_surat_masuk, b.perihal as ref_perihal_surat_masuk, a.nomor_nodin, TO_CHAR(a.tgl_nodin, 'DD-MM-YYYY') as tgl_nodin, '0' as imgok from tb_surat a left join tb_surat b on (a.ref_surat_masuk=b.idx) left join tb_unker c on (a.asal_bidang = c.kd_unker) where a.kd_jns_surat = ".$kd_jns_surat." order by a.tgl_surat desc";
    			break;

            case 5:
                $sql = "select * from viw_disposisi order by tgl_disposisi desc" ;
                $data['ref_unker'] = $this->ref_unker;
                break;
    		
    		default:
    			# code...
    			break;
    	}
    	
    	$data['surat'] = $this->t_simas_model->load_data_sql($sql);

        if(empty($data['surat'])==false){
            foreach ($data['surat'] as $dt_surat) {
                $dirs = $dir.".".$dt_surat->idx."/";
                $data['img'][$dt_surat->idx] = glob($dirs.'*.{jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF}', GLOB_BRACE);
            }
        }

    	$this->header('Lihat Data '.$nm_menu);
    	$this->load->view('lihat/lihat_data_'.$kd_jns_surat, $data);
    	$this->footer();
    }

    function pegawai(){
        $this->header('Manajemen Pegawai');
        $data['pegawai'] = $this->t_simas_model->load_data('viw_duk');
        $data['pangkat'] = $this->pangkat;
        $data['unker'] = $this->ref_unker;
        $data['menu'] = $this->menu;
        $this->load->view('pegawai/lihat_pegawai', $data);
        $this->footer();
    }

    function getProfil($nip){
        $json = $this->t_simas_model->load_singel('viw_duk', 'nip', $nip);
        echo json_encode($json);
    }

    function getAkses($nip){
        $json = $this->t_simas_model->load_data('tb_akses', 'nip', $nip);
        echo json_encode($json);
    }

    function tambah_pegawai(){
        for($i=0;$i<count($this->field['6']);$i++){
            $field = $this->field[6][$i];
            if(filter_has_var(INPUT_POST, $field)){
                $value = filter_input(INPUT_POST, $field);
                if(empty($value)==false){
                    $data[$field] = $value; 
                }
            }
        }
        $data['flag'] = 1;
        $this->t_simas_model->add_data('tb_pegawai', $data, 'nip', 'nama', 'tgl_lhr');
        //echo json_encode($data);
    }

    function update_pegawai(){
        for($i=0;$i<count($this->field['6']);$i++){
            $field = $this->field[6][$i];
            if(filter_has_var(INPUT_POST, $field)){
                $value = filter_input(INPUT_POST, $field);
                //if(empty($value)==false){
                    $data[$field] = $value; 
                //}
            }
        }
        $this->t_simas_model->update_data('tb_pegawai', $data, 'nip');
    }

    function akses(){
        $data['uname'] = filter_input(INPUT_POST, 'uname');
        $data['password'] = filter_input(INPUT_POST, 'password');
        $data['nip'] = filter_input(INPUT_POST, 'nip_akses');
        $data_akses['nip'] = $data['nip'];

        $this->t_simas_model->update_data1('tb_pegawai', $data, 'nip');

        $menu = $_POST['menu'];

        $menu = json_encode($menu);

        $cData = $this->t_simas_model->load_data('tb_akses', 'nip', $data_akses['nip']);
        $data_akses['akses'] = $menu;

        if(empty($cData)==false){
            $this->t_simas_model->update_data('tb_akses', $data_akses, 'nip');
        }else{
            $this->t_simas_model->add_data('tb_akses', $data_akses, 'nip');
        }
    }

    function cari($kd_jns_surat)
    {
        if($kd_jns_surat == '5'){
            $sql = "select a.idx, a.surat_masuk as nomor_surat, a.tgl_disposisi as tgl_surat, a.isi as perihal, a.kd_unker_asal as asal, ROW_NUMBER () OVER (ORDER BY a.idx) AS no from viw_disposisi a";
        }elseif($kd_jns_surat == '3'){
            $sql = "select a.idx, a.kd_jns_surat, a.nomor_surat, TO_CHAR(a.tgl_surat, 'DD-MM-YYYY') as tgl_surat, a.perihal, a.asal, TO_CHAR(a.tgl_terima, 'DD-MM-YYYY') as tgl_terima, a.sifat, a.cp, (select max(TO_CHAR(b.tgl_disposisi, 'DD-MM-YYYY')) from tb_disposisi b where b.ref_surat_masuk = a.idx) as disposisi, ROW_NUMBER () OVER (ORDER BY a.idx) AS no from tb_surat a where a.kd_jns_surat = ".$kd_jns_surat." order by a.tgl_surat desc";
        }else{
            $sql = "select a.idx, a.nomor_surat, TO_CHAR(a.tgl_surat, 'DD-MM-YYYY') as tgl_surat, a.perihal, a.asal, ROW_NUMBER () OVER (ORDER BY a.idx) AS no from tb_surat a where a.kd_jns_surat = ".$kd_jns_surat;
        }
    	
    	$json['data'] = $this->t_simas_model->load_data_sql($sql);

    	echo json_encode($json);
    }

    function cari_by_idx()
    {
        $kd_jns_surat = filter_input(INPUT_POST, 'kd_jns_surat');
        $idx = filter_input(INPUT_POST, 'idx');
        $sql = "select a.idx, a.nomor_surat, TO_CHAR(a.tgl_surat, 'yyyy-mm-dd') as tgl_surat, a.perihal, a.asal from tb_surat a where a.kd_jns_surat = ".$kd_jns_surat." and a.idx = ".$idx;
        
        $json = $this->t_simas_model->load_singel_sql($sql);

        echo json_encode($json);
    }

    function max_number($tabel, $kd_jns_surat){
    	$sql = "select coalesce(max(nomor_urut),0) as nomor_urut from ".$tabel." where kd_jns_surat = ".$kd_jns_surat;
    	$nomor_surat = $this->t_simas_model->load_singel_sql($sql);

    	echo json_encode($nomor_surat);
    }

    function check_number($tabel, $kd_jns_surat, $nomor_urut){
    	$sql = "select * from ".$tabel." where kd_jns_surat = ".$kd_jns_surat." and nomor_urut = ".$nomor_urut;
    	$data = $this->t_simas_model->load_singel_sql($sql);

    	echo json_encode($data);
    }

    function simpan($kd_jns_surat){
    	for($i=0;$i<count($this->field[$kd_jns_surat]);$i++){
    		$field = $this->field[$kd_jns_surat][$i];
    		$value = filter_input(INPUT_POST, $field);
    		if(empty($value)==false){
    			$data[$field] = $value;	
    		}
    	}
    	$data['kd_jns_surat'] = $kd_jns_surat;
    	
        if($kd_jns_surat == 4){
            $this->t_simas_model->add_data1('tb_surat', $data);
            $this->tanda_terima($data);
        }else{
            $idx = $this->t_simas_model->add_data1('tb_surat', $data);
            $this->upload_file($data['kd_jns_surat'], $idx);
        }
        //echo json_encode($data);
    }

    function simpan_disposisi(){
        $kd_jns_surat = 5;
        for($i=0;$i<count($this->field[$kd_jns_surat]);$i++){
            $field = $this->field[$kd_jns_surat][$i];
            $value = filter_input(INPUT_POST, $field);
            if(empty($value)==false){
                $data[$field] = $value; 
            }
        }

        $kd_unker_tujuan = $_POST['kd_unker_tujuan'];
        
        for($i=0;$i<count($kd_unker_tujuan);$i++){
            $data['kd_unker_tujuan'] = $kd_unker_tujuan[$i];
            $this->t_simas_model->add_data1('tb_disposisi', $data);    
        }

        redirect(base_url('index.php/simas/lihat/5'));
    }

    function update($kd_jns_surat, $idx){
        for($i=0;$i<count($this->field[$kd_jns_surat]);$i++){
            $field = $this->field[$kd_jns_surat][$i];
            $value = filter_input(INPUT_POST, $field);
            if(empty($value)==false){
                $data[$field] = $value; 
            }
        }

        $data['idx'] = $idx;
        $data['kd_jns_surat'] = $kd_jns_surat;

        if($kd_jns_surat == 4){
            $this->t_simas_model->update_data1('tb_surat', $data, 'idx');
            $this->tanda_terima($data);
        }else{
            $this->t_simas_model->update_data1('tb_surat', $data, 'idx');
            redirect(base_url('index.php/simas/lihat/'.$kd_jns_surat));
        }
    }

    function update_disposisi(){
        $kd_jns_surat = 5;
        for($i=0;$i<count($this->field[$kd_jns_surat]);$i++){
            $field = $this->field[$kd_jns_surat][$i];
            $value = filter_input(INPUT_POST, $field);
            if(empty($value)==false){
                $data[$field] = $value; 
            }
        }

        $kd_unker_tujuan = $_POST['kd_unker_tujuan'];

        $idx2 = filter_input(INPUT_POST, 'idx2');
        $idx2 = explode(';', $idx2);
        foreach ($idx2 as $key => $idx2) {
            $temp = explode(',', $idx2);
            $idx = $temp[0];
            $tujuan[$idx] = $temp[1];

            $kkey = in_array($temp[1], $kd_unker_tujuan);

            if($kkey == false){
                $this->t_simas_model->del_data1('tb_disposisi', 'idx', $idx);
            }
        }

        //print_r($tujuan);

        //echo json_encode($tujuan);

        for($i=0;$i<count($kd_unker_tujuan);$i++){
            $data['kd_unker_tujuan'] = $kd_unker_tujuan[$i];
            $key = array_search($kd_unker_tujuan[$i], $tujuan);
            if($key !== false){
                $data['idx'] = $key;
                $this->t_simas_model->update_data1('tb_disposisi', $data, 'idx');
                //echo json_encode($data);
                //echo "update<br>";
            }else{
                unset($data['idx']);
                //echo json_encode($data);
                //echo "insert<br>";
                $this->t_simas_model->add_data1('tb_disposisi', $data, 'idx');
            }
        }

        redirect(base_url('index.php/simas/lihat/5'));
    }

    function tanda_terima($data){
        //$data['surat_keluar'] = $this->t_simas_model->load_singel('tb_surat','nomor_surat', $nomor_surat);
        $rdata['nomor_surat'] = $data['nomor_surat'];
        $rdata['tgl_surat'] = $data['tgl_surat'];
        $rdata['perihal'] = $data['perihal'];
        $rdata['kd_jns_surat'] = $data['kd_jns_surat'];
        $rdata['asal'] = $this->opd->desc;
        $data['qrcode'] = $this->print_qrcode->genQR($rdata);
        $this->load->view('tanda_terima', $data);
    }

    function hapus($idx){
        $this->t_simas_model->del_data('tb_surat', 'idx', $idx);
    }

    function hapus_disposisi(){
        $idx = filter_input(INPUT_POST, 'idx_to_delete');
        $idx = explode(',', $idx);
        for($i=0;$i<count($idx);$i++){
            $this->t_simas_model->del_data1('tb_disposisi', 'idx', $idx[$i]);
        }

        redirect(base_url('index.php/simas/lihat/5'));
    }

    function hapus_file($dir, $filename){
        $dir = FCPATH."asset/file_surat/".$dir;
        if(!unlink($dir.'/'.$filename)){
            echo "Masalah menghapus file ".$filename;
        }else{
            header('location: '.$_SERVER['HTTP_REFERER']);
        }
    }

    function hapus_pegawai($nip){
        $this->t_simas_model->del_data('tb_pegawai', 'nip', $nip);
    }

    function update_tgl_terima_disposisi(){
        $data['idx'] = filter_input(INPUT_POST, 'idx');
        $data['tgl_terima'] = filter_input(INPUT_POST, 'tgl_terima');
        $data['nm_penerima'] = filter_input(INPUT_POST, 'nm_penerima');

        $this->t_simas_model->update_data('tb_disposisi', $data, 'idx');
    }

    function getFile_List($dir){
        //$fileList = scandir($dir);
        $dir = FCPATH."asset/file_surat/".$dir;
        $images = array_map('basename', glob($dir.'/*.{jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF}', GLOB_BRACE));
        echo json_encode($images);
    }

    function upload_file_to_server(){
        $kd_jns = filter_input(INPUT_POST, 'kd_jns');
        $idx = filter_input(INPUT_POST, 'idx');
        $target_dir = FCPATH."/asset/file_surat/".$kd_jns.".".$idx."/";

        if ( ! is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "Surat telah di uploaded.<a href='".base_url('index.php/simas/lihat/').$kd_jns."'>Kembali</a><br>";
                echo "<img src='".base_url("/asset/file_surat/".$kd_jns.".".$idx."/").basename( $_FILES["fileToUpload"]["name"])."'\>";
            } else {
                echo "Ada Kesalahan dalam proses";
            }
        }
    }
}
