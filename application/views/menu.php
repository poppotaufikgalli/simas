    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url() ?>">Sim AS - Sistem Informasi Manajemen Administrasi Surat v.1 (alpha)</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('index.php/simas/logout') ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <?php
                            $mn_akses = json_decode($akses->akses);

                            if(empty($menu)==false)
                            {
                                if(in_array(1, $mn_akses)==false){
                                    echo "<li>";
                                    echo "<a href='".base_url('index.php/simas/dashboard')."'><i class='fa fa-dashboard fa-fw'></i> Dashboard</a>";
                                    echo "</li>";
                                }
                                foreach ($menu as $menu1) {
                                    echo "<li>";
                                    if(in_array($menu1->idx, $mn_akses)==true){
                                        if($menu1->href !=='#')
                                        {
                                            echo "<a href='".base_url('index.php/simas/').$menu1->href."'><i class='".$menu1->icon."'></i> ".$menu1->nm_menu."</a>";
                                        }else{
                                            echo "<a href='".base_url('index.php/simas/').$menu1->href."'><i class='".$menu1->icon."'></i> ".$menu1->nm_menu."<span class=\"fa arrow\"></a>";
                                            echo "<ul class=\"nav nav-second-level\">";
                                            echo "<li>";
                                            echo "<a href='".base_url('index.php/simas/tambah/').$menu1->idx."'><i class=\"fa fa-plus fa-fw\"></i> Tambah ".$menu1->nm_menu."</a>";
                                            echo "</li>";
                                            echo "<li>";
                                            echo "<a href='".base_url('index.php/simas/upload_file/').$menu1->idx."'><i class=\"fa fa-file-image-o fa-fw\"></i> Upload File ".$menu1->nm_menu."</a>";
                                            echo "</li>";
                                            echo "<li>";
                                            echo "<a href='".base_url('index.php/simas/lihat/').$menu1->idx."'><i class=\"fa fa-th-list fa-fw\"></i> Lihat ".$menu1->nm_menu."</a>";
                                            echo "</li>";
                                            echo "</ul>";
                                        }
                                    }
                                    echo "</li>";
                                }
                            }
                        ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h1><?Php echo $title; ?></h1>
                </div>
                <div class="col-lg-6">
                    <br>
                    <div class="navbar navbar-default"> 
                        <div> 
                            <p class="navbar-text">Login as  
                                <a href="#" class="navbar-link"><?Php echo ucwords(strtolower($this->session->uname)); ?></a>
                            </p> 
                        </div> 
                        <div class="navbar-right"> 
                            <p class="navbar-text"><i>Last login : <?Php echo $akses->last_login; ?></i>&nbsp;&nbsp;&nbsp;
                            </p> 
                        </div> 
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            