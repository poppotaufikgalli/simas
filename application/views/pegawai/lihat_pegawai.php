                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-striped table-hover" id="tbdata"> 
                                <thead> 
                                    <tr> 
                                        <th>No</th>
                                        <th>Nama/TTL</th>
                                        <th>NIP</th>
                                        <th>Jabatan / TMT</th>
                                        <th>Pangkat / TMT</th>
                                        <th>Masa Kerja</th>
                                        <th>TMT KGB</th>
                                        <th width="10%">Aksi</th>
                                        <th>Login</th>
                                    </tr> 
                                </thead> 
                                <tbody> 
                                    <?php
                                        if(empty($pegawai)==false){
                                            $c=1;
                                            foreach ($pegawai as $pegawai) {
                                                echo "<tr>";
                                                echo "<td>".$c."</td>";
                                                $nama = $pegawai->nama;
                                                if(empty($pegawai->glr_dpn)==false){
                                                    $nama = $pegawai->glr_dpn.". ".$nama;
                                                }

                                                if(empty($pegawai->glr_blk)==false){
                                                    $nama = $nama.", ".$pegawai->glr_blk;
                                                }

                                                echo "<td>".$nama."<br>".$pegawai->tmpt_lhr.", ".date('d-m-Y', strtotime($pegawai->tgl_lhr))."</td>";
                                                echo "<td align='center'>".$pegawai->nip."</td>";
                                                $nm_jab = $unker[$pegawai->kd_jab];
                                                echo "<td>".$nm_jab."<br>TMT : ".date('d-m-Y', strtotime($pegawai->tmt_jab))."</td>";
                                                echo "<td align='center'>".$pangkat[$pegawai->kd_pangkat]."<br>TMT : ".date('d-m-Y', strtotime($pegawai->tmt_pangkat))."</td>";
                                                 if($pegawai->mk_bln < 0){
                                                    $thn = ($pegawai->mk_thn - 1) + $pegawai->pmk_thn;
                                                    $bln = (12 + $pegawai->mk_bln) + $pegawai->pmk_bln;
                                                }else{
                                                    $thn = $pegawai->mk_thn + $pegawai->pmk_thn;
                                                    $bln = $pegawai->mk_bln + $pegawai->pmk_bln;
                                                }
                                                echo "<td>".$thn." th ".$bln." bl</td>";
                                                echo "<td align='center'>".date('d-m-Y', strtotime($pegawai->tmt_kgb))."</td>";
                                                echo "<td><div class='btn-group'><button onclick=\"profil('".$pegawai->nip."','".$pegawai->nip."')\" class='btn btn-xs btn-success'><i class=\"fa fa-user fa-fw\"></i></button><button onclick=\"hapus('".$pegawai->nip."','".$pegawai->nama."')\" class='btn btn-xs btn-danger'><i class=\"fa fa-trash-o fa-fw\"></i></button></div></td>";
                                                if(empty($pegawai->uname)==true){
                                                    echo "<td><div class='btn-group'><button onclick=\"account('".$pegawai->nip."')\" class='btn btn-xs btn-default'><i class=\"fa fa-key fa-fw\"></i></button></div></td>";
                                                }else{
                                                    echo "<td><div class='btn-group'><button onclick=\"account('".$pegawai->nip."')\" class='btn btn-xs btn-warning'><i class=\"fa fa-key fa-fw\"></i></button></div></td>";
                                                }
                                                $c++;
                                                echo "</tr>";
                                            }
                                        }
                                    ?>
                                </tbody> 
                             </table>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                    <div class="modal fade" id="modal_profil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                       <div class="modal-dialog modal-lg" role="document">
                         <div class="modal-content">
                            <div class="modal-header">
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                               <h4 class="modal-title" id="myModalLabel">Profil Tambah / Edit</h4>
                            </div>
                            <div class="modal-body">
                               <div class="row">
                                  <div class="col-md-12">
                                     <form id="frm_tambah" enctype="multipart/form-data" role="form" method="POST">
                                        <div class="form-group col-lg-3">
                                            <img id="foto" class="img img-circle img-responsive" src="<?php echo base_url('/asset/img/no_avatar.jpg'); ?>" >
                                        </div>
                                        <div class="form-group col-lg-9">
                                            <ul class="nav nav-tabs"> 
                                                <li class="active"><a href="#umum" data-toggle="tab">Data Umum</a></li> 
                                                <li><a href="#cpns" data-toggle="tab">CPNS</a></li> 
                                                <li><a href="#pangkat" data-toggle="tab">Pangkat</a></li> 
                                                <li><a href="#jab" data-toggle="tab">Jabatan</a></li> 
                                                <li><a href="#lain" data-toggle="tab">Lain-lain</a></li> 
                                            </ul> 
                                        </div>
                                        <div id="myTabContent" class="form-group col-lg-9 tab-content">
                                            <div class="row tab-pane fade in active" id="umum">
                                                <input type="hidden" id="id" name="id" class="form-control">
                                                <div class="col-lg-3">
                                                    <label>Nama</label>
                                                    <input type="text" id="glr_dpn" name="glr_dpn" class="form-control" placeholder="Gelar Depan">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>&nbsp;</label>
                                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" required="">
                                                </div>
                                                <div class="col-lg-3">
                                                    <label>&nbsp;</label>
                                                    <input type="text" id="glr_blk" name="glr_blk" class="form-control" placeholder="Gelar Belakang">
                                                </div>
                                                <div class="col-lg-12">
                                                    <label>NIP</label>
                                                    <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP/NRPTT/NOSC" required="">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Tempat Lahir</label>
                                                    <input type="text" id="tmpt_lhr" name="tmpt_lhr" class="form-control" placeholder="Tempat Lahir" required="">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Tanggal Lahir</label>
                                                    <input type="date" id="tgl_lhr" name="tgl_lhr" class="form-control" required="">
                                                </div>
                                            </div>
                                            <div class="row tab-pane fade in" id="cpns">
                                                <div class="col-lg-6">
                                                    <label>Pangkat CPNS</label>
                                                    <select id="kd_pangkat_cpns" name="kd_pangkat_cpns" class="form-control">
                                                        <?Php
                                                            if(empty($pangkat)==false){
                                                                foreach ($pangkat as $key => $value) {
                                                                    echo "<option value='".$key."'>".$value."</option>";
                                                                }
                                                            } 
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>TMT CPNS</label>
                                                    <input type="date" id="tmt_cpns" name="tmt_cpns" class="form-control" required="">
                                                </div>
                                                <div class="col-lg-3">
                                                    <label>Masa Kerja Tahun</label>
                                                    <input type="number" id="cpns_ms_thn" name="cpns_ms_thn" class="form-control" required="" placeholder="Tahun" value="0">
                                                </div>
                                                <div class="col-lg-3">
                                                    <label>Masa Kerja Bulan</label>
                                                    <input type="number" id="cpns_ms_bln" name="cpns_ms_bln" class="form-control" required="" placeholder="Bulan" value="0">
                                                </div>
                                            </div>
                                            <div class="row tab-pane fade in" id="pangkat">
                                                <div class="col-lg-6">
                                                    <label>Pangkat Terakhir</label>
                                                    <select id="kd_pangkat" name="kd_pangkat" class="form-control">
                                                        <?Php
                                                            if(empty($pangkat)==false){
                                                                foreach ($pangkat as $key => $value) {
                                                                    echo "<option value='".$key."'>".$value."</option>";
                                                                }
                                                            } 
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>TMT</label>
                                                    <input type="date" id="tmt_pangkat" name="tmt_pangkat" class="form-control" required="">
                                                </div>
                                            </div>
                                            <div class="row tab-pane fade in" id="jab">
                                                <div class="col-lg-8">
                                                    <label>Jabatan</label>
                                                    <select id="kd_jab" name="kd_jab" class="form-control">
                                                        <?Php
                                                            if(empty($unker)==false){
                                                                foreach ($unker as $key => $value) {
                                                                    echo "<option value='".$key."'>".$value."</option>";
                                                                }
                                                            } 
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label>TMT</label>
                                                    <input type="date" id="tmt_jab" name="tmt_jab" class="form-control" required="">
                                                </div>
                                            </div>
                                            <div class="row tab-pane fade in" id="lain">
                                                <div class="col-lg-4">
                                                    <label>TMT KGB</label>
                                                    <input type="date" id="tmt_kgb" name="tmt_kgb" class="form-control" required="">
                                                </div>
                                                <div class="col-lg-3">
                                                    <label>Peny. MK Tahun</label>
                                                    <input type="number" id="pmk_thn" name="pmk_thn" class="form-control" required="" placeholder="Tahun" value="0">
                                                </div>
                                                <div class="col-lg-3">
                                                    <label>Peny. MK BUlan</label>
                                                    <input type="number" id="pmk_bln" name="pmk_bln" class="form-control" required="" placeholder="Bulan" value="0">
                                                </div>
                                                <div class="col-lg-10">
                                                    <label>Photo</label>
                                                    <input type="file" id="profilPic" name="profilPic" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12 right">
                                            <button id="btnSimpan" name="btnSimpan" type="submit" class="btn btn-default btn-success">Simpan</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                    </div>
                    <div class="modal fade" id="modal_account" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                       <div class="modal-dialog modal-lg" role="document">
                         <div class="modal-content">
                            <div class="modal-header">
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                               <h4 class="modal-title" id="myModalLabel">Account / Akses</h4>
                            </div>
                            <div class="modal-body">
                               <div class="row">
                                  <div class="col-md-12">
                                     <form id="frm_acc" role="form" method="POST" action="<?Php echo base_url('index.php/simas/akses') ?>">
                                        <div class="form-group col-lg-5">
                                            <label>Username</label>
                                            <input type="text" id="uname" name="uname" class="form-control" placeholder="Username" required="">
                                            <input type="hidden" id="nip_akses" name="nip_akses" class="form-control" required="">
                                        </div>
                                        <div class="form-group col-lg-5">
                                            <label>Password</label>
                                            <input type="text" id="password" name="password" class="form-control" placeholder="password" required="">
                                        </div>
                                        <div class="form-group col-lg-2">
                                            <label>Akses Menu</label>
                                            <?Php
                                                if(empty($menu)==false){
                                                    foreach ($menu as $menu) {
                                                        echo "<div class=\"checkbox\"><label>";
                                                        echo "<input type='checkbox' id='menu' name='menu[]' value='".$menu->idx."'> ".$menu->nm_menu;
                                                        echo "</label></div>";
                                                    }
                                                }
                                            ?>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <button type="submit" class="btn btn-default btn-success">Update</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                    </div>
                <script src="<?Php echo base_url('/asset') ?>/vendor/datatables/js/dataTables.buttons.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function(){
                        var tbdata = $("#tbdata").DataTable({
                            dom: 'Bfrtip',
                            buttons: [
                                {
                                    text: '<i class="fa fa-plus fa-fw"></i>Tambah',
                                    className: 'btn btn-xs btn-primary',
                                    action: function ( e, dt, node, config ) {
                                        $('#btnSimpan').html('Tambah');
                                        $('#modal_profil').modal('show');
                                        $('#frm_tambah')[0].reset();
                                        $('#frm_tambah').attr('action', '<?Php echo base_url('index.php/simas/tambah_pegawai') ?>');
                                    }
                                }
                            ]
                        });
                    });

                    function hapus(argument1, argument2){
                        if(confirm('Apakah anda ingin mengapus data ini ?\nNIP : '+argument1 +'\nNama : '+argument2))
                        {
                            location.href = "<?Php echo base_url() ?>index.php/simas/hapus_pegawai/"+argument1;
                        }
                    }

                    function profil(argument1){
                        $('#frm_tambah')[0].reset();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url();?>index.php/simas/getProfil/"+argument1,
                            success: function(json){ 
                                try{  
                                    var obj = jQuery.parseJSON(json);
                                    //console.log(obj);
                                    $('#id').val(obj.id);
                                    $('#glr_dpn').val(obj.glr_dpn);
                                    $('#nama').val(obj.nama);
                                    $('#glr_blk').val(obj.glr_blk);
                                    $('#jns_kepeg').val(obj.jns_kepeg).change;
                                    $('#nip').val(obj.nip);
                                    $('#tmpt_lhr').val(obj.tmpt_lhr);
                                    $('#tgl_lhr').val(obj.tgl_lhr);
                                    $('#kd_pangkat').val(obj.kd_pangkat).change;
                                    $('#tmt_pangkat').val(obj.tmt_pangkat);
                                    $('#kd_pangkat_cpns').val(obj.kd_pangkat_cpns).change;
                                    $('#tmt_cpns').val(obj.tmt_cpns);
                                    $('#kd_jab').val(obj.kd_jab).change;
                                    $('#tmt_jab').val(obj.tmt_jab);
                                    $('#tmt_kgb').val(obj.tmt_kgb);
                                    $('#pmk_thn').val(obj.pmk_thn);
                                    $('#pmk_bln').val(obj.pmk_bln);
                                    $('#cpns_ms_thn').val(obj.cpns_ms_thn);
                                    $('#cpns_ms_thn').val(obj.cpns_ms_thn);
                                    
                                }catch(e) {  
                                    console.log(e);
                                }  
                            },
                            error: function(){      
                                console.log('data not found');
                            }
                        });
                        $('#btnSimpan').html('Update');
                        $('#modal_profil').modal('show');
                        $('#frm_tambah').attr('action', '<?Php echo base_url('index.php/simas/update_pegawai') ?>')
                    }

                    function account(argument1){
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url();?>index.php/simas/getProfil/"+argument1,
                            success: function(json){ 
                                try{  
                                    var obj = jQuery.parseJSON(json);
                                    //console.log(obj);
                                    $('#id_akses').val(obj.id);
                                    $('#nip_akses').val(obj.nip);
                                    $('#uname').val(obj.uname);
                                    $('#password').val(obj.password);
                                    
                                }catch(e) {  
                                    console.log(e);
                                }  
                            },
                            error: function(){      
                                console.log('data not found');
                            }
                        });
                        
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url();?>index.php/simas/getAkses/"+argument1,
                            success: function(json){ 
                                try{  
                                    var obj = jQuery.parseJSON(json);

                                    var akses = obj[0].akses;
                                    akses = JSON.parse(akses);
                                    
                                    $(akses).each(function(index, el) {
                                        $('input[type=checkbox][value='+akses[index]+']').prop('checked', true);
                                        //console.log(el);
                                    });
                                    
                                }catch(e) {  
                                    console.log(e);
                                }  
                            },
                            error: function(){      
                                console.log('data not found');
                            }
                        });
                        

                        $('#modal_account').modal('show');
                    }
                </script>