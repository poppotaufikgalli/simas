<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class T_simas_model extends CI_Model{
            
    function __construct() {
        parent::__construct();
    }
    
    function get_login_info($username){
        $this->db->where('uname',$username);
        $this->db->limit(1);
        $query = $this->db->get('tb_pegawai');
        return ($query->num_rows()>0) ? $query->row(): FALSE;
    }
    
    function load_singel($table_name, $p_key=null, $id=null){
        if ($p_key<>'' and $id <> ''){
            $this->db->where($p_key,$id);
        }
        $query = $this->db->get($table_name);
        return ($query->num_rows()>0) ? $query->row(): FALSE;
    }
    
    function load_singel_sql($sql){
        $query = $this->db->query($sql);
        //echo $sql;
        return ($query->num_rows()>0) ? $query->row(): FALSE;
    }
    
    function load_data($table_name, $p_key=null, $id=null, $order=null){
        if ($p_key<>'' and $id <> ''){
            $this->db->where($p_key,$id);
        }
        if ($order<>''){
            $this->db->order_by($order,'asc');
        }
        $query = $this->db->get($table_name);
        return ($query->num_rows()>0) ? $query->result(): FALSE;
    }

    function load_data_array($table_name, $array_dta=null, $order=null){
        if ($array_dta<>''){
            $this->db->where($array_dta);
        }
        if ($order<>''){
            $this->db->order_by($order,'asc');
        }
        $query = $this->db->get($table_name);
        return ($query->num_rows()>0) ? $query->result(): FALSE;
    }
    
    function load_data_sql($sql){
        $query = $this->db->query($sql);
        return ($query->num_rows()>0) ? $query->result(): FALSE;
    }

    function load_data_sql2($sql){
        $query = $this->db->query($sql);
        header('location: '.$_SERVER['HTTP_REFERER']);
        //return ($query->num_rows()>0) ? $query->result(): FALSE;
    }
            
    function add_data($table, $data, $p_key, $pkey1=null, $pkey2=null){
        $where = " WHERE ".$p_key." = '".$data[$p_key]."'";
        if ($pkey1<>null){
            $where = $where." and ".$pkey1." = '".$data[$pkey1]."'";
        }
        if ($pkey2<>null){
            $where = $where." and ".$pkey2." = '".$data[$pkey2]."'";
        }
        $query ="SELECT * FROM ".$table.$where;
        //echo $query; exit();
        $rv = $this->db->query($query);
        //echo $rv->num_rows();
        if ($rv->num_rows()>0){
            echo 'Penambahan Data Gagal, data dengan '.$p_key.' : '. $data[$p_key].' telah ada ';
            echo anchor($_SERVER['HTTP_REFERER'], "Kembali");
        } else {
            $this->db->insert($table, $data);
            //if($table<>'`group`' or $table <> 'group_akses'){
            //    header('location: '.$_SERVER['HTTP_REFERER']);
            //}
            header('location: '.$_SERVER['HTTP_REFERER']);
        }
    }


    function add_data1($table, $data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function add_data_refer($table, $data, $refer_page){
        $where = " WHERE ".$p_key." = '".$data[$p_key]."'";
        if ($pkey1<>null){
            $where = $where." and ".$pkey1." = '".$data[$pkey1]."'";
        }
        if ($pkey2<>null){
            $where = $where." and ".$pkey2." = '".$data[$pkey2]."'";
        }
        $query ="SELECT * FROM ".$table.$where;
        //echo $query; exit();
        $rv = $this->db->query($query);
        //echo $rv->num_rows();
        if ($rv->num_rows()>0){
            echo 'Penambahan Data Gagal, data dengan '.$p_key.' : '. $data[$p_key].' telah ada ';
            echo anchor($refer_page, "Kembali");
        } else {
            $this->db->insert($table, $data);
            if($refer_page<>''){
                header('location: '.$refer_page);
            }
            //header('location: '.base_url().'index.php/simrs/'.$page);
        }
    }

    function add_data3($table, $data, $p_key, $val){
        $where = " WHERE ".$p_key." = '".$val."'";
        
        $query ="SELECT * FROM ".$table.$where;
        //echo $query; exit();
        $rv = $this->db->query($query);
        //echo $rv->num_rows();
        if ($rv->num_rows()>0){
            echo 'Penambahan Data Gagal, data dengan '.$p_key.' : '. $val.' telah ada ';
            echo anchor($_SERVER['HTTP_REFERER'], "Kembali");
        } else {
            $this->db->insert($table, $data);
            if($table<>'`group`' or $table <> 'group_akses'){
                header('location: '.$_SERVER['HTTP_REFERER']);
            }
            //header('location: '.base_url().'index.php/simrs/'.$page);
        }
    }

    function add_data4($table, $data, $where){
        
        $query ="SELECT * FROM ".$table.$where;
        //echo $query; exit();
        $rv = $this->db->query($query);
        //echo $rv->num_rows();
        if ($rv->num_rows()>0){
            echo 'Penambahan Data Gagal, data telah ada ';
            echo anchor($_SERVER['HTTP_REFERER'], "Kembali");
        } else {
            $this->db->insert($table, $data);
            if($table<>'`group`' or $table <> 'group_akses'){
                header('location: '.$_SERVER['HTTP_REFERER']);
            }
            //header('location: '.base_url().'index.php/simrs/'.$page);
        }
    }
    
    function update_data($table, $data, $p_key){
        //echo $p_key.'....'.$id;
        $this->db->where($p_key,$data[$p_key]);
        $this->db->update($table, $data);
        //header('location: '.base_url().'index.php/baperjakat/open/'.$data['draft_id']);
        //if($table<>'`group`' or $table <> 'group_akses'){
            header('location: '.$_SERVER['HTTP_REFERER']);
        //}
    }

    function update_data1($table, $data, $p_key){
        //echo $p_key.'....'.$id;
        $this->db->where($p_key,$data[$p_key]);
        $this->db->update($table, $data);
    }

    function update_data2($table, $data, $refer_page, $p_key){
        //echo $p_key.'....'.$id;
        $this->db->where($p_key,$data[$p_key]);
        $this->db->update($table, $data);
        //header('location: '.base_url().'index.php/baperjakat/open/'.$data['draft_id']);
        if($refer_page<>''){
            header('location: '.$refer_page);
        }
    }

    function update_data3($table, $data, $p_key, $val){
        //echo $p_key.'....'.$id;
        $this->db->where($p_key, $val);
        $this->db->update($table, $data);
        //header('location: '.base_url().'index.php/baperjakat/open/'.$data['draft_id']);
        header('location: '.$_SERVER['HTTP_REFERER']);
    }

    function update_data4($table, $data, $where){
        //echo $p_key.'....'.$id;
        $this->db->where($where);
        $this->db->update($table, $data);
        //header('location: '.base_url().'index.php/baperjakat/open/'.$data['draft_id']);
        header('location: '.$_SERVER['HTTP_REFERER']);
    }

    function update_data5($table, $data, $refer_page, $where){
        //echo $p_key.'....'.$id;
        $this->db->where($where);
        $this->db->update($table, $data);
        //header('location: '.base_url().'index.php/baperjakat/open/'.$data['draft_id']);
        if($refer_page<>''){
            header('location: '.$refer_page);
        }
    }

    function update_data6($table, $data, $where){
        //echo $p_key.'....'.$id;
        $this->db->where($where);
        $this->db->update($table, $data);
        //header('location: '.base_url().'index.php/baperjakat/open/'.$data['draft_id']);
    }
    
    function del_data($table, $p_key, $id, $p_key2=null, $id2=null){
        $this->db->where($p_key, $id);
        if($p_key2<>'' || $id2<>''){
            $this->db->where($p_key2, $id2);
        }
        $this->db->delete($table);
        if($table<>'`group`' or $table <> 'group_akses'){
            header('location: '.$_SERVER['HTTP_REFERER']);
        }
        return TRUE;
    }

    function del_data1($table, $p_key, $id, $p_key2=null, $id2=null){
        $this->db->where($p_key, $id);
        if($p_key2<>'' || $id2<>''){
            $this->db->where($p_key2, $id2);
        }
        $this->db->delete($table);
        
        return TRUE;
    }

    function del_history($data){
        $this->db->insert('tb_del_history',$data);
    }

    function del_data2($table, $refer_page, $p_key, $id, $p_key2=null, $id2=null){
        $this->db->where($p_key, $id);
        if($p_key2<>'' || $id2<>''){
            $this->db->where($p_key2, $id2);
        }
        $this->db->delete($table);
        if($refer_page<>''){
            header('location: '.$refer_page);
        }
    }
    
    function del_data_wildcard($table, $p_key, $id){
        $this->db->like($p_key, $id);
        $this->db->delete($table);
        header('location: '.$_SERVER['HTTP_REFERER']);
        return TRUE;
    }

    function load_wilayah_op(){
        $sql = "SELECT a.`KD_PROPINSI`, d.`NM_PROPINSI`, CONCAT(a.`KD_PROPINSI`, ' (', d.`NM_PROPINSI`, ')') AS provinsi, a.`KD_DATI2`, c.`NM_DATI2`, CONCAT(c.`NM_DATI2`, ' (', a.`KD_DATI2`, ')') AS kab_kota, a.`KD_KECAMATAN`, b.`NM_KECAMATAN`, CONCAT(b.`NM_KECAMATAN`, ' (', a.`KD_KECAMATAN`, ')') AS kecamatan, a.`KD_KELURAHAN`, a.`KD_SEKTOR`, a.`NM_KELURAHAN`, CONCAT(a.`NM_KELURAHAN`,' (', a.`KD_KELURAHAN`,')') as kelurahan FROM ((ref_kelurahan a JOIN ref_kecamatan b ON (a.`KD_KECAMATAN`=b.`KD_KECAMATAN`)) JOIN ref_dati2 c ON (a.`KD_DATI2`=c.`KD_DATI2`)) JOIN ref_propinsi d ON (a.`KD_PROPINSI`=d.`KD_PROPINSI`) WHERE a.`KD_PROPINSI`= '21'";
        $query = $this->db->query($sql);
        return ($query->num_rows()>0) ? $query->result(): FALSE;
    }

    function load_blok_spop(){
        $sql = "SELECT KD_KECAMATAN, KD_KELURAHAN, KD_BLOK, MAX(NO_URUT) AS max_urut FROM spop GROUP BY KD_KECAMATAN, KD_KELURAHAN, KD_BLOK ORDER BY KD_KECAMATAN ASC, KD_KELURAHAN ASC, KD_BLOK ASC";
        $query = $this->db->query($sql);
        return ($query->num_rows()>0) ? $query->result(): FALSE;
    }

    function save_qr($table, $data, $p_key, $p_key1){
        $where = " WHERE ".$p_key." = '".$data[$p_key]."' AND ".$p_key1." = '".$data[$p_key1]."'";
        $query ="SELECT * FROM ".$table.$where;
        //echo $query; exit();
        $rv = $this->db->query($query);
        //echo $rv->num_rows();
        if ($rv->num_rows()>0){
            $this->db->where($p_key,$data[$p_key]);
            $this->db->where($p_key1,$data[$p_key1]);
            $this->db->update($table, $data);
        } else {
            $this->db->insert($table, $data);
        }

        $where = " WHERE \"print_date\"::DATE = '".date('Y-m-d')."'";
        $query ="SELECT * FROM ".$table.$where;
        //echo $query; exit();
        $rv = $this->db->query($query);

        return $rv->num_rows();
    }
}