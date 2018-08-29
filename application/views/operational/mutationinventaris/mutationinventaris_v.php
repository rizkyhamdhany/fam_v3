<!-- BEGIN PAGE BREADCRUMB --> 

<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<style>
    .lunas
    {
        background-color: #66ff99 !important;
    }    
</style>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit  bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-red"></i>
                    <span class="caption-subject font-red sbold uppercase"><?php echo $menu_header; ?></span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <div class="scroller" style="height:400px; ">
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="id_Reload" style="display: none;"></button>
                                </div>
                            </div>
                            <div class="row">
                                <!--                                <div class="col-md-8">
                                                                    <a class="btn btn-sm btn-primary" href="#" id="btnAdd" data-toggle="modal" data-target="#myadd">Upload Budget</a>
                                                                    <a class="btn btn-sm btn-success" href="<?php echo base_url("/procurement/budget_capex/downloadWord"); ?>" download>Download Template Budget</a>
                                                                     <button class="btn btn-sm btn-default">Add Item Category</button> 
                                                                </div>-->
                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridMutation">
                                        <thead>
                                            <tr>
                                                <th>NO</th>     
                                                <th>Zone</th>
                                                <th>From (Branch - Division) To (Branch/Division)</th>                
                                                <th>Inventaris ID</th>
                                                <th>Item Name</th>
                                                <th>QTY</th>                
                                                <th>QR Code</th>

                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                        <tfoot>


                                        </tfoot>
                                    </table>
                                </div>
                                <!-- end col-12 -->
                            </div>
                            <!-- END ROW-->
                        </div>
                    </div>
                </div>    
            </div>

        </div>
    </div>
    <!-- END VALIDATION STATES-->
</div>
</div>



<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('operational/mutationinventaris/mutationinventaris.js.php'); ?>

