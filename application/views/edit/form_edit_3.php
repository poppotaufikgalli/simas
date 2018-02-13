                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <form id="frm_tambah" role="form" method="POST" action="<?Php echo base_url('index.php/simas/update/').$surat->kd_jns_surat.'/'.$surat->idx; ?>">
                                    <div class="form-group col-lg-8">
                                        <label>Nomor Surat</label>
                                        <input type="text" id="nomor_surat" name="nomor_surat" class="form-control" required="" value="<?Php echo $surat->nomor_surat ?>">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Tanggal Surat</label>
                                        <input type="date" id="tgl_surat" name="tgl_surat" class="form-control" value="<?Php echo date('Y-m-d', strtotime($surat->tgl_surat)); ?>">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Sifat Surat</label>
                                        <select id="sifat" name="sifat" class="form-control">
                                            <option value="1" <?Php if($surat->sifat == 1){ echo "selected";}; ?>>1. Penting/Segera</option>
                                            <option value="2" <?Php if($surat->sifat == 2){ echo "selected";}; ?>>2. Biasa</option>
                                            <option value="3" <?Php if($surat->sifat == 3){ echo "selected";}; ?>>3. Tembusan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-lg-offset-4">
                                        <label>Tanggal Terima</label>
                                        <input type="date" id="tgl_terima" name="tgl_terima" class="form-control" required="" value="<?Php echo date('Y-m-d', strtotime($surat->tgl_terima)); ?>">
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>Asal</label>
                                        <input type="text" id="asal" name="asal" class="form-control" placeholder="Masukkan Asal OPD Surat" required="" value="<?Php echo $surat->asal; ?>">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Perihal</label>
                                        <textarea id="perihal" name="perihal" class="form-control" rows="4" required=""><?Php echo $surat->perihal; ?></textarea>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Contact Person / HP</label>
                                        <input type="text" id="cp" name="cp" class="form-control" placeholder="Masukkan Contak Person (jika ada)"value="<?Php echo $surat->cp; ?>">
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

                    });

                    $('#btnBatal').on('click', function(){
                        window.history.go(-1);
                    });

                </script>