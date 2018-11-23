<input type="hidden" id="id_userName" value="<?php echo $this->session->userdata('user_name'); ?>">
<input type="hidden" id="id_posisi" value="<?php echo $this->session->userdata('posisi_desc'); ?>">
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
                <ul class="nav nav-pills">
                    <li class="linav active" id="linav1">
                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                            FPUR </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            FPUM </a>
                    </li>

                </ul> 
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <br>&nbsp;
                        <table class="table table-striped table-bordered table-hover text_kanan" id="table_fpur">
                            <thead>
                                <tr>
                                    <th>NO PR</th>  
                                    <th>No PO</th>   
                                    <th>Tanggal Request</th>
                                    <th>Request Name</th>
                                    <th>Project Name</th>
                                    <th>Branch</th>
                                    <th>Status Akhir</th>
                                    <th>Status Cek</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="tab_2_2">
                        <br>&nbsp;
                        <table class="table table-striped table-bordered table-hover text_kanan" id="table_fpum">
                            <thead>
                                <tr>
                                    <th>NO PR</th> 
                                    <th>No PO</th>    
                                    <th>Tanggal Request</th>
                                    <th>Request Name</th>
                                    <th>Project Name</th>
                                    <th>Branch</th>
                                    <th>Status Akhir</th>
                                    <th>Status Cek</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>
                </div>    
            </div>

        </div>
    </div>
    <!-- END VALIDATION STATES-->
</div>
</div>
<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('procurement/fpur/fpur.js.php'); ?>