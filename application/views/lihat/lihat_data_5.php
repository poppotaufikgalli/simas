                    <?Php
                        function number_to_alphabet($number) {
                            $number = intval($number);
                            if ($number <= 0) {
                                return '';
                            }
                            $alphabet = '';
                            while($number != 0) {
                                $p = ($number - 1) % 26;
                                $number = intval(($number - $p) / 26);
                                $alphabet = chr(65 + $p) . $alphabet;
                            }
                            return $alphabet;
                        }
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-striped table-hover" id="tbdata"> 
                                <thead> 
                                    <tr>
                                        <th>No</th>
                                        <th width="30%">Disposisi</th>
                                        <th width="30%">Surat Masuk</th>
                                        <th width="30%">Tujuan</th>
                                        <th width="10%">Aksi</th>
                                    </tr> 
                                </thead> 
                                <tbody> 
                                    <?php
                                        if(empty($surat)==false){
                                            $c=1;
                                            foreach ($surat as $surat) {
                                                echo "<tr>";
                                                echo "<td>".$c."</td>";
                                                echo "<td><p><strong>".$surat->isi."</strong></p>";
                                                echo "<em>".$ref_unker[$surat->kd_unker_asal]."[".$surat->tgl_disposisi."]</em></td>";
                                                echo "<td>".$surat->surat_masuk."</td>";
                                                
                                                echo "<td><ul>";
                                                $dis = explode(';', $surat->disposisi);
                                                for($i=0;$i<count($dis);$i++){
                                                    $dis1 = explode(',', $dis[$i]);
                                                    if($dis1[2] == '-'){
                                                        $terima = '<br><button class="btn btn-xs btn-primary" onclick="terima(\''.$dis1[4].'\')">Update</button>';
                                                    }else{
                                                        $terima = '<br><em>'.$dis1[3].':'.$dis1[2].'</em>';
                                                    }
                                                    if($dis1[1] == '0'){
                                                        echo "<li><strong>".$ref_unker[$dis1[0]]."</strong>".$terima;
                                                    }else{
                                                        echo "<li>".$ref_unker[$dis1[0]].$terima;
                                                    }
                                                    echo "</li>";
                                                }
                                                echo "</ul></td>";
                                                echo "<td><div class='btn-group'><button onclick=\"edit('".$surat->idx."')\" class='btn btn-xs btn-warning'><i class=\"fa fa-edit fa-fw\"></i></button><button onclick=\"hapus('".$surat->idx."')\" class='btn btn-xs btn-danger'><i class=\"fa fa-trash-o fa-fw\"></i></button></div></td>";
                                                echo "</tr>";
                                                $c++;
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
                    <div class="modal fade" id="modal_terima" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-lg" role="document">
                         <div class="modal-content">
                            <div class="modal-header">
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                               <h4 class="modal-title" id="myModalLabel">Tanda Terima</h4>
                            </div>
                            <div class="modal-body">
                               <div class="row">
                                  <div class="col-md-12">
                                     <form id="frm_tambah" role="form" method="POST" action="<?Php echo base_url('index.php/simas/update_tgl_terima_disposisi') ?>">
                                        <div class="form-group col-lg-6">
                                            <label>Tanggal Terima</label>
                                            <input type="date" id="tgl_terima" name="tgl_terima" class="form-control" placeholder="Tanggal Terima" value="<?Php echo date('Y-m-d'); ?>" required="">
                                            <input type="hidden" id="idx" name="idx" class="form-control" required="">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Penerima</label>
                                            <input type="text" id="nm_penerima" name="nm_penerima" class="form-control" placeholder="Nama Terima" required="">
                                        </div>
                                        <div class="form-group col-lg-12 right">
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
                   <form id="frm_to_edit" role="form" method="POST" action="<?Php echo base_url('index.php/simas/edit_disposisi') ?>">
                       <input type="text" name="idx_to_edit" id="idx_to_edit">
                   </form>
                   <form id="frm_to_delete" role="form" method="POST" action="<?Php echo base_url('index.php/simas/hapus_disposisi') ?>">
                       <input type="hidden" name="idx_to_delete" id="idx_to_delete">
                   </form>
                <script type="text/javascript">

                    $(document).ready(function(){
                        var tbdata = $("#tbdata").DataTable();
                    });

                    function terima(idx){
                        $('#idx').val(idx);
                        $('#modal_terima').modal('show');
                    }

                    function hapus(idx){
                        $('#idx_to_delete').val(idx);
                        if(confirm('Apakah anda ingin mengapus Disposisi ini ?'))
                        {
                            $('#frm_to_delete').submit();
                        }
                    }

                    function edit(argument1){
                        $('#idx_to_edit').val(argument1);
                        $('#frm_to_edit').submit();
                    }
                </script>