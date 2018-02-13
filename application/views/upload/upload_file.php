                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <form id="frm_tambah" role="form" method="POST" action="<?Php echo base_url('index.php/simas/upload_file_to_server/').$jns_surat; ?>" enctype="multipart/form-data">
                                    <div class="form-group col-lg-1">
                                        <label>&nbsp;</label>
                                        <input type="hidden" id="idx" name="idx" class="form-control" required="" value="<?php if(empty($idx)==false){ echo $idx; } ?>">
                                        <input type="hidden" id="kd_jns" name="kd_jns" class="form-control" placeholder="Index Surat" required="" value="<?Php echo $jns_surat; ?>">
                                        <button type="button" id="btnCari" class="btn btn-outline btn-primary">Cari</button>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label>Nomor Surat</label>
                                        <input type="text" id="nomor_surat" name="nomor_surat" class="form-control" placeholder="" required="" disabled="">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label>Tanggal</label>
                                        <input type="date" id="tgl_surat" name="tgl_surat" class="form-control" placeholder="" disabled="">
                                    </div>
                                    <div class="form-group col-lg-5">
                                        <label>Perihal</label>
                                        <textarea id="perihal" name="perihal" class="form-control" rows="3" required="" disabled=""></textarea>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>File input</label>
                                        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" required="">
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
                    <div class="modal fade" id="modal_surat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-lg" role="document">
                         <div class="modal-content">
                            <div class="modal-header">
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                               <h4 class="modal-title" id="myModalLabel">Data <?Php echo $nm_menu; ?></h4>
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
                        reset_tgl();
                        cari_surat($('#kd_jns').val(),$('#idx').val());
                    });

                    $('#btnCari').on('click', function(){
                        $('#modal_surat').modal('show');
                        cariTabel();
                    });

                    function cariTabel()
                    {
                        var kd_jns = $('#kd_jns').val();
                        var tbdata = $("#tbdata").DataTable({
                            "destroy": true,
                            "ajax":{
                                type   : "POST",
                                url   : "<?Php echo base_url();?>index.php/simas/cari/"+kd_jns,
                            //processData: false,
                            //data   : {tpel: tpel, snopel: snopel},
                         },
                            "columns": [
                                { "data": "no" },
                                { "data": "idx", visible: false},
                                { "data": "nomor_surat" },
                                { "data": "tgl_surat" },
                                { "data": "perihal" },
                            ]
                        });
                    }

                    function cari_surat(kd_jns_surat, idx){
                        if((idx !== '') || (typeof idx !== "undefined")){
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url();?>index.php/simas/cari_by_idx/",
                                data   : {kd_jns_surat: kd_jns_surat, idx: idx},
                                success: function(json){ 
                                    try{  
                                        var obj = jQuery.parseJSON(json);
                                        console.log(obj);
                                        $('#idx').val(obj.idx);
                                        $('#nomor_surat').val(obj.nomor_surat);
                                        $('#tgl_surat').val(obj.tgl_surat);
                                        $('#perihal').val(obj.perihal);
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

                    $('#btnreset').on('click', function(){
                        $('#frm_tambah')[0].reset();
                        reset_tgl();
                    });

                    function reset_tgl(){
                        var date = new Date();
                        $('input[type=date]').val(date.toISOString().substr(0,10));
                    }

                    $('#fileToUpload').on('click', function(e){
                        var idx = $('#idx').val();
                        if((idx == '') || (typeof idx === "undefined")){
                            e.preventDefault();
                            alert('Pilih Surat Terlebih Dahulu !!')
                        }
                    })

                    $('#tbdata').on('click', 'td', function () {
                        var table = $(this).closest('table').DataTable();
                        var idx = table.row($(this).closest('tr')).data()['idx'];
                        
                        cari_surat($('#kd_jns').val(), idx);   
                        $('#modal_surat').modal('hide');              
                    });
                </script>