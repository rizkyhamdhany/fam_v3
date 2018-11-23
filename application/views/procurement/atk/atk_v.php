<!-- BEGIN PAGE BREADCRUMB --> 

<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<style type="text/css">
    .table .spd{
        margin-top: 2px;
    }
</style>
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
                            PR Grup </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            PR Divisi </a>
                    </li>
                </ul> 
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <!--<div class="scroller" style="height:400px; ">-->
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                    <div class="visual">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="1449">1449</span>
                                        </div>
                                        <div class="desc"> PR Group </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                    <div class="visual">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="549">549</span>
                                        </div>
                                        <div class="desc"> PR Group-Onproses </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                    <div class="visual">
                                        <i class="fa fa-bar-chart-o"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="12,5">123</span> </div>
                                        <div class="desc"> PR Group-Done </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-12">
                                <?php if($this->session->flashdata('success')): ?>
                                    <div class="alert alert-success">
                                        <strong>Success!</strong> <?php echo $this->session->flashdata('success');?> 
                                    </div>
                                <?php endif ?>
                                <?php if($this->session->flashdata('error')): ?>
                                    <div class="alert alert-danger">
                                        <strong>Error!</strong> <?php echo $this->session->flashdata('error');?> 
                                    </div>
                                <?php endif ?>
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
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="request">
                                        <thead>
                                            <tr>
                                                <th>NO PR Group</th>     
                                                <th>Tanggal PR Group</th>
                                                <th>Tipe Request</th>
                                                <th>Nama Category</th>
                                                <th>Nama Project</th>
                                                <th>Branch</th>
                                                <th>Divisi</th>
                                                <th>Status Akhir</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>12</td>
                                                <td>12-12-2018</td>
                                                <td>1234</td>
                                                <td>Ada</td>
                                                <td>JKT</td>
                                                <td>BDO</td>
                                                <td>PP</td>
                                                <td>Selesai</td>
                                                <td><a href="#" class="btn btn-xs btn-primary">Aksi</a></td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>12-12-2018</td>
                                                <td>1234</td>
                                                <td>Ada</td>
                                                <td>JKT</td>
                                                <td>BDO</td>
                                                <td>PP</td>
                                                <td>Selesai</td>
                                                <td><a href="#" class="btn btn-xs btn-primary">Aksi</a></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>


                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- end col-12 -->
                        </div>
                        <!-- END ROW-->
                        <!--</div>-->
                    </div>
                    <div class="tab-pane fade" id="tab_2_2">
                        <!--<div class="scroller" style="height:400px; ">-->
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                    <div class="visual">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="1449">1449</span>
                                        </div>
                                        <div class="desc"> Jumlah PR Masuk </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                    <div class="visual">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="549">549</span>
                                        </div>
                                        <div class="desc"> Jumlah PR Tergroup </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                    <div class="visual">
                                        <i class="fa fa-bar-chart-o"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="12,5">123</span> </div>
                                        <div class="desc"> Jumlah PR Belum Tergroup </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-12">
                                <?php if($this->session->flashdata('success')): ?>
                                    <div class="alert alert-success">
                                        <strong>Success!</strong> <?php echo $this->session->flashdata('success');?> 
                                    </div>
                                <?php endif ?>
                                <?php if($this->session->flashdata('error')): ?>
                                    <div class="alert alert-danger">
                                        <strong>Error!</strong> <?php echo $this->session->flashdata('error');?> 
                                    </div>
                                <?php endif ?>
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
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="up">
                                        <thead>
                                            <tr>
                                                <th>NO PR</th>     
                                                <th>Tanggal Request</th>
                                                <th>No PR Group</th>
                                                <th>Tanggal PR Group</th>
                                                <th>Tipe Request</th>
                                                <th>Nama Category</th>
                                                <th>Nama Project</th>
                                                <th>Branch</th>
                                                <th>Divisi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>12</td>
                                                <td>12-12-2018</td>
                                                <td>1234</td>
                                                <td>Ada</td>
                                                <td>Susi</td>
                                                <td>KTP</td>
                                                <td>JKT</td>
                                                <td>BDO</td>
                                                <td>PP</td>
                                                <td><a href="#" class="btn btn-xs btn-primary">Upload E-Tiket</a></td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>12-12-2018</td>
                                                <td>1234</td>
                                                <td>Ada</td>
                                                <td>Susi</td>
                                                <td>KTP</td>
                                                <td>JKT</td>
                                                <td>BDO</td>
                                                <td>PP</td>
                                                <td><a href="#" class="btn btn-xs btn-primary">Upload E-Tiket</a></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>


                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- end col-12 -->
                        </div>
                        <!-- END ROW-->
                        <!--</div>-->
                    </div>
                </div>    
            </div>

        </div>
    </div>
    <!-- END VALIDATION STATES-->
</div>
</div>


<!-- END PAGE CONTENT-->

<?php $this->load->view('app.min.inc.php'); ?>
<script>
    $('#request').dataTable();
    $('#up').dataTable();
</script>

