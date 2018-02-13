				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Lihat Data
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-hover" id="tbdata"> 
                                <thead> 
                                    <tr> 
                                        <th>No</th>
                                        <?Php 
                                            if(empty($field)==false){
                                                for($i=0; $i<count($field);$i++){
                                                    $header = ucwords(strtolower(str_replace('_', ' ', $field[$i])));
                                                    echo "<th>".$header."</th>";
                                                }
                                            }
                                        ?>
                                    </tr> 
                                </thead> 
                                <tbody> 
                                    <?php
                                        if(empty($surat)==false){
                                            $c=1;
                                            foreach ($surat as $surat) {
                                                echo "<tr>";
                                                echo "<td>".$c."</td>";
                                                if(empty($field)==false){
                                                    for($i=0; $i<count($field);$i++){
                                                        $header = $field[$i];
                                                        echo "<td>".$surat->$header."</td>";
                                                    }
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
                </div>

                <script type="text/javascript">

                    $(document).ready(function(){
                        var tbdata = $("#tbdata").DataTable();
                    });
                </script>