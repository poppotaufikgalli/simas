                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <form id="frm_tambah" role="form" method="POST" action="<?Php echo base_url('index.php/simas/update/').$surat->kd_jns_surat.'/'.$surat->idx; ?>">
                                    <div class="form-group col-lg-4">
                                        <label>Asal Pengumuman</label>
                                        <select id="asal1" name="asal1" class="form-control">
                                            <option value="0" <?Php if($surat->asal == "Walikota"){ echo "selected";}; ?>>Walikota</option>
                                            <option value="1" <?Php if($surat->asal == "Sekretaris Daerah"){ echo "selected";}; ?>>Sekretaris Daerah</option>
                                            <option value="2" <?Php if($surat->asal == "Kepala BPPRD"){ echo "selected";}; ?>>Kepala BPPRD</option>
                                            <option value="3" <?Php if($surat->asal == "Instansi lain"){ echo "selected";}; ?>>Instansi lain</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-8">
                                        <label>&nbsp;</label>
                                        <input type="text" id="asal" name="asal" class="form-control" placeholder="Asal Pengumuman" required="" value="<?Php echo $surat->asal; ?>">
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label>Nomor Urut</label>
                                        <input type="number" id="nomor_urut" name="nomor_urut" class="form-control" value="<?Php echo $surat->nomor_urut; ?>">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Nomor Pengumuman</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" id="set_number" name="set_number" <?Php if(empty($surat->nomor_surat)==false){ echo "checked"; } ?>>
                                            </span>
                                            <input type="text" id="nomor_surat" name="nomor_surat" class="form-control" required="" value="<?Php echo $surat->nomor_surat; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Tanggal Pengumuman</label>
                                        <input type="date" id="tgl_surat" name="tgl_surat" class="form-control" value="<?Php echo date('Y-m-d', strtotime($surat->tgl_surat)); ?>">
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>Isi Pengumuman</label>
                                        <textarea id="perihal" name="perihal" class="form-control" rows="8" required=""><?Php echo $surat->perihal; ?></textarea>
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

                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#set_number').change();
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

                    $('#btnBatal').on('click', function(){
                        window.history.go(-1);
                    });

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
                            if(value == false){
                                $('#nomor_urut').attr('disabled', true);
                                $('#nomor_urut').val('');
                            }else{
                                $('#nomor_urut').attr('disabled', false);
                                //max_number();
                            }
                        }else{
                            $('#nomor_urut').attr('disabled', true);
                            $('#nomor_urut').val('');
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