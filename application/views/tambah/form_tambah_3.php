                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <form id="frm_tambah" role="form" method="POST" action="<?Php echo base_url('index.php/simas/simpan/').$jns_surat; ?>">
                                    <div class="form-group col-lg-8">
                                        <label>Nomor Surat</label>
                                        <input type="text" id="nomor_surat" name="nomor_surat" class="form-control" placeholder="Masukkan Nomor Surat" required="">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Tanggal Surat</label>
                                        <input type="date" id="tgl_surat" name="tgl_surat" class="form-control" placeholder="Masukkan Tanggal Surat" required="">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Sifat Surat</label>
                                        <select id="sifat" name="sifat" class="form-control">
                                            <option value="1">1. Penting/Segera</option>
                                            <option value="2">2. Biasa</option>
                                            <option value="3">3. Tembusan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-lg-offset-4">
                                        <label>Tanggal Terima</label>
                                        <input type="date" id="tgl_terima" name="tgl_terima" class="form-control" placeholder="Masukkan Tanggal Terima Surat" required="">
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>Asal</label>
                                        <input type="text" id="asal" name="asal" class="form-control" placeholder="Masukkan Asal OPD Surat" required="">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Perihal</label>
                                        <textarea id="perihal" name="perihal" class="form-control" rows="4" required=""></textarea>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Contact Person / HP</label>
                                        <input type="text" id="cp" name="cp" class="form-control" placeholder="Masukkan Contak Person (jika ada)">
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
                        reset_tgl();
                    });

                    $('#btnreset').on('click', function(){
                        $('#frm_tambah')[0].reset();
                        reset_tgl();
                    });

                    function reset_tgl(){
                        var date = new Date();
                        $('input[type=Date]').val(date.toISOString().substr(0,10));
                    }
                </script>