                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <form id="frm_tambah" role="form" method="POST" action="<?Php echo base_url('index.php/simas/simpan/').$jns_surat; ?>">
                                    <div class="form-group col-lg-12">
                                        <label>Asal Bidang</label>
                                        <select id="asal_bidang" name="asal_bidang" class="form-control">
                                            <?Php 
                                                if(empty($unker)==false){
                                                    $ese = ['31','32'];
                                                    foreach ($unker as $unker) {
                                                        if(in_array($unker->kese, $ese)==true){
                                                            echo "<option value='".$unker->kd_unker."' data-kd_bidang='".$unker->kd_bidang."'>".$unker->nm_unker."</option>";
                                                        }
                                                    }
                                                }                                            
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label>Index</label>
                                        <input type="text" id="index_surat" name="index_surat" class="form-control" value="973" required="">
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label>Nomor Urut</label>
                                        <input type="number" id="nomor_urut" name="nomor_urut" class="form-control" placeholder="Nomor Urut" required="">
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label>Nomor Sisip</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" id="set_sisip" name="set_sisip">
                                            </span>
                                            <input type="text" id="nomor_sisip" name="nomor_sisip" class="form-control" placeholder="" readonly="">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label>Nomor Surat Keluar</label>
                                        <input type="text" id="nomor_surat" name="nomor_surat" class="form-control" placeholder="xxx/xxx/4.3.0x/<?Php echo date('Y') ?>" readonly="">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label>Tanggal Surat Keluar</label>
                                        <input type="date" id="tgl_surat" name="tgl_surat" class="form-control" placeholder="Masukkan Tanggal Surat" required="">
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>Tujuan Surat</label>
                                        <input type="text" id="tujuan" name="tujuan" class="form-control" placeholder="Tujuan OPD Surat" required="">
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>Perihal</label>
                                        <textarea id="perihal" name="perihal" class="form-control" rows="2" required=""></textarea>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Nomor Surat Masuk Terkait</label>
                                        <input type="hidden" id="ref_surat_masuk" name="ref_surat_masuk" class="form-control" placeholder="Index Surat" required="">
                                        <div class="input-group">
                                            <input type="text" id="ref_nomor_surat_masuk" name="ref_nomor_surat_masuk" class="form-control" placeholder="Nomor Surat Masuk Terkait" disabled="">
                                            <span class="input-group-btn">
                                                <button type="button" id="btnCari" class="btn btn-primary">Cari</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label>Nomor Nota Dinas</label>
                                        <input type="text" id="nomor_nodin" name="nomor_nodin" class="form-control" placeholder="Nomor Nota Dinas">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label>Tanggal Nota Dinas</label>
                                        <input type="date" id="tgl_nodin" name="tgl_nodin" class="form-control" placeholder="Nomor Surat">
                                    </div>
                                    <div class="form-group col-lg-12 right">
                                        <button type="submit" class="btn btn-default btn-success">Simpan</button>
                                        <button type="button" id="btnreset" class="btn btn-default">Ulangi</button>
                                    </div>
                                </form>
                                <!-- /.col-lg-12 -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                <div class="col-md-12 modal fade" id="modal_surat_masuk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        $('#asal_bidang').change();
                        reset_tgl();
                        max_number();
                    });

                    $('#btnreset').on('click', function(){
                        $('#frm_tambah')[0].reset();
                        $('#set_sisip').change();
                        max_number();
                        reset_tgl();
                    });

                    function reset_tgl(){
                        var date = new Date();
                        $('input[type=Date]').val(date.toISOString().substr(0,10));
                    }

                    function max_number(){
                        var nomor_urut = 0;
                        var asal = $('#asal').val();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url();?>index.php/simas/max_number/tb_surat/4",
                            success: function(json){ 
                                try{  
                                    var obj = jQuery.parseJSON(json);
                                    console.log(obj);

                                    nomor_urut = parseInt(obj.nomor_urut) + 1;
                                    $('#nomor_urut').val(nomor_urut);
                                    $('#nomor_urut').change();
                                }catch(e) {  
                                    console.log(obj);
                                }  
                            },
                            error: function(){      
                                console.log('data not found');
                            }
                        });
                    }

                    $('#nomor_urut').on('change', function(){
                        var date = new Date();
                        var thn = date.toISOString().substr(0,4);
                        var idx = $('#index_surat').val();
                        var kd_bidang = $('#asal_bidang option:selected').attr('data-kd_bidang');

                        var nomor_surat = $('#nomor_urut').val();
                        var nomor_sisip = $('#nomor_sisip').val();
                        if((nomor_surat>10)&&(nomor_surat<100)){
                            nomor_surat = '0'+nomor_surat;
                        }else if(nomor_surat<10){
                            nomor_surat = '00'+nomor_surat;
                        }
                        
                        if(nomor_sisip == ''){
                            $('#nomor_surat').val(idx+'/'+nomor_surat+'/'+kd_bidang+'/'+thn);
                        }else{
                            $('#nomor_surat').val(idx+'/'+nomor_surat+'.'+nomor_sisip+'/'+kd_bidang+'/'+thn);
                        }
                        
                        //$('#nomor_surat').val(nomor_urut);
                    });

                    $('#set_sisip').on('change', function(){
                        var value = $('#set_sisip').is(':checked');
                        $('#nomor_sisip').val('');
                        if(value == false){
                            $('#nomor_sisip').attr('readonly', true);
                        }else{
                            $('#nomor_sisip').attr('readonly', false);
                        }
                    });

                    $('#asal_bidang').on('change', function(){
                        $('#nomor_urut').change();
                    });

                    $('#index_surat').on('change', function(){
                        $('#nomor_urut').change();
                    });

                    $('#nomor_sisip').on('change', function(){
                        $('#nomor_urut').change();
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
                           ]
                      });
                    }

                    $('#tbdata').on('click', 'td', function () {
                        var table = $(this).closest('table').DataTable();
                        $('#ref_surat_masuk').val(table.row($(this).closest('tr')).data()['idx']);
                        $('#ref_nomor_surat_masuk').val(table.row($(this).closest('tr')).data()['nomor_surat']);
                        $('#modal_surat_masuk').modal('hide');                      
                    });
                </script>