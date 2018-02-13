                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <form id="frm_tambah" role="form" method="POST" action="<?Php echo base_url('index.php/simas/update_disposisi/'); ?>">
                                    <div class="form-group col-lg-1">
                                        <label>&nbsp;</label>
                                        <input type="hidden" id="ref_surat_masuk" name="ref_surat_masuk" class="form-control" required="" value="<?Php echo $disposisi->ref_surat_masuk; ?>">
                                        <input type="hidden" id="idx2" name="idx2" class="form-control" required="" value="<?Php echo $disposisi->idx2; ?>">
                                        <button type="button" id="btnCari" class="btn btn-outline btn-primary">Cari</button>
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label>Nomor Surat Masuk</label>
                                        <input type="text" id="nomor_surat" name="nomor_surat" class="form-control" disabled="">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Asal</label>
                                        <textarea id="asal" name="asal" class="form-control" rows="3" disabled=""></textarea>
                                    </div>
                                    <div class="form-group col-lg-5">
                                        <label>Perihal</label>
                                        <textarea id="tentang" name="tentang" class="form-control" rows="3" disabled=""></textarea>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label>Tanggal Disposisi</label>
                                        <input type="date" id="tgl_disposisi" name="tgl_disposisi" class="form-control" required="" value="<?Php echo date('Y-m-d',strtotime($disposisi->tgl_disposisi)); ?>">
                                    </div>
                                    <div class="form-group col-lg-9">
                                        <label>Isi</label>
                                        <textarea id="isi" name="isi" class="form-control" rows="3" required=""><?Php echo $disposisi->isi; ?></textarea>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label>Asal Bidang</label>
                                        <select id="kd_unker_asal" name="kd_unker_asal" class="form-control">
                                            <?Php 
                                                if(empty($unker)==false){
                                                    $ese = ['22', '31','32'];
                                                    foreach ($unker as $unker0) {
                                                        if(in_array($unker0->kese, $ese)==true){
                                                            if($unker0->nm_unker == 'Sekretariat'){
                                                                $nm_jab = 'Sekretaris';
                                                            }else{
                                                                $nm_jab = 'Kepala '.$unker0->nm_unker;
                                                            }

                                                            if($disposisi->kd_unker_asal == $unker0->kd_unker){
                                                                echo "<option value='".$unker0->kd_unker."' selected>".$nm_jab."</option>";
                                                            }else{
                                                                echo "<option value='".$unker0->kd_unker."'>".$nm_jab."</option>";
                                                            }
                                                        }
                                                    }
                                                }                                            
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Diteruskan Kepada</label>
                                        <?Php
                                            if(empty($unker)==false){
                                                $ese3 = ['31','32'];
                                                foreach ($unker as $unker3) {
                                                    if(in_array($unker3->kese, $ese3)==true){
                                                        if($unker3->nm_unker == 'Sekretariat'){
                                                            $nm_jab = 'Sekretaris';
                                                        }else{
                                                            $nm_jab = 'Kepala '.$unker3->nm_unker;
                                                        }

                                                        if(strpos($disposisi->disposisi, $unker3->kd_unker)>-1){
                                        ?>
                                        <div class="checkbox">
                                            <label>
                                                <input id="kd_unker_tujuan" name="kd_unker_tujuan[]" type="checkbox" checked="" value="<?Php echo $unker3->kd_unker ?>"><?Php echo $nm_jab; ?>
                                            </label>
                                        </div>
                                        <?Php
                                                        }else{
                                        ?>
                                        <div class="checkbox">
                                            <label>
                                                <input id="kd_unker_tujuan" name="kd_unker_tujuan[]" type="checkbox" value="<?Php echo $unker3->kd_unker ?>"><?Php echo $nm_jab; ?>
                                            </label>
                                        </div>
                                        <?Php
                                                        }
                                                    }
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="form-group col-lg-5">
                                        <label>Diteruskan Kepada</label>
                                        <?Php
                                            if(empty($unker)==false){
                                                $ese4 = ['41','42'];
                                                foreach ($unker as $unker4) {
                                                    if(in_array($unker4->kese, $ese4)==true){
                                                        if($unker4->nm_unker == 'Sekretariat'){
                                                            $nm_jab = 'Sekretaris';
                                                        }else{
                                                            $nm_jab = 'Kepala '.$unker4->nm_unker;
                                                        }

                                                        if(strpos($disposisi->disposisi, $unker4->kd_unker)>-1){
                                        ?>
                                        <div class="checkbox">
                                            <label>
                                                <input id="kd_unker_tujuan" name="kd_unker_tujuan[]" type="checkbox" checked="" value="<?Php echo $unker4->kd_unker ?>"><?Php echo $nm_jab; ?>
                                            </label>
                                        </div>
                                        <?Php
                                                        }else{
                                        ?>
                                        <div class="checkbox">
                                            <label>
                                                <input id="kd_unker_tujuan" name="kd_unker_tujuan[]" type="checkbox" value="<?Php echo $unker4->kd_unker ?>"><?Php echo $nm_jab; ?>
                                            </label>
                                        </div>
                                        <?Php
                                                        }
                                                    }
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="form-group col-lg-12 right">
                                        <button type="submit" class="btn btn-default btn-success">Update</button>
                                        <button type="button" id="btnBatal" class="btn btn-default">Batal</button>
                                    </div>
                                </form>
                                <!-- /.col-lg-12 -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="modal fade" id="modal_surat_masuk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-lg" role="document">
                         <div class="modal-content">
                            <div class="modal-header">
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                               <h4 class="modal-title" id="myModalLabel">Data Surat Masuk</h4>
                            </div>
                            <div class="modal-body">
                               <div class="row">
                                  <div class="col-md-12">
                                     <table width="100%" class="table table-striped table-hover" id="tbdata"> 
                                        <thead> 
                                           <tr> 
                                              <th>No</th> 
                                              <th>idx</th> 
                                              <th>Nomor Surat</th>
                                              <th>Tanggal</th>
                                              <th>Perihal</th>
                                              <th>Asal OPD</th>
                                              <th>Disposisi Terakhir Tgl.</th>
                                           </tr> 
                                        </thead> 
                                        <tbody> 
                                        </tbody> 
                                     </table>
                                  </div>
                               </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                         </div>
                      </div>
                   </div>

                <script type="text/javascript">
                    $(document).ready(function(){
                        cari_surat_terkait();
                    });

                    $('#btnBatal').on('click', function(){
                        window.history.go(-1);
                    });

                    $('#btnCari').on('click', function(){
                        $('#modal_surat_masuk').modal('show');
                        cariTabel();
                    });

                    function cariTabel()
                    {
                      var tbdata = $("#tbdata").DataTable({
                         "destroy": true,
                         "ajax":{
                            type   : "POST",
                            url   : "<?Php echo base_url();?>index.php/simas/cari/3",
                            //processData: false,
                            //data   : {tpel: tpel, snopel: snopel},
                         },
                         "columns": [
                            { "data": "no" },
                            { "data": "idx", visible: false},
                            { "data": "nomor_surat" },
                            { "data": "tgl_surat" },
                            { "data": "perihal" },
                            { "data": "asal" },
                            { "data": "disposisi" },
                           ]
                      });
                    }

                    $('#tbdata').on('click', 'td', function () {
                        var table = $(this).closest('table').DataTable();
                        $('#ref_surat_masuk').val(table.row($(this).closest('tr')).data()['idx']);
                        $('#nomor_surat').val(table.row($(this).closest('tr')).data()['nomor_surat']);
                        $('#asal').val(table.row($(this).closest('tr')).data()['asal']);
                        $('#tentang').val(table.row($(this).closest('tr')).data()['perihal']);
                        $('#modal_surat_masuk').modal('hide');                      
                    });

                    function cari_surat_terkait(){
                        var ref_surat_masuk = $('#ref_surat_masuk').val();
                        if(ref_surat_masuk !== ''){
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url();?>index.php/simas/cari_by_idx/",
                                data   : {kd_jns_surat: 3, idx: ref_surat_masuk},
                                success: function(json){ 
                                    try{  
                                        var obj = jQuery.parseJSON(json);
                                        console.log(obj);

                                        $('#nomor_surat').val(obj.nomor_surat);
                                        $('#asal').val(obj.asal);
                                        $('#tentang').val(obj.perihal);

                                    }catch(e) {  
                                        console.log(e);
                                    }  
                                },
                                error: function(){      
                                    console.log('data not found');
                                }
                            });
                        }
                    }
                </script>