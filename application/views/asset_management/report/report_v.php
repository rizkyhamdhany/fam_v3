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
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 control-label">Jenis</label>
                                    <div class="col-sm-6">
                                        <select class="form-control m-input" id="tipe">
                                            <option value="1">Sewa</option>
                                            <option value="2">Asset</option>
                                            <option value="3">Transaksi</option>
                                            <option value="4">Penilaian Vendor</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 control-label">Mulai</label>
                                    <div class="col-sm-6">
                                        <input type="text" required="" name="mulai" id="mulai" onchange="ddMulai(this.value)" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 control-label">Sampai</label>
                                    <div class="col-sm-6">
                                        <input type="text" required="" name="sampai" id="sampai" onchange="ddSampai(this.value)" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 sewa">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 control-label">Jenis Sewa</label>
                                    <div class="col-sm-6">
                                        <select class="form-control m-input">
                                            <option value="1">Pilih Sewa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 control-label">Payment Status</label>
                                    <div class="col-sm-6">
                                        <select class="form-control m-input">
                                            <option value="1">Pilih Status</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 control-label">Branch</label>
                                    <div class="col-sm-6">
                                        <select class="form-control m-input">
                                            <option value="1">Pilih Branch</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 asset" hidden>
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 control-label">Kategori Asset</label>
                                    <div class="col-sm-6">
                                        <select class="form-control m-input">
                                            <option value="1">Pilih Kategori</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 control-label">Payment Status</label>
                                    <div class="col-sm-6">
                                        <select class="form-control m-input">
                                            <option value="1">Pilih Status</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 control-label">Branch</label>
                                    <div class="col-sm-6">
                                        <select class="form-control m-input">
                                            <option value="1">Pilih Branch</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 control-label">Sisa Buki</label>
                                    <div class="col-sm-6">
                                        <select class="form-control m-input">
                                            <option value="1">Pilih</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 transaksi" hidden>
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 control-label">Branch</label>
                                    <div class="col-sm-6">
                                        <select class="form-control m-input">
                                            <option value="1">Pilih Branch</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 penilaian" hidden>
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 control-label">Zona</label>
                                    <div class="col-sm-6">
                                        <select class="form-control m-input">
                                            <option value="1">Pilih Zona</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn blue" onclick="onLihat()">Lihat</button>
                            </div>

                            <div id="divBudget" hidden>
                                <div class="col-md-12" >
                                    <br>
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="table">
                                        <thead>
                                            <tr>
                                                <th>NO PR</th>     
                                                <th>Tanggal Request</th>
                                                <th>Request Name</th>
                                                <th>Project Name</th>
                                                <th>Branch</th>
                                                <th>Status Akhir</th>
                                                <th>Status Cek</th>
                                                <th>No PO</th>
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
<script type="text/javascript">
    $( "#tipe" ).change(function() {
      if ($(this).val() == '1') {
        $('.sewa').show();
        $('.asset').hide();
        $('.transaksi').hide();
        $('.penilaian').hide();
      }else if($(this).val() == '2'){
        $('.sewa').hide();
        $('.asset').show();
        $('.transaksi').hide();
        $('.penilaian').hide();
      }else if($(this).val() == '3'){
        $('.sewa').hide();
        $('.asset').hide();
        $('.transaksi').show();
        $('.penilaian').hide();
      }else if($(this).val() == '4'){
        $('.sewa').hide();
        $('.asset').hide();
        $('.transaksi').hide();
        $('.penilaian').show();
      }
    });
</script>

