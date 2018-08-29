<!-- BEGIN PAGE BREADCRUMB -->

<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <!-- KONTEN DI SINI YA -->
       <!--<img id="id_imgCR" src="<?php /* //echo base_url('metronic/img/rusun05.jpg'); */ ?>" alt=""/>-->
        <h3 class="font-grey-cascade">Dashboard <small>Stok cukai</small></h3>
    </div>

</div>
<!-- BEGIN ROW -->
<div class="row">
    <div class="col-md-12">
       
        <div class="row margin-top-10">
            
            <?php
            //$data['nama_storage'];
            foreach ($stok as $data) {
                ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-red-sunglo"><?php echo number_format($data['stok_avl'],2); ?><small class="font-green-sharp"></small></h3>
                                <small class="font-blue-chambray"><?php echo $data['nama_produk']; ?></small><br>
                                <small><?php echo $data['nama_storage']; ?></small>
                            </div>
                            <div class="icon">
                                <i class="icon-pie-chart"></i>
                            </div>
                        </div>
                        <div class="progress-info">
                            <div class="progress">
                                <span style="width: <?php echo $data['progress'] ?>%;" class="progress-bar progress-bar-success green-sharp">
                                    <span class="sr-only"><?php echo $data['progress'] ?>% progress</span>
                                </span>
                            </div>
                            <div class="status">
                                <div class="status-title font-blue-soft">
                                    capacity
                                </div>
                                <div class="status-number">
                                    <?php echo number_format($data['progress'],2) ?>%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?> 

        </div>
        <!-- BEGIN CHART PORTLET-->
<!--        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-green-haze"></i>
                    <span class="caption-subject bold uppercase font-grey-cascade"> Dashboard stok opname </span>
                    <span class="caption-helper">Rusun yang sudah disewa</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                    <a href="javascript:;" class="remove">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                 BEGIN PAGE CONTENT INNER 

                <div class="row">


                </div>


                 END PAGE CONTENT INNER 

            </div>
        </div>-->
        <!-- END CHART PORTLET-->
    </div>
</div>
<!-- END ROW -->

<!-- END PAGE CONTENT-->

<!--[if lt IE 9]>
<script src="<?php echo base_url('metronic/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php echo base_url('metronic/global/plugins/excanvas.min.js'); ?>"></script> 
<![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="<?php echo base_url('metronic/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('metronic/global/plugins/js.cookie.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('metronic/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo base_url('metronic/global/scripts/app.min.js'); ?>" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="<?php echo base_url('metronic/layouts/layout4/scripts/layout.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('metronic/layouts/layout4/scripts/demo.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('metronic/layouts/global/scripts/quick-sidebar.min.js'); ?>" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->