                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <form id="frm_tambah" role="form" method="POST" action="<?Php echo base_url('index.php/simas/simpan/').$jns_surat; ?>">
                                    <div class="form-group col-lg-4">
                                        <label>Asal Pengumuman</label>
                                        <select id="asal1" name="asal1" class="form-control">
                                            <option value="0">Walikota</option>
                                            <option value="1">Sekretaris Daerah</option>
                                            <option value="2">Kepala BPPRD</option>
                                            <option value="3">Instansi lain</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-8">
                                        <label>&nbsp;</label>
                                        <input type="text" id="asal" name="asal" class="form-control" placeholder="Asal Pengumuman" required="">
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label>Nomor Urut</label>
                                        <input type="number" id="nomor_urut" name="nomor_urut" class="form-control" placeholder="Nomor urut (jika ada)">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Nomor Pengumuman</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" id="set_number" name="set_number" checked="">
                                            </span>
                                            <input type="text" id="nomor_surat" name="nomor_surat" class="form-control" placeholder="Masukkan Nomor Pengumuman (jika ada)" required="">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Tanggal Pengumuman</label>
                                        <input type="date" id="tgl_surat" name="tgl_surat" class="form-control" placeholder="Masukkan Tanggal Pengumuman">
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>Isi Pengumuman</label>
                                        <textarea id="perihal" name="perihal" class="form-control" rows="8" required=""></textarea>
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

                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#asal1').val(2).change();
                        $('#set_number').change();

                        reset_tgl();
                        max_number();
                    });

                    $('#asal1').on('change', function(){
                        var kd_asal = $('#asal1 option:selected').val();
                        var asal = $('#asal1 option:selected').text();
                        var value = $('#set_number').is(':checked');

                        switch(kd_asal){
                            case '0' :
                            case '1' :
                            case '2' :
                                $('#asal').val(asal);
                                break;
                            case '3' :
                                $('#asal').val('');
                                break;
                            default :
                                break;
                        }

                        check_disabled(value);
                    });

                    $('#btnreset').on('click', function(){
                        $('#frm_tambah')[0].reset();
                        $('#asal1').val(2).change();
                        reset_tgl();
                    });

                    function reset_tgl(){
                        var date = new Date();
                        $('input[type=date]').val(date.toISOString().substr(0,10));
                    }

                    function max_number(){
                        var nomor_urut = 0;
                        var asal = $('#asal1').val();
                        if(asal == 2){
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url();?>index.php/simas/max_number/tb_surat/2",
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
                    }

                    $('#set_number').on('change', function(){
                        var value = $('#set_number').is(':checked');
                        check_disabled(value);
                    });

                    function check_disabled(value){
                        var asal = $('#asal1').val();
                        if(asal == 2){
                            $('#nomor_surat').attr('readonly', true);
                            $('#nomor_surat').val('');
                            if(value == false){
                                $('#nomor_urut').attr('disabled', true);
                                $('#nomor_urut').val('');
                            }else{
                                $('#nomor_urut').attr('disabled', false);
                                max_number();
                            }
                        }else{
                            $('#nomor_urut').attr('disabled', true);
                            $('#nomor_urut').val('');
                            $('#nomor_surat').val('');
                            if(value == false){
                                $('#nomor_surat').attr('readonly', true);
                            }else{
                                $('#nomor_surat').attr('readonly', false);
                            }
                        }
                    }

                    $('#nomor_urut').on('change', function(){
                        var date = new Date();
                        var thn = date.toISOString().substr(0,4)

                        var nomor_surat = $('#nomor_urut').val();
                        if((nomor_surat>10)&&(nomor_surat<100)){
                            nomor_surat = '0'+nomor_surat;
                        }else if(nomor_surat<10){
                            nomor_surat = '00'+nomor_surat;
                        }
                        
                        $('#nomor_surat').val('973/Peng-'+nomor_surat+'/'+thn);
                        //$('#nomor_surat').val(nomor_urut);
                    });
                </script>