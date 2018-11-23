<!-- BEGIN PAGE BREADCRUMB -->

<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs  font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">PO</span>
                </div>
                <div class="tools">
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <span id="event_result">

                    </span>
                </div>
                <ul class="nav nav-pills">
                    <li class="linav active" id="linav1">
                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                            Data PO </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Form PO</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
            <div class="visual">
                <i class="fa fa-comments"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="1449">1449</span>
                </div>
                <div class="desc"> Jumlah PR & PA </div>
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
                <div class="desc"> PO Keluar </div>
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
                <div class="desc"> PO Pending </div>
            </div>
        </a>
    </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="id_Reload" style="display: none;"></button>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 2%;">
                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan"
                                           id="idTablePo">
                                        <thead>
                                            <tr>                                     
                                                <th>
                                                    No PR
                                                </th>
                                                <th>
                                                    Tanggal Request
                                                </th>
                                                <th>
                                                    Request Type
                                                </th>
                                                <th>
                                                    Category Name
                                                </th>
                                                <th>
                                                    Name Project
                                                </th>
                                                <th>
                                                    Branch
                                                </th>
                                                <th>
                                                    Divisi
                                                </th>
                                                <th>
                                                    Status Akhir
                                                </th>
                                                <th>
                                                    Catatan
                                                </th>
                                                <th>
                                                    Aksi
                                                </th>
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
                    <div class="tab-pane fade" id="tab_2_2">
                        <form role="form"  method="post" id="id_from_sec_group_user"  action="<?php echo base_url('sec_group_user/home'); ?>">
                            <div class="form-group m-form__group m--margin-top-10">
                    <h5 class="m-portlet__head-text"><strong>Detail PR</strong></h5>
                </div>
                <div class="form-horizontal col-md-12">
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">No PR</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">1234</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Tanggal PR</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">1234</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Request Type</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">1234</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Branch</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">1234</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Category Name</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">1234</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Divisi</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">1234</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Nama Project</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">1234</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Periode</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">1234</p>
                        </div>
                    </div>
                    
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-4">
                        <label for="example-text-input" class="col-2 col-form-label">Total HPS</label>
                        <div class="col-2">
                            <input class="form-control m-input" type="text" value="2.000.000" id="example-text-input" readonly>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="example-text-input" class="col-2 col-form-label">Total Item</label>
                        <div class="col-2">
                            <input class="form-control m-input" type="text" value="3" id="example-text-input" readonly>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="example-text-input" class="col-2 col-form-label">Total Item</label>
                        <div class="col-2">
                            <input class="form-control m-input" type="text" value="30" id="example-text-input" readonly>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Item Name</th>
                                <th scope="col">Item Type</th>
                                <th scope="col">QTY</th>
                                <th scope="col">Total HPS</th>
                                <th scope="col">HPS/Item</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" colspan="5">Example data</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-12">
                        <label class="col-sm-2 col-form-label">Prioritas</label>
                        <div class="m-radio-inline col-sm-6">
                            <button type="button" class="btn btn-success" id="m_blockui_2_1">Lihat</button>
                            <button type="button" class="btn btn-brand" id="m_blockui_2_1">Download</button>
                            <button type="button" class="btn btn-primary" id="m_blockui_2_1">Upload</button>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label class="col-sm-2 col-form-label">Prioritas</label>
                        <div class="m-radio-inline col-sm-6">
                            <label class="m-radio">
                            <input type="radio" name="example_3" value="1"> Prioritas
                            <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label class="col-sm-2 col-form-label">Kelengkapan</label>
                        <div class="m-radio-inline col-sm-6">
                            <label class="m-radio">
                            <input type="radio" name="example_3" value="1"> Lengkap
                            <span></span>
                            </label>
                            <label class="m-radio">
                            <input type="radio" name="example_3" value="1"> Tidak Lengkap
                            <span></span>
                            </label>

                        </div>
                    </div>
                    
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Tipe Pembayaran</label>
                        <div class="col-sm-6">
                            <select class="form-control m-input" id="exampleSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Jenis Pengadaan</label>
                        <div class="col-sm-6">
                            <select class="form-control m-input" id="exampleSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleTextarea" class="col-sm-2 col-form-label">Catatan</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Tipe Pembayaran</label>
                        <div class="col-sm-6">
                            <select class="form-control m-input" id="exampleSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">PIC</label>
                        <div class="col-sm-6">
                            <select class="form-control m-input" id="exampleSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body col-md-12">
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Jenis Pengadaan</label>
                        <div class="col-sm-8">
                            <select class="form-control m-input" id="exampleSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">BOD</label>
                        <div class="col-sm-8">
                            <select class="form-control m-input" id="exampleSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nama Vendor</th>
                                <th scope="col">Wilayah</th>
                                <th scope="col">Status WP</th>
                                <th scope="col">Barang & Jasa</th>
                                <th scope="col">Harga Penawaran</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" colspan="6">Example data</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Nama Pemenang</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Nama Pemenang">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Harga Penawaran</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Harga Penawaran">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Scoring</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Dokumen Lain-lain</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp">
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group m--margin-top-10">
                    <h5 class="m-portlet__head-text"><strong>PA</strong></h5>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">No PA</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="123455">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">PA Approval</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YGT">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YTH">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YPP">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Approval">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Approval">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Textbox">
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group m--margin-top-10">
                    <h5 class="m-portlet__head-text"><strong>Cek Anggaran</strong></h5>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Sisa Anggaran</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Sisa Anggaran">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Anggaran Terpakai</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Anggaran Terpakai">
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Entity PNM</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">LOB</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Main Account</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Divisi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Sub Account</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Business Type</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp">
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">COA</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="COA">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Anggaran</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Anggaran Terpakai">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">PA Approval</label>
                        <div class="col-sm-6">
                            <select class="form-control m-input" id="exampleSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Budget Disetujui</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Status">
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group m--margin-top-10">
                    <h5 class="m-portlet__head-text"><strong>BMWP BOD</strong></h5>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">No PA</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="123455">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">BOD Approval</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YGT">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YTH">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YPP">
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Approval">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Approval">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Textbox">
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group m--margin-top-10">
                    <h5 class="m-portlet__head-text"><strong>PO</strong></h5>
                </div>
                <div class="m-portlet__body col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nama Dokumen</th>
                                <th scope="col">No Dokumen</th>
                                <th scope="col">Validasi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" colspan="4">Example data</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="m-portlet__body col-md-12">
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Jumlah Barang</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Jumlah Barang">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Jenis Barang</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Jenis Barang">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Sub Total</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Sub Total">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">PPN</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="PPN">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Disc</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Disc">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">PPH</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="PPH">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Total</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Total">
                    </div>
                </div>
                <div class="form-group m-form__group m--margin-top-10">
                        <h5 class="m-portlet__head-text"><strong>Sewa Barang dan Bangunan</strong></h5>
                </div>
                <div class="m-portlet__body col-md-12">
                    <div class="form-group m-form__group col-md-2">
                        <label for="exampleInputtext1">Barang/Bangunan</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Barang/Bangunan">
                    </div>
                    <div class="form-group m-form__group col-md-1">
                        <label for="exampleInputtext1">Qty</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Qty">
                    </div>
                    <div class="form-group m-form__group col-md-2">
                        <label for="exampleInputtext1">Periode Sewa</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Periode Sewa">
                    </div>
                    <div class="form-group m-form__group col-md-2">
                        <label for="exampleInputtext1">Jenis Periode</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Jenis Periode">
                    </div>
                    <div class="form-group m-form__group col-md-1">
                        <label for="exampleInputtext1">Notifikasi</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Notifikasi">
                    </div>
                    <div class="form-group m-form__group col-md-2">
                        <label for="exampleInputtext1">Harga Satuan</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Harga Satuan">
                    </div>
                    <div class="form-group m-form__group col-md-2">
                        <label for="exampleInputtext1">Harga</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Harga">
                    </div>
                </div>
                <div class="form-group m-form__group m--margin-top-10">
                        <h5 class="m-portlet__head-text"><strong>Detail Barang Dan Harga</strong></h5>
                </div>
                <div class="m-portlet__body col-md-12">
                    <div class="form-group m-form__group col-md-3">
                        <label for="exampleInputtext1">Nama Barang</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Nama Barang">
                    </div>
                    <div class="form-group m-form__group col-md-3">
                        <label for="exampleInputtext1">Qty</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Qty">
                    </div>
                    <div class="form-group m-form__group col-md-3">
                        <label for="exampleInputtext1">Harga Satuan</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Harga Satuan">
                    </div>
                    <div class="form-group m-form__group col-md-3">
                        <label for="exampleInputtext1">Harga</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Harga">
                    </div>
                </div>
                <div class="form-group m-form__group m--margin-top-10">
                        <h5 class="m-portlet__head-text"><strong>Termin</strong></h5>
                </div>
                <div class="m-portlet__body col-md-12">
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Persentase</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Persentase">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Nilai</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Nilai">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Tanggal Jatuh Tempo</label>
                        <input type="text" class="form-control m-input datepicker" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Tanggal Jatuh Tempo">
                    </div>
                </div>
                <div class="m-portlet__body col-md-12">
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Persentase</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Persentase">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Nilai</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Nilai">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Tanggal Jatuh Tempo</label>
                        <input type="text" class="form-control m-input datepicker" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Tanggal Jatuh Tempo">
                    </div>
                </div>
                <div class="m-portlet__body col-md-12">
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Persentase</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Persentase">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Nilai</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Nilai">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Tanggal Jatuh Tempo</label>
                        <input type="text" class="form-control m-input datepicker" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Tanggal Jatuh Tempo">
                    </div>
                </div>
                            <div class="form-actions">
                                <button name="btnSimpan" class="btn blue" id="id_btnSimpan"><!--<i class="fa fa-check"></i>--> Simpan</button>
                                <button name="btnUbah" onclick="" class="btn yellow" id="id_btnUbah"><!--<i class="fa fa-edit"></i>--> Ubah</button>
                                <button name="btnHapus" class="btn red" id="id_btnHapus"><!--<i class="fa fa-trash"></i>--> Hapus</button>
                                <button id="id_btnBatal" type="reset" class="btn default">Batal</button>
                            </div>
                        </form>
                    </div>    
                </div>    
            </div>
        </div><!-- end <div class="portlet green-meadow box"> -->
    </div><!-- end <div class="col-md-6"> -->

    <div class="col-md-6">

    </div><!-- end <div class="col-md-6"> -->
</div>
<div class="row">
    <div class="col-md-6">

    </div>
</div>

<!-- END PAGE CONTENT-->
<!-- /.modal -->

<!--  END MODAL-->
<?php $this->load->view('app.min.inc.php'); ?>
<script>

    var TableManaged = function () {
        var initTable1 = function () {
            var table = $('#idTabelUserGroup');

            var table2 = $('#idTablePo');

            // begin first table
            table2.dataTable({
                "ajax": "<?php echo base_url("/master_po/getTableList"); ?>",
                "columns": [
                    {"data": "noPr"},
                    {"data": "tglReq"},
                    {"data": "reqType"},
                    {"data": "catName"},
                    {"data": "projName"},
                    {"data": "branch"},
                    {"data": "divisi"},
                    {"data": "status"},
                    {"data": "catatan"},
                    {data: null,
                        className: "center",
                        defaultContent: '<a href="#" class="btn btn-primary">Aksi</a>'
                    }
                ],
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "No data available in table",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "No entries found",
                    "infoFiltered": "(filtered1 from _MAX_ total entries)",
                    "lengthMenu": "Show _MENU_ entries",
                    "search": "Search:",
                    "zeroRecords": "No matching records found"
                },
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 5,
                "pagingType": "bootstrap_full_number",
                "language": {
                    "search": "Cari: ",
                    "lengthMenu": "  _MENU_ records",
                    "paginate": {
                        "previous": "Prev",
                        "next": "Next",
                        "last": "Last",
                        "first": "First"
                    }
                },
                "aaSorting": [[0, 'asc']/*, [5,'desc']*/],
                "columnDefs": [{// set default column settings
                        'orderable': true,
                        "searchable": true,
                        'targets': [0]
                    }],
                "order": [
                    [0, "asc"]
                ] // set first column as a default sort by asc
            });
            $('#id_Reload').click(function () {
                table.api().ajax.reload();
            });

            var tableWrapper = jQuery('#example_wrapper');

            table.find('.group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                        $(this).parents('tr').addClass("active");
                    } else {
                        $(this).attr("checked", false);
                        $(this).parents('tr').removeClass("active");
                    }
                });
                jQuery.uniform.update(set);
            });

            table.on('change', 'tbody tr .checkboxes', function () {
                $(this).parents('tr').toggleClass("active");
            });
            table2.on('click', 'tbody tr', function () {
                var idUg = $(this).find("td").eq(9).html();
                // var descUg = $(this).find("td").eq(1).html();

                $('#id_id_usergroup').val(idUg);
                // $('#id_desc_usergroup').val(descUg);

                $("#navitab_2_2").trigger('click');
                //$('#').val();
                $('#id_btnSimpan').attr('disabled', true);
                $('#id_btnUbah').attr("disabled", false);
                $('#id_btnHapus').attr("disabled", false);
                $('#id_namaSpl').focus();

            });

            tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
        }


        return {
            //main function to initiate the module
            init: function () {
                if (!jQuery().dataTable) {
                    return;
                }
                initTable1();
            }
        };
    }();
    App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
        UIBootbox.init();
        TableManaged.init();
      
        $('#id_desc_usergroup').focus();
        $("#id_btnUbah").attr("disabled", "disabled");
        $("#id_btnHapus").attr("disabled", "disabled");
        
    });
    $('#id_btnBatal').click(function () {
        btnStart();
        resetForm();
        readyToStart();
        tglTransStart();
        $('#id_body_data').empty();
    });
    $("#navitab_2_2").click(function () {
        $('#id_desc_usergroup').focus();
    });
    
    $('#id_from_sec_group_user').submit(function (event) {
        dataString = $("#id_from_sec_group_user").serialize();

        var aksiBtn = $('#idTmpAksiBtn').val();
        if (aksiBtn == '1') {
            bootbox.confirm("Apakah anda yakin menyimpan data ini?", function (o) {
                if (o == true) {
                    ajaxSubmit("admin/sec_group_user/simpan",dataString);
                } 
            });
        } else if (aksiBtn == '2') {
            bootbox.confirm("Apakah anda yakin merubah data ini?", function (o) {
                if (o == true) {
                    ajaxSubmit("admin/sec_group_user/ubah",dataString);
                } 
            });
        } else if (aksiBtn == '3') {
            bootbox.confirm("Apakah anda yakin menghapus data ini?", function (o) {
                if (o == true) {
                    var id = $('#id_id_usergroup').val();
                    id = id.trim();
                    ajaxNonSubmit("admin/sec_group_user/hapus",dataString,id);
                } 
            });
        }
        
        event.preventDefault();
    });



</script>


<!-- END JAVASCRIPTS