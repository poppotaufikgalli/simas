                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-striped table-hover" id="tbdata"> 
                                <thead> 
                                    <tr> 
                                        <th>No</th>
                                        <th>Asal OPD</th>
                                        <th>Nomor</th>
                                        <th>Tanggal</th>
                                        <th>Sifat</th>
                                        <th>Perihal</th>
                                        <th>Tanggal Terima</th>
                                        <th>Contact Person</th>
                                        <th>Disposisi</th>
                                        <th>eArsip</th>
                                        <th>Aksi</th>
                                    </tr> 
                                </thead> 
                                <tbody> 
                                    <?php
                                        if(empty($surat)==false){
                                            $c=1;
                                            foreach ($surat as $surat) {
                                                echo "<tr>";
                                                echo "<td>".$c."</td>";
                                                echo "<td>".$surat->asal."</td>";
                                                echo "<td>".$surat->nomor_surat."</td>";
                                                echo "<td>".$surat->tgl_surat."</td>";
                                                echo "<td>".$surat->sifat."</td>";
                                                echo "<td>".$surat->perihal."</td>";
                                                echo "<td>".$surat->tgl_terima."</td>";
                                                echo "<td>".$surat->cp."</td>";
                                                echo "<td>".$surat->disposisi."</td>";                                                
                                                echo "<td><div class='btn-group'>";
                                                if(empty($img[$surat->idx]) == false){
                                                    echo "<button onclick=\"gambar('".$surat->kd_jns_surat.'.'.$surat->idx."')\" class='btn btn-xs btn-success'><i class=\"fa fa-file-image-o fa-fw\"></i></button>";
                                                }
                                                echo "<button onclick=\"tambahgbr('".$surat->kd_jns_surat."','".$surat->idx."')\" class='btn btn-xs btn-primary'><i class=\"fa fa-plus fa-fw\"></i></button></div></td>";
                                                echo "<td><div class='btn-group'><button onclick=\"edit('".$surat->idx."')\" class='btn btn-xs btn-warning'><i class=\"fa fa-edit fa-fw\"></i></button><button onclick=\"hapus('".$surat->idx."','".$surat->nomor_surat."')\" class='btn btn-xs btn-danger'><i class=\"fa fa-trash-o fa-fw\"></i></button></div></td>";
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
                    <div class="modal fade" id="modal_gbr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-lg" role="document">
                         <div class="modal-content">
                            <div class="modal-header">
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                               <h4 class="modal-title" id="myModalLabel">File Surat</h4>
                            </div>
                            <div class="modal-body">
                               <div class="row">
                                  <div class="col-md-12 text-center" id="gambarnya"></div>
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
                        var tbdata = $("#tbdata").DataTable();
                    });

                    function hapus(idx, nomor_surat){
                        if(confirm('Apakah anda ingin mengapus Surat ini ?<br>Nomor Surat : '+nomor_surat +'?'))
                        {
                            location.href = "<?Php echo base_url() ?>index.php/simas/hapus/"+idx;
                        }
                    }

                    function gambar(dir){
                        //var FilesDirectory = '<?Php echo base_url('/asset'); ?>/file_surat/'+dir;
                        var dhtml ='';
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url();?>index.php/simas/getFile_List/"+dir,
                            success: function(json){ 
                                try{  
                                    var obj = jQuery.parseJSON(json);
                                    console.log(obj);

                                    $(obj).each(function(index, el) {
                                        dhtml = dhtml+ '<panel class="panel panel-success"><div class="panel-heading text-right"><a href="<?Php echo base_url()?>asset/file_surat/'+dir+'/'+obj[index]+'" class="btn btn-xs btn-success" target="_new"><i class="fa fa-print fa-fw"></i>Lihat Terpisah untuk Cetak </a><a href="<?Php echo base_url()?>asset/file_surat/'+dir+'/'+obj[index]+'" class="btn btn-xs btn-primary" download><i class="fa fa-download fa-fw"></i>Simpan </a><a href="<?Php echo base_url()?>index.php/simas/hapus_file/'+dir+'/'+obj[index]+'" class="btn btn-xs btn-danger"><i class="fa fa-trash-o fa-fw"></i>Hapus </a></div>'
                                        dhtml = dhtml+'<img width="800" src="<?Php echo base_url()?>asset/file_surat/'+dir+'/'+obj[index]+'"></img><br></panel>';
                                        $('#gambarnya').html(dhtml);
                                        //alert('<?Php echo base_url()?>asset/file_surat/'+dir+'/'+obj[index])
                                    });

                                }catch(e) {  
                                    console.log(obj);
                                }  
                            },
                            error: function(){      
                                console.log('data not found');
                            }
                        });

                        $('#modal_gbr').modal('show');
                    }

                    function tambahgbr(argument1, argument2) {
                        window.location.href = '<?Php echo base_url('index.php/simas/upload_file/') ?>'+argument1+'/'+argument2;
                    }

                    function edit(argument1){
                        window.location.href = '<?Php echo base_url('index.php/simas/edit/') ?>'+argument1;
                    }
                </script>