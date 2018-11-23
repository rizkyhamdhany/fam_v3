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
                            Request Tiket </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Up Tiket </a>
                    </li>
                    <li class="linav" id="linav3">
                        <a href="#tab_2_3" data-toggle="tab" id="navitab_2_3" class="anavitab">
                            Add PR to Inv </a>
                    </li>
                    <li class="linav" id="linav4">
                        <a href="#tab_2_4" data-toggle="tab" id="navitab_2_4" class="anavitab">
                            Set Termin </a>
                    </li>
                    <li class="linav" id="linav5">
                        <a href="#tab_2_5" data-toggle="tab" id="navitab_2_5" class="anavitab">
                            Payment </a>
                    </li>

                </ul> 
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <!--<div class="scroller" style="height:400px; ">-->
                        <div class="row">
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
                                                <th></th>
                                                <th>NO PR</th>     
                                                <th>Tanggal PR</th>
                                                <th>No SPD</th>
                                                <th>File SPD</th>
                                                <th>An Tiket</th>
                                                <th>Jenis Identitas</th>
                                                <th>No Identitas</th>
                                                <th>Asal</th>
                                                <th>Tujuan</th>
                                                <th>Kategori Perjalanan</th>
                                                <th>Tanggal Berangkat</th>
                                                <th>Tanggal Pulang</th>
                                                <th>Status Akhir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="checkbox" name="check"></td>
                                                <td>12</td>
                                                <td>12-12-2018</td>
                                                <td>1234</td>
                                                <td>Ada</td>
                                                <td>Susi</td>
                                                <td>KTP</td>
                                                <td>12343243432334</td>
                                                <td>JKT</td>
                                                <td>BDO</td>
                                                <td>PP</td>
                                                <td>12-12-2012</td>
                                                <td>12-12-2012</td>
                                                <td>Selesai</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" name="check"></td>
                                                <td>12</td>
                                                <td>12-12-2018</td>
                                                <td>1234</td>
                                                <td>Ada</td>
                                                <td>Susi</td>
                                                <td>KTP</td>
                                                <td>12343243432334</td>
                                                <td>JKT</td>
                                                <td>BDO</td>
                                                <td>PP</td>
                                                <td>12-12-2012</td>
                                                <td>12-12-2012</td>
                                                <td>Pending</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>


                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn blue" onclick="onLihat()">Pilih</button>
                            </div>
                            <!-- end col-12 -->
                        </div>
                        <!-- END ROW-->
                        <!--</div>-->
                    </div>
                    <div class="tab-pane fade" id="tab_2_2">
                        <!--<div class="scroller" style="height:400px; ">-->
                        <div class="row">
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
                                                <th>Tanggal PR</th>
                                                <th>No SPD</th>
                                                <th>File SPD</th>
                                                <th>An Tiket</th>
                                                <th>Jenis Identitas</th>
                                                <th>No Identitas</th>
                                                <th>Asal</th>
                                                <th>Tujuan</th>
                                                <th>Kategori Perjalanan</th>
                                                <th>Tanggal Berangkat</th>
                                                <th>Tanggal Pulang</th>
                                                <th>Status Akhir</th>
                                                <th>Tanggal Request</th>
                                                <th>Travel</th>
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
                                                <td>12343243432334</td>
                                                <td>JKT</td>
                                                <td>BDO</td>
                                                <td>PP</td>
                                                <td>12-12-2012</td>
                                                <td>12-12-2012</td>
                                                <td>Pending</td>
                                                <td>21-21-2012</td>
                                                <td></td>
                                                <td><a href="#" class="btn btn-xs btn-primary">Upload E-Tiket</a></td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>12-12-2018</td>
                                                <td>1234</td>
                                                <td>Ada</td>
                                                <td>Susi</td>
                                                <td>KTP</td>
                                                <td>12343243432334</td>
                                                <td>JKT</td>
                                                <td>BDO</td>
                                                <td>PP</td>
                                                <td>12-12-2012</td>
                                                <td>12-12-2012</td>
                                                <td>Pending</td>
                                                <td>21-21-2012</td>
                                                <td></td>
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
                    <div class="tab-pane fade" id="tab_2_3">
                        <!--<div class="scroller" style="height:400px; ">-->
                        <div class="row">
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
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="add">
                                        <thead>
                                            <tr>
                                                <th></th>     
                                                <th>NO PR</th>     
                                                <th>Tanggal PR</th>
                                                <th>No SPD</th>
                                                <th>File SPD</th>
                                                <th>An Tiket</th>
                                                <th>Jenis Identitas</th>
                                                <th>No Identitas</th>
                                                <th>Asal</th>
                                                <th>Tujuan</th>
                                                <th>Kategori Perjalanan</th>
                                                <th>Tanggal Berangkat</th>
                                                <th>Tanggal Pulang</th>
                                                <th>Status Akhir</th>
                                                <th>Tanggal Request</th>
                                                <th>Travel</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="checkbox" name="check"></td>
                                                <td>12</td>
                                                <td>12-12-2018</td>
                                                <td>1234</td>
                                                <td>Ada</td>
                                                <td>Susi</td>
                                                <td>KTP</td>
                                                <td>12343243432334</td>
                                                <td>JKT</td>
                                                <td>BDO</td>
                                                <td>PP</td>
                                                <td>12-12-2012</td>
                                                <td>12-12-2012</td>
                                                <td>Pending</td>
                                                <td>21-21-2012</td>
                                                <td></td>
                                                <td>
                                                    <a href="#" class="btn btn-xs btn-primary spd">SPD</a><a href="#" class="btn btn-xs btn-primary spd">Tiket</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" name="check"></td>
                                                <td>12</td>
                                                <td>12-12-2018</td>
                                                <td>1234</td>
                                                <td>Ada</td>
                                                <td>Susi</td>
                                                <td>KTP</td>
                                                <td>12343243432334</td>
                                                <td>JKT</td>
                                                <td>BDO</td>
                                                <td>PP</td>
                                                <td>12-12-2012</td>
                                                <td>12-12-2012</td>
                                                <td>Pending</td>
                                                <td>21-21-2012</td>
                                                <td></td>
                                                <td>
                                                    <a href="#" class="btn btn-xs btn-primary spd">SPD</a><a href="#" class="btn btn-xs btn-primary spd">Tiket</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>


                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn blue" onclick="onLihat()">Pilih</button>
                            </div>
                            <!-- end col-12 -->
                        </div>
                        <!-- END ROW-->
                        <!--</div>-->
                    </div>
                    <div class="tab-pane fade" id="tab_2_4">
                        <!--<div class="scroller" style="height:400px; ">-->
                        <div class="row">
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
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="set">
                                        <thead>
                                            <tr>
                                                <th></th>     
                                                <th>NO PR</th>     
                                                <th>Tanggal PR</th>
                                                <th>No SPD</th>
                                                <th>File SPD</th>
                                                <th>An Tiket</th>
                                                <th>Jenis Identitas</th>
                                                <th>No Identitas</th>
                                                <th>Asal</th>
                                                <th>Tujuan</th>
                                                <th>Kategori Perjalanan</th>
                                                <th>Tanggal Berangkat</th>
                                                <th>Tanggal Pulang</th>
                                                <th>Status Akhir</th>
                                                <th>Tanggal Request</th>
                                                <th>Travel</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="checkbox" name="check"></td>
                                                <td>12</td>
                                                <td>12-12-2018</td>
                                                <td>1234</td>
                                                <td>Ada</td>
                                                <td>Susi</td>
                                                <td>KTP</td>
                                                <td>12343243432334</td>
                                                <td>JKT</td>
                                                <td>BDO</td>
                                                <td>PP</td>
                                                <td>12-12-2012</td>
                                                <td>12-12-2012</td>
                                                <td>Pending</td>
                                                <td>21-21-2012</td>
                                                <td></td>
                                                <td>
                                                    <a href="#" class="btn btn-xs btn-primary spd">SPD</a><a href="#" class="btn btn-xs btn-primary spd">Tiket</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" name="check"></td>
                                                <td>12</td>
                                                <td>12-12-2018</td>
                                                <td>1234</td>
                                                <td>Ada</td>
                                                <td>Susi</td>
                                                <td>KTP</td>
                                                <td>12343243432334</td>
                                                <td>JKT</td>
                                                <td>BDO</td>
                                                <td>PP</td>
                                                <td>12-12-2012</td>
                                                <td>12-12-2012</td>
                                                <td>Pending</td>
                                                <td>21-21-2012</td>
                                                <td></td>
                                                <td>
                                                    <a href="#" class="btn btn-xs btn-primary spd">SPD</a><a href="#" class="btn btn-xs btn-primary spd">Tiket</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>


                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn blue" onclick="onLihat()">Pilih</button>
                            </div>
                            <!-- end col-12 -->
                        </div>
                        <!-- END ROW-->
                        <!--</div>-->
                    </div>
                    <div class="tab-pane fade" id="tab_2_5">
                        <!--<div class="scroller" style="height:400px; ">-->
                        <div class="row">
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
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="payment">
                                        <thead>
                                            <tr>
                                                <th>Invoice Group</th>     
                                                <th>Tanggal Invoice</th>
                                                <th>Jumlah PR</th>
                                                <th>Travel</th>
                                                <th>Jumlah Invoice</th>
                                                <th>Status Payment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>212</td>
                                                <td>21-12-2012</td>
                                                <td>21</td>
                                                <td>Trans</td>
                                                <td>13</td>
                                                <td>Pending</td>
                                            </tr>
                                            <tr>
                                                <td>212</td>
                                                <td>21-12-2012</td>
                                                <td>21</td>
                                                <td>Trans</td>
                                                <td>13</td>
                                                <td>Pending</td>
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
    $('#add').dataTable();
    $('#set').dataTable();
    $('#payment').dataTable();
</script>

