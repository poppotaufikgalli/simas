<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access{
    public $user;
    
    /**
     * Constructor
     */
    function __construct() {
        $this->CI =& get_instance();
       
        $this->CI->load->model('t_simas_model');
        
        $this->t_simas_model = & $this->CI->t_simas_model;
    }
    
    function login($user, $password){
        $result = $this->t_simas_model->get_login_info($user);
        if ($result){
            $pass = $password;
            if ($pass == $result->password){
                $this->CI->session->set_userdata('uname',$result->nama);
                $this->CI->session->set_userdata('nip',$result->nip);
                $this->CI->session->set_userdata('kd_jab',$result->kd_jab);

                date_default_timezone_set("Asia/Jakarta");
                $last_login = date('Y-m-d h:i:sa');
                $this->CI->session->set_userdata('last_login',$last_login);
                
                return true;
             }
        }
        return false;
    }
    
    function check_token($user, $password){
        $result = $this->t_simas_model->get_login_info($user);
        if ($result){
            $pass = $password;
            if ($pass == $result->pass){
                $this->CI->session->set_userdata('uname',$result->nama);
                $this->CI->session->set_userdata('nip',$result->nip);
                $this->CI->session->set_userdata('kd_jab',$result->kd_jab);
                return true;
            }
        }
        return false;
    }
    
    /**
     * cek apakah sudah login
     */
    function is_login(){
        return (($this->CI->session->userdata('uid'))? TRUE : FALSE);
    }
    
    /**
     * logout
     */
    function logout(){
        $data['last_login'] = $this->CI->session->userdata('last_login');
        $data['nip'] =$this->CI->session->userdata('nip');
        $this->t_simas_model->update_data1('tb_akses', $data, 'nip');

        $this->CI->session->unset_userdata('uname');
        $this->CI->session->unset_userdata('nip');
        $this->CI->session->unset_userdata('kd_jab');
        $this->CI->session->unset_userdata('last_login');
    }

    function cekpass($user, $password){
        $result = $this->t_simas_model->get_login_info($user);
        if ($result){
            $pass = $password;
            //$pass = md5($password);
            if ($pass == $result->pass){
                return true;
            }   
        }
        return false;
    }
}
