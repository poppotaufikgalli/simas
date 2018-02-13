<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Print_QrCode{
    //public $qrcode;
    
    /**
     * Constructor
     */
    function __construct() {
        $this->CI =& get_instance();
        //$auth = $this->CI->config->item('auth');
        
        //$this->CI->load->helper('cookie');
        //$this->CI->load->model('t_simas_model');
        $this->CI->load->library('ciqrcode');
        
        //$this->t_simas_model = & $this->CI->t_simas_model;
        $this->ciqrcode = & $this->CI->ciqrcode;
    }

    function genQR($rdata){
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        //$config['imagedir']     = './assets/images/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        
        $this->ciqrcode->initialize($config);

        
        $params['data'] = json_encode($rdata);
        $params['level'] = 'M';
        $params['size'] = 2;
        $params['savename'] = FCPATH.'\asset\img\qrImg_'.$rdata['kd_jns_surat'].'.png';
        $this->ciqrcode->generate($params);

        return $rdata['kd_jns_surat'];
        //echo '<img src="'.base_url().'tes.png" />';
        //echo json_encode($qrcode); 
    }
}
