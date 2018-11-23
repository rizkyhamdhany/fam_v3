<!-- BEGIN PAGE BREADCRUMB -->
<!-- Include Twitter Bootstrap and jQuery: -->

<!-- Include Twitter Bootstrap and jQuery: -->
<style type="text/css">
    table#table_gridCategory th:nth-child(2){
        display: none;
    } 
    table#table_gridCategory td:nth-child(2){
        display: none;
    }

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit  bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-red"></i>
                    <span class="caption-subject font-red sbold uppercase">PO</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="tab">
                <div class="form-group m-form__group m--margin-top-10">
                    <h5 class="m-portlet__head-text"><strong>Detail PR</strong></h5>
                </div>
                <div class="form-horizontal col-md-12">
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">No PR</label>
                        <div class="col-sm-6">
                            <p class="form-control-static"><?php echo $po->RequestID;?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Tanggal PR</label>
                        <div class="col-sm-6">
                            <p class="form-control-static"><?php echo $po->DATE;?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Request Type</label>
                        <div class="col-sm-6">
                            <p class="form-control-static"><?php echo $po->ReqTypeName;?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Branch</label>
                        <div class="col-sm-6">
                            <p class="form-control-static"><?php echo $po->BRANCH_DESC;?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Category Name</label>
                        <div class="col-sm-6">
                            <p class="form-control-static"><?php echo $po->ReqCategoryName;?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Divisi</label>
                        <div class="col-sm-6">
                            <p class="form-control-static"><?php echo $po->DIV_DESC;?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Nama Project</label>
                        <div class="col-sm-6">
                            <p class="form-control-static"><?php echo $po->PROJECT_NAME;?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-6 control-label" style="text-align: left;">Periode</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">1</p>
                        </div>
                    </div>
                    
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-4">
                        <label for="example-text-input" class="col-2 col-form-label">Total HPS</label>
                        <div class="col-2">
                            <input class="form-control m-input" type="text" value="<?php echo $thps;?>" id="example-text-input" readonly>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="example-text-input" class="col-2 col-form-label">Total Item</label>
                        <div class="col-2">
                            <input class="form-control m-input" type="text" value="<?php echo $titem;?>" id="example-text-input" readonly>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="example-text-input" class="col-2 col-form-label">Total QTY</label>
                        <div class="col-2">
                            <input class="form-control m-input" type="text" value="<?php echo $tqty;?>" id="example-text-input" readonly>
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
                        <?php foreach($item as $bar){ ?>
                            <tr>
                                <td><?php echo $bar->ItemName?></td>
                                <td><?php echo $bar->ItemTypeName?></td>
                                <td><?php echo $bar->Qty?></td>
                                <td><?php echo $bar->total?></td>
                                <td><?php echo $bar->HargaHPS?></td>
                            </tr>
                        <?php }?>
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
                            <input type="radio" name="example_3" value="1" disabled> Prioritas
                            <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label class="col-sm-2 col-form-label">Kelengkapan</label>
                        <div class="m-radio-inline col-sm-6">
                            <label class="m-radio">
                            <input type="radio" name="example_3" value="1" disabled> Lengkap
                            <span></span>
                            </label>
                            <label class="m-radio">
                            <input type="radio" name="example_3" value="1" disabled> Tidak Lengkap
                            <span></span>
                            </label>

                        </div>
                    </div>
                    
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Tipe Pembayaran</label>
                        <div class="col-sm-6">
                                <select class="form-control m-input" id="example-getting-started" disabled>
                                    <option value="1">1</option>
                                </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Jenis Pengadaan</label>
                        <div class="col-sm-6">
                            <select class="form-control m-input" id="exampleSelect1" disabled>
                                <option>1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleTextarea" class="col-sm-2 col-form-label">Catatan</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="exampleTextarea" rows="3" disabled></textarea>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Tipe Pembayaran</label>
                        <div class="col-sm-6">
                            <select class="form-control m-input" id="exampleSelect1" disabled>
                                <option>1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">PIC</label>
                        <div class="col-sm-6">
                            <select class="form-control m-input" id="exampleSelect1" disabled>
                                <option>1</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body col-md-12">
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Jenis Pengadaan</label>
                        <div class="col-sm-8">
                            <select class="form-control m-input" id="exampleSelect1" disabled>
                                <option>1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">BOD</label>
                        <div class="col-sm-8">
                            <select class="form-control m-input" id="exampleSelect1" disabled>
                                <option>1</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">List Vendor</span>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listvendor as $vl) {?>
                            <tr>
                                <td><?php echo $vl->VendorName; ?></td>
                                <td><?php echo $vl->City; ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            
                        </tbody>
                    </table>
                </div>
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">Vendor Pemenang</span>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listvendors as $vl) {?>
                            <tr>
                                <td><?php echo $vl->VendorName; ?></td>
                                <td><?php echo $vl->City; ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="tab">
                <div class="form-group m-form__group m--margin-top-10">
                    <h5 class="m-portlet__head-text"><strong>PA</strong></h5>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">No PA</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="123455" disabled>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">PA Approval</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YGT" disabled>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YTH" disabled>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YPP" disabled>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Approval" disabled>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Approval" disabled>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Textbox" disabled>
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
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Sisa Anggaran" disabled>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Anggaran Terpakai</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Anggaran Terpakai" disabled>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Entity PNM</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" disabled>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">LOB</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" disabled>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Main Account</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" disabled>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Divisi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" disabled>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Sub Account</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" disabled>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-6">
                        <label for="example-text-input" class="col-sm-4 col-form-label">Business Type</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" disabled>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">COA</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="COA" disabled>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Anggaran</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Anggaran Terpakai" disabled>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">PA Approval</label>
                        <div class="col-sm-6">
                            <select class="form-control m-input" id="exampleSelect1" disabled>
                                <option>1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Budget Disetujui</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="exampleTextarea" rows="3" disabled></textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Status" disabled>
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
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="123455" disabled>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">BOD Approval</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YGT" disabled>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YTH" disabled>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="YPP" disabled>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-12">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Approval" disabled>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Approval" disabled>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control m-input" id="exampleInputtext1" aria-describedby="textHelp" placeholder="Textbox" disabled>
                        </div>
                    </div>
                </div>
                </div>
                <div class="tab">
                
                <?php $l = 1;
                foreach ($listvendors as $vendor) {?>
                <form role="form" id="form<?php echo $l;?>" class="form" method="post" id="id_from_sec_group_user" action="<?php echo base_url('procurement/po/savedata'); ?>">
                <div class="form-group m-form__group m--margin-top-10">
                    <h5 class="m-portlet__head-text"><strong>PO VENDOR <?php echo $vendor->VendorName; ?></strong></h5>
                </div>
                <div class="m-portlet__body col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nama Dokumen</th>
                                <th scope="col">Validasi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $nama_po ?></td>
                                <td><input type="checkbox" name="check[]" value="<?php echo $nama_po ?>"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><?php echo $nama_spk ?></td>
                                <td><input type="checkbox" name="check[]" value="<?php echo $nama_spk ?>"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><?php echo $nama_kpbj ?></td>
                                <td><input type="checkbox" name="check[]" value="<?php echo $nama_kpbj ?>"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><?php echo $nama_psw ?></td>
                                <td><input type="checkbox" name="check[]" value="<?php echo $nama_psw ?>"></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="m-portlet__body col-md-12">
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Jumlah Barang</label>
                        <input type="text" class="form-control m-input" id="jmlbrg<?php echo $l?>" aria-describedby="textHelp" placeholder="Jumlah Barang" name="jmlbrg" readonly="">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Jenis Barang</label>
                        <input type="text" class="form-control m-input" id="jnsbrg<?php echo $l?>" aria-describedby="textHelp" placeholder="Jenis Barang" name="jnsbrg" readonly="">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Sub Total</label>
                        <input type="text" class="form-control m-input" id="hargatotal<?php echo $l?>" aria-describedby="textHelp" placeholder="Sub Total" name="subtotal" readonly="">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">PPN</label>
                        <input type="text" class="form-control m-input" id="ppn<?php echo $l?>" aria-describedby="textHelp" placeholder="PPN" name="ppn" readonly="">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Presentase</label>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <input class="form-control m-input" value="10" name="presentase" id="presen<?php echo $l?>" type="number" readonly>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn red col-md-6" id="edit_presentase<?php echo $l?>">Edit</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Disc</label>
                        <input type="number" name="disc" class="form-control m-input" id="disc<?php echo $l?>" aria-describedby="textHelp" placeholder="Disc">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">PPH</label>
                        <input type="number" name="pph" class="form-control m-input" id="pph<?php echo $l?>" aria-describedby="textHelp" placeholder="PPH">
                    </div>
                    <div class="form-group m-form__group col-md-4">
                        <label for="exampleInputtext1">Total</label>
                        <input type="text" name="totalall" class="form-control m-input" id="totalall<?php echo $l?>" aria-describedby="textHelp" placeholder="Total" readonly="">
                    </div>
                </div>
                <input type="hidden" name="id_pr" value="<?php echo $po->RequestID?>">
                <input type="hidden" name="id_vendor" value="<?php echo trim($vendor->VendorID)?>">
                <input type="hidden" name="redirect" value="ada">
                <?php if(trim($po->ReqTypeID) == '3'){ ?>
                <div class="form-group m-form__group m--margin-top-10">
                        <h5 class="m-portlet__head-text"><strong>Sewa Barang dan Bangunan</strong></h5>
                </div>
                <div class="m-portlet__body col-md-12">
                <?php $i=1;
                foreach ($item as $list){?>
                    <input type="hidden" name="itemid[]" value="<?php echo $list->ItemID?>">
                    <div class="form-group m-form__group col-md-2">
                        <label for="exampleInputtext1">Barang/Bangunan</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" value="<?php echo $list->ItemName?>" name="barang[]" placeholder="Barang/Bangunan" readonly>
                    </div>
                    <div class="form-group m-form__group col-md-1">
                        <label for="exampleInputtext1">Qty</label>
                        <input type="number" min="0" class="form-control m-input" id="qty<?php echo $i?>" value="<?php echo $list->Qty?>" name="qty[]" placeholder="Qty">
                    </div>
                    <div class="form-group m-form__group col-md-2">
                        <label for="exampleInputtext1">Periode Sewa</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" name="sewa" placeholder="Periode Sewa" required>
                    </div>
                    <div class="form-group m-form__group col-md-2">
                        <label for="exampleInputtext1">Jenis Periode</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" name="jenis" placeholder="Jenis Periode" required>
                    </div>
                    <div class="form-group m-form__group col-md-1">
                        <label for="exampleInputtext1">Notifikasi</label>
                        <input type="text" class="form-control m-input" id="exampleInputtext1" name="notif" placeholder="Notifikasi" required>
                    </div>
                    <div class="form-group m-form__group col-md-2">
                        <label for="exampleInputtext1">Harga Satuan</label>
                        <input type="number" min="0" class="form-control m-input" id="satuan<?php echo $i?>" value="<?php echo $list->HargaHPS?>" name="satuan[]" placeholder="Harga Satuan">
                    </div>
                    <div class="form-group m-form__group col-md-2">
                        <label for="exampleInputtext1">Harga</label>
                        <input type="text" class="form-control m-input total" id="total<?php echo $i?>" value="<?php echo $list->total?>" name="hargatotal[]" placeholder="Harga">
                    </div>
                <?php $i++;
            }?>
                </div>
            <?php }else{ ?>
                <div class="form-group m-form__group m--margin-top-10">
                        <h5 class="m-portlet__head-text"><strong>Detail Barang Dan Harga</strong></h5>
                </div>
                <div class="m-portlet__body col-md-12">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>QTY</th>
                                <th>Harga Satuan</th>
                                <th>Harga</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;
                        foreach ($item as $list){?>
                            <tr id="row<?php echo $i.$l;?>">
                                <td><input type="hidden" name="itemid[]" value="<?php echo $list->ItemID?>"><input type="text" name="barang[]" value="<?php echo $list->ItemName?>"></td>
                                <td><input class="brg<?php echo $l;?>" type="number" name="qty[]" id="qty<?php echo $i?>" value="<?php echo $list->Qty?>"></td>
                                <td><input type="number" name="satuan[]" class="satuan<?php echo $l;?>" id="satuan<?php echo $i?>" value="<?php echo $list->HargaHPS?>"></td>
                                <td><input type="number" name="hargatotal[]" class="total<?php echo $l;?>" id="total<?php echo $i?>" value="<?php echo $list->total?>"></td>
                                <td><button onclick="dltRow('<?php echo $i;?>', '<?php echo $l;?>')">Delete</button></td>
                            </tr>
                        <?php $i++;
                    }?>
                        </tbody>
                    </table>
                </div>
            <?php }?>
                <div class="form-group m-form__group m--margin-top-10 col-md-12">
                    <div class="col-md-4">
                        <h5 class="m-portlet__head-text"><strong>Termin</strong></h5>
                    </div>
                    <div class="col-md-3">
                        <label class="mt-checkbox">
                            <input type="checkbox" id="detail<?php echo $l;?>"> Detail Terima
                            <span></span>
                        </label>
                    </div>
                    <div class="form-group m-form__group col-md-3" id="notdetail<?php echo $l;?>">
                        <input type="text" class="form-control m-input datepicker" name="dterima" id="dterima<?php echo $l;?>" aria-describedby="textHelp" placeholder="dd/mm/yyyy" required>
                    </div>
                </div>
                <div class="tanda termin<?php echo $l;?>">
                <div class="m-portlet__body col-md-12">
                    <div class="form-group m-form__group col-md-3">
                        <input type="hidden" name="term[]" value="1">
                        <label for="exampleInputtext1">Persentase</label>
                        <input type="number" class="form-control m-input form<?php echo $l;?>" name="persentase[]" id="presentase<?php echo $l; ?>" aria-describedby="textHelp" placeholder="Persentase" required>
                    </div>
                    <div class="form-group m-form__group col-md-3">
                        <label for="exampleInputtext1">Nilai</label>
                        <input type="text" class="form-control m-input" id="nilai<?php echo $l;?>" name="nilai[]" aria-describedby="textHelp" placeholder="Nilai" readonly required>
                    </div>
                    <div class="form-group m-form__group col-md-3">
                        <label for="exampleInputtext1">Tanggal Jatuh Tempo</label>
                        <input type="text" class="form-control m-input datepicker" name="tempo[]" aria-describedby="textHelp" placeholder="Tanggal Jatuh Tempo" required>
                    </div>
                    <div class="form-group m-form__group col-md-3 terima<?php echo $l;?>" hidden>
                        <label for="exampleInputtext1">Tgl Akhir Penerimaan Barang</label>
                        <input type="text" class="form-control m-input datepicker" name="akhir[]" aria-describedby="textHelp" placeholder="Tgl Akhir Penerimaan Barang">
                    </div>
                </div>
                </div>
                <div class="m-portlet__body col-md-12 text-center">
                    <button name="btnSimpan" type="button" class="btn green" id="add_termin<?php echo $l;?>">Tambah Termin</button>
                </div>
                </form>
                <?php $l++;
                } ?>
                
                </div>

                <!-- <div style="overflow:auto;"> -->
                    <!-- <div style="float:right;"> -->
                            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                    <!-- </div> -->
                <!-- </div> -->
                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"> </span>
                  </div>

                </div>

            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>


<!-- END PAGE CONTENT-->

<!-- Modal UPDATE-->



<?php $this->load->view('app.min.inc.php'); ?>

<script>
var $ = jQuery.noConflict();
$( document ).ready(function() {

    for (var l = 1; l <= $(".tanda").length; l++){
        $("#detail"+l).change(function() {
            var kelas = $(this).attr('id');
            var form = kelas.substring(kelas.length-1, kelas.length);
            if(this.checked) {
                $('.terima'+form).show();
                $('#notdetail'+form).hide();
                $('#dterima'+form).removeAttr('required');
            }else{
                $('.terima'+form).hide();
                $('#notdetail'+form).show();
                $('#dterima'+form).attr('required');
            }
        });

        $('#edit_presentase'+l).click(function(){
            var kelas = $(this).attr('id');
            var form = kelas.substring(kelas.length-1, kelas.length);
            $('#presen'+form).attr('readonly', false);
        });

        var sum = 0;
        var brg = 0;

        $('.total'+l).each(function(){
            sum += parseInt(this.value);
        });

        $('.brg'+l).each(function(){
            brg += parseInt(this.value);
        });

        $('#hargatotal'+l).val(sum);
        $('#ppn'+l).val(sum*0.1);
        $('#jmlbrg'+l).val(brg);
        $('#jnsbrg'+l).val($('.brg'+l).length);
    }
});
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab
var seluruh = $('.tanda').length;

function dltRow(row, form){
    var sum = 0;
    var brg = 0;
    $('#row'+row+form).remove();
    console.log('.total'+form);
    $('.total'+form).each(function(){
        sum += parseInt(this.value);
    });
    $('.brg'+form).each(function(){
            brg += parseInt(this.value);
        });
    $('#hargatotal'+form).val(sum);
    $('#jmlbrg'+form).val(brg);
    $('#jnsbrg'+form).val($('.brg'+form).length);
    hitung2(form);
}
function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
    $("#nextBtn").attr('onclick', 'submit()');
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
    $("#nextBtn").attr('onclick', 'nextPrev(1)');
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = true;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
$(document).on('click', '.datepicker', function(){
   $(this).datepicker({
        orientation: "left",
        format: "dd/mm/yyyy",
        autoclose: true
    }).focus();
   $(this).removeClass('datepicker');
});

var num = $(".tanda").length;
var n = 1;

for (var l = 1; l <= $(".tanda").length; l++){
    $("#add_termin"+l).click({param: l}, add_termin);
}

function add_termin(e){
    console.log(e.data.param);
    num++;
        
    if($('#detail'+e.data.param).is(":checked")){
        $('.termin'+e.data.param).append('<div class="m-portlet__body col-md-12"><div class="form-group m-form__group m--margin-top-10 col-md-12"><div class="form-group m-form__group col-md-3"><label for="exampleInputtext1">Persentase</label><input type="number" class="form-control m-input form'+e.data.param+'" name="persentase[]" id="presentase'+num+'" aria-describedby="textHelp" placeholder="Persentase"></div><div class="form-group m-form__group col-md-3"><label for="exampleInputtext1">Nilai</label><input type="text" class="form-control m-input" id="nilai'+num+'" name="nilai[]" aria-describedby="textHelp" placeholder="Nilai" readonly></div><div class="form-group m-form__group col-md-3"><label for="exampleInputtext1">Tanggal Jatuh Tempo</label><input type="text" class="form-control m-input datepicker" id="exampleInputtext1" name="tempo[]" aria-describedby="textHelp" placeholder="Tanggal Jatuh Tempo"></div><div class="form-group m-form__group col-md-3 terima'+e.data.param+'"><label for="exampleInputtext1">Tgl Akhir Penerimaan Barang</label><input type="text" class="form-control m-input datepicker" name="akhir[]" aria-describedby="textHelp" placeholder="Tgl Akhir Penerimaan Barang"></div></div></div>');
    }else{
        $('.termin'+e.data.param).append('<input type="hidden" name="term[]" value="'+num+'"><div class="m-portlet__body col-md-12"><div class="form-group m-form__group col-md-3"><label for="exampleInputtext1">Persentase</label><input type="number" class="form-control m-input form'+e.data.param+'" name="persentase[]" id="presentase'+num+'" aria-describedby="textHelp" placeholder="Persentase"></div><div class="form-group m-form__group col-md-3"><label for="exampleInputtext1">Nilai</label><input type="text" class="form-control m-input" id="nilai'+num+'" name="nilai[]" aria-describedby="textHelp" placeholder="Nilai" readonly></div><div class="form-group m-form__group col-md-3"><label for="exampleInputtext1">Tanggal Jatuh Tempo</label><input type="text" class="form-control m-input datepicker" id="exampleInputtext1" name="tempo[]" aria-describedby="textHelp" placeholder="Tanggal Jatuh Tempo"></div><div class="form-group m-form__group col-md-3 terima'+e.data.param+'" hidden><label for="exampleInputtext1">Tgl Akhir Penerimaan Barang</label><input type="text" class="form-control m-input datepicker" name="akhir[]" aria-describedby="textHelp" placeholder="Tgl Akhir Penerimaan Barang"></div></div>');
    }

    $("input[name='persentase[]']").on("keyup", function(){
        var kelas = $(this).attr('class');
        var form = kelas.substring(kelas.length-1, kelas.length);
        var total = $('#hargatotal'+form).val();
        var percent = ($(this).val())/100;
        var id = $(this).attr('id');
        var lastid = id.substring(id.length-1, id.length);
        $('#nilai'+lastid+'').val(percent*total);
    });
}

function submit(){
    for(var m = 1; m <= $(".form").length; m++){
        $.ajax({
            type: "POST",
            url: $("#form"+m).attr('action'),
            data: $("#form"+m).serialize(),
            success: function( response ) {
                if(JSON.parse(response).redirect == true){
                    location.href = "<?php echo base_url('procurement/po/home')?>";
                }
            }
        });
    }
}


    for (var j = 1; j <= $("input[name='barang[]']").length; j++) {
        $("#qty"+j).on("keyup", {obj: j}, counter);
        $("#disc"+j).on("keyup", {obj: j}, hitung);
        $("#pph"+j).on("keyup", {obj: j}, hitung);
        $("#presen"+j).on("keyup", {obj: j}, hitung);
    }

    function hitung(e){
        var obj = e.data.obj;
        var sub = parseInt($('#hargatotal'+obj).val());
        var disc = $('#disc'+obj).val();
        var presentase = parseInt($('#presen'+obj).val());
        var pph = $('#pph'+obj).val();
        $('#ppn'+obj).val((sub-disc)*(presentase/100))
        var ppn = parseInt($('#ppn'+obj).val());
        $('#totalall'+obj).val((sub-disc)+ppn-pph);
    }

    function hitung2(obj){
        var sub = parseInt($('#hargatotal'+obj).val());
        var disc = parseInt($('#disc'+obj).val());
        var presentase = $('#presen'+obj).val();
        var pph = $('#pph'+obj).val();
        $('#ppn'+obj).val((sub-disc)*(presentase/100))
        var ppn = parseInt($('#ppn'+obj).val());
        $('#totalall'+obj).val((sub-disc)+ppn-pph);
    }

    function counter(e){
        var obj = e.data.obj;
        var sum = 0;
        var satuan = $("#satuan"+obj).val();
        var kelas = $("#satuan"+obj).attr('class');
        var form = kelas.substring(kelas.length-1, kelas.length);
        var total = ($("#qty"+obj).val())*satuan;
        $("#total"+obj).val(total);
        $('.total'+form).each(function(){
            sum += parseInt(this.value);
        });
        $('#hargatotal'+form).val(sum);
        hitung2(form);
    }

    for (var k = 1; k <= $("input[name='qty[]']").length; k++) {
        $("#satuan"+k).on("keyup", {obj: k}, counter);
    }

    $("input[name='persentase[]']").on("keyup", function() {
        var kelas = $(this).attr('class');
        var form = kelas.substring(kelas.length-1, kelas.length);
        var total = $('#hargatotal'+form).val();
        var percent = ($(this).val())/100;
        var id = $(this).attr('id');
        var lastid = id.substring(id.length-1, id.length);
        $('#nilai'+lastid+'').val(percent*total);
    });


</script>


<!-- END JAVASCRIPTS