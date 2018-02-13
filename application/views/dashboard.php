            <style type="text/css">
                .timeline-override {
                  position: relative;
                  padding: 0px 0px 0px 20px;
                  list-style: none;
                }
                 .timeline-override:before {
                  content: "";
                  position: absolute;
                  top: 0;
                  bottom: 0;
                  /*left: 50%;*/
                  width: 3px;
                  /*margin-left: -1.5px;*/
                  background-color: #eeeeee;
                }
                .timeline-override > li {
                  position: relative;
                  margin-bottom: 10px;
                }
                .timeline-override > li:before,
                .timeline-override > li:after {
                  content: " ";
                  display: table;
                }
                .timeline-override > li:after {
                  clear: both;
                }
                .timeline-override > li:before,
                .timeline-override > li:after {
                  content: " ";
                  display: table;
                }
                .timeline-override > li:after {
                  clear: both;
                }
                .timeline-override > li > .timeline-override-panel {
                  float: left;
                  position: relative;
                  /*width: 46%;*/
                  width: 94%;
                  padding: 10px;
                  border: 1px solid #d4d4d4;
                  border-radius: 2px;
                  -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
                  box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
                }
                .timeline-override > li > .timeline-override-panel:before {
                  content: " ";
                  display: inline-block;
                  position: absolute;
                  top: 26px;
                  right: -15px;
                  border-top: 15px solid transparent;
                  border-right: 0 solid #ccc;
                  border-bottom: 15px solid transparent;
                  border-left: 15px solid #ccc;
                }
                .timeline-override > li > .timeline-override-panel:after {
                  content: " ";
                  display: inline-block;
                  position: absolute;
                  top: 27px;
                  right: -14px;
                  border-top: 14px solid transparent;
                  border-right: 0 solid #fff;
                  border-bottom: 14px solid transparent;
                  border-left: 14px solid #fff;
                }
                .timeline-override > li > .timeline-override-badge {
                  z-index: 100;
                  position: absolute;
                  top: 16px;
                  /*left: 50%;*/
                  width: 50px;
                  height: 50px;
                  margin-left: -25px;
                  border-radius: 50% 50% 50% 50%;
                  text-align: center;
                  font-size: 1.4em;
                  line-height: 50px;
                  color: #fff;
                  background-color: #999999;
                }
                .timeline-override > li.timeline-override-inverted > .timeline-override-panel {
                  float: right;
                }
                .timeline-override > li.timeline-override-inverted > .timeline-override-panel:before {
                  right: auto;
                  left: -15px;
                  border-right-width: 15px;
                  border-left-width: 0;
                }
                .timeline-override > li.timeline-override-inverted > .timeline-override-panel:after {
                  right: auto;
                  left: -14px;
                  border-right-width: 14px;
                  border-left-width: 0;
                }
                .timeline-override-badge.primary {
                  background-color: #2e6da4 !important;
                }
                .timeline-override-badge.success {
                  background-color: #3f903f !important;
                }
                .timeline-override-badge.warning {
                  background-color: #f0ad4e !important;
                }
                .timeline-override-badge.danger {
                  background-color: #d9534f !important;
                }
                .timeline-override-badge.info {
                  background-color: #5bc0de !important;
                }
                .timeline-override-title {
                  margin-top: 0;
                  color: inherit;
                }
                .timeline-override-body > p,
                .timeline-override-body > ul {
                  margin-bottom: 0;
                }
                .timeline-override-body > p + p {
                  margin-top: 5px;
                }
                @media (max-width: 767px) {
                  ul.timeline-override:before {
                    left: 40px;
                  }
                  ul.timeline-override > li > .timeline-override-panel {
                    width: calc(10%);
                    width: -moz-calc(10%);
                    width: -webkit-calc(10%);
                  }
                  ul.timeline-override > li > .timeline-override-badge {
                    top: 16px;
                    left: 15px;
                    margin-left: 0;
                  }
                  ul.timeline-override > li > .timeline-override-panel {
                    float: right;
                  }
                  ul.timeline-override > li > .timeline-override-panel:before {
                    right: auto;
                    left: -15px;
                    border-right-width: 15px;
                    border-left-width: 0;
                  }
                  ul.timeline-override > li > .timeline-override-panel:after {
                    right: auto;
                    left: -14px;
                    border-right-width: 14px;
                    border-left-width: 0;
                  }
            </style>
            <div class="row">
                <?Php
                    if(empty($dashboard_akses)==false){
                        $sel_dashboard = 1;
                        if(empty($menu)==false){
                            foreach ($menu as $menu2) {
                                if($menu2->lvl == 1){
                ?>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-<?Php echo $menu2->color; ?>">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa <?Php echo $menu2->icon; ?> fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?Php if(empty($rekap[$menu2->idx])==false) {echo $rekap[$menu2->idx];}else{ echo "0"; } ?></div>
                                    <div><?Php echo $menu2->nm_menu; ?></div>
                                </div>
                            </div>
                        </div>
                        <a href="<?Php echo base_url('index.php/simas/lihat/').$menu2->idx; ?>">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <?Php
                                }
                            }
                        }
                    }else{
                        $sel_dashboard = 0;
                    } 
                ?>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Lini Masa
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="timeline-override">
                                <?Php 
                                    if(empty($surat)==false){
                                        $jml_surat = array(2=>0,0,0,0);
                                        foreach ($surat as $surat) {
                                            $kd_jns_surat = $surat->kd_jns_surat;
                                            $jml_surat[$kd_jns_surat] = $jml_surat[$kd_jns_surat] + 1;
                                            if(($kd_jns_surat == 3)&&($sel_dashboard !== 1)){
                                                if(in_array($surat->kd_jns_surat, $sel_jns_surat)){
                                ?>
                                <li class='timeline-override-inverted'>
                                    <div class="timeline-override-badge <?Php echo $surat->color2; ?>"><i class="fa <?Php echo $surat->icon; ?> small"></i>
                                    </div>
                                    <div class="timeline-override-panel">
                                        <div class="timeline-override-heading">
                                            <h4 class="timeline-override-title">Perihal : <?Php echo $surat->perihal; ?> <small class="text-muted pull-right"><em><?Php echo $surat->nm_menu; ?> <i class="fa fa-clock-o"></i> <?Php echo $surat->tgl_surat; ?></em></small></h4>
                                        </div>
                                        <div class="timeline-override-body">
                                            Disposisi : <?Php echo $surat->isi; ?>
                                        </div>
                                        <img class="img img-responsive" width="30%" src="<?Php echo base_url('asset/img/no_avatar.jpg'); ?>">
                                    </div>
                                </li>
                                <?Php
                                                }
                                            }else{
                                                if(in_array($surat->kd_jns_surat, $sel_jns_surat)){
                                ?>
                                <li class='timeline-override-inverted'>
                                    <div class="timeline-override-badge <?Php echo $surat->color2; ?>"><i class="fa <?Php echo $surat->icon; ?> small"></i>
                                    </div>
                                    <div class="timeline-override-panel">
                                        <div class="timeline-override-heading">
                                            <h4 class="timeline-override-title"><?Php echo $surat->perihal; ?> <small class="text-muted pull-right"><em><?Php echo $surat->nm_menu; ?> <i class="fa fa-clock-o"></i> <?Php echo $surat->tgl_surat; ?></em></small></h4>
                                        </div>
                                        <div class="timeline-override-body">
                                            <?Php echo $surat->isi; ?>
                                        </div>
                                    </div>
                                </li>
                                <?Php
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

                <div class="col-lg-8">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Lini Masa 2
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="timeline-override" id="linimasa">
                                
                            </ul>
                            <button type="button" id="btnSelanjutnya" class="btn btn-default btn-block">Selanjutnya</button>
                            <input type="text" name="offset" id="offset" value="0">
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Notifikasi
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <?Php
                                    if(empty($menu)==false){
                                        foreach ($menu as $menu_panel) {
                                            if($menu_panel->lvl == 1){
                                                if(($menu_panel->idx == 5) && ($sel_dashboard !==1)){
                                                    break;
                                                }
                                ?>
                                <a href="<?Php echo base_url('index.php/simas/dashboard/').$menu_panel->idx; ?>" class="list-group-item">
                                    <i class="<?php echo $menu_panel->icon; ?>"></i> <?Php echo $menu_panel->nm_menu; ?>
                                    <span class="pull-right text-muted small"><em><?Php if(empty($jml_surat[$menu_panel->idx])==false){ echo $jml_surat[$menu_panel->idx];}else{ echo 0;} ?></em>
                                    </span>
                                </a>
                                <?Php
                                            }
                                        }
                                    } 
                                ?>
                            </div>
                            <!-- /.list-group -->
                            <a href="<?Php echo base_url('index.php/simas/dashboard/'); ?>" class="btn btn-default btn-block">Lihat Semua</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="chat-panel panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i> Chat
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu slidedown">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-refresh fa-fw"></i> Refresh
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-check-circle fa-fw"></i> Available
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-times fa-fw"></i> Busy
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-clock-o fa-fw"></i> Away
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-sign-out fa-fw"></i> Sign Out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="chat">
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 12 mins ago
                                            </small>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                        <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 13 mins ago</small>
                                            <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 14 mins ago</small>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                        <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 15 mins ago</small>
                                            <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <div class="input-group">
                                <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-chat">
                                        Send
                                    </button>
                                </span>
                            </div>
                        </div>
                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function(){

                });

                function getTimeline(offset){
                    var timeline = $('#linimasa').html();
                    var linimasa = "";
                    $.get("<?php echo base_url();?>index.php/simas/getTimeline/"+offset, function(data){
                        var obj = jQuery.parseJSON(data);
                        console.log(obj);

                        if(obj !== false){
                            $.each(obj, function(i, item){
                                //console.log(item.idx);
                                if(item.kd_jns_surat == 3){
                                    linimasa = linimasa + "<li class='timeline-override-inverted'><div class=\"timeline-override-badge "+item.color2+"\"><i class=\""+item.icon+"\"></i></div><div class=\"timeline-override-panel\"><div class=\"timeline-override-heading\"><h4 class=\"timeline-override-title\"> Perihal : "+item.perihal+"<small class=\"text-muted pull-right\"><em> Disposisi "+item.nm_menu+" <i class=\"fa fa-clock-o\"></i> "+item.tgl_surat+"</em></small></h4></div><div class=\"timeline-override-body\">Disposisi : "+item.isi+"</div></div></li>";
                                }else{
                                    linimasa = linimasa + "<li class='timeline-override-inverted'><div class=\"timeline-override-badge "+item.color2+"\"><i class=\""+item.icon+"\"></i></div><div class=\"timeline-override-panel\"><div class=\"timeline-override-heading\"><h4 class=\"timeline-override-title\">"+item.perihal+"<small class=\"text-muted pull-right\"><em>"+item.nm_menu+" <i class=\"fa fa-clock-o\"></i> "+item.tgl_surat+"</em></small></h4></div><div class=\"timeline-override-body\">"+item.isi+"</div></div></li>";
                                }
                                
                            });
                            $('#linimasa').html(timeline + linimasa);
                        }else{
                            $('#btnSelanjutnya').addClass('hide');
                        }
                    })
                    /*$.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>index.php/simas/getTimeline/"+offset,
                        //data   : {idx: ref_surat_masuk, kd_jns_surat: 3},
                        success: function(json){ 
                            try{  
                                var obj = jQuery.parseJSON(json);
                                console.log(obj);

                                if(obj == false){
                                    $('#btnSelanjutnya').addClass('hide');
                                }

                                //$('#ref_nomor_surat_masuk').val(obj.nomor_surat);

                            }catch(e) {  
                                console.log(e);
                            }  
                        },
                        error: function(){      
                            console.log('data not found');
                        }
                    });*/
                }

                $('#btnSelanjutnya').on('click', function(){
                    var offset = parseInt($('#offset').val());
                    getTimeline(offset);
                    $('#offset').val(offset+5);
                });
            </script>