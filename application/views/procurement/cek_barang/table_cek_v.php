<!-- BEGIN PAGE BREADCRUMB --> 

<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
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
                        <div class="row">
                            <div class="col-md-12">
                                <button id="id_Reload" style="display: none;"></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-3">
                                    <label>Mulai</label>
                                    <input type="text" required="" name="mulai" id="mulai" onchange="ddMulai(this.value)" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Sampai</label>
                                    <input type="text" required="" name="sampai" id="sampai" onchange="ddSampai(this.value)" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn blue" onclick="onLihat()">Lihat</button>
                            </div>

                            <div id="divBudget">
                                <div class="col-md-12" >
                                    <br>
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="table_cek_barang">
                                        <thead>
                                            <tr>
                                                <th>NO PO</th>     
                                                <th>NO PR</th>     
                                                <th>Tanggal Request</th>
                                                <th>Branch</th>
                                                <th>Status Akhir</th>
                                                <th>Status Cek</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                        <tfoot>


                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- end col-12 -->
                        </div>
            </div>

        </div>
    </div>
    <!-- END VALIDATION STATES-->
</div>
</div>


<!-- END PAGE CONTENT-->


<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('procurement/cek_barang/ias.js.php'); ?>

