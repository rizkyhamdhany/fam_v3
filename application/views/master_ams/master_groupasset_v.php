<!-- BEGIN PAGE BREADCRUMB -->
<!--

-->
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
                            Data Group Asset </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Form Data Group Asset</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <div class="scroller" style="height:400px; ">
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="id_Reload" style="display: none;"></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">


                                    <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelUser">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Kode Group
                                                </th>
                                                <th>
                                                    Nama Group
                                                </th>
                                                <th>
                                                    Jenis Asset
                                                </th>
                                                <th>
                                                    Metode Penyusutan
                                                </th>
                                                <th>
                                                    Umur Asset Dalam Bulan
                                                </th>
                                                <th>
                                                    Status Penyusutan
                                                </th>
                                                <th>
                                                    Persentase Nilai Sisa
                                                </th>
                                                <th>
                                                    Pembulatan
                                                </th>
                                                <th>
                                                    Waktu Mulai Penyusutan
                                                </th>
                                                <th>
                                                    Format Kode Asset
                                                </th>
                                                <th>
                                                    No Urut Kode Asset
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
                    </div>
                    <div class="tab-pane fade" id="tab_2_2">
                        <!-- BEGIN FORM-->

                        <form role="form" method="post" class="form-horizontal cls_from_sec_user cls_form_validate "
                              action="<?php echo base_url('parameter/master_groupasset/home'); ?>" id="idFormUser" novalidate="novalidate">    

                            <div class="form-body">
                                <!--                                <div class="alert alert-danger display-hide">
                                                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. 
                                                                </div>-->
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                <div class="form-group hidden">
                                    <label class="control-label col-md-3">User id 
                                        

                                    </label>

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Kode Group

                                    </label>
                                    <div class="col-md-9">
                                        <input readonly="" id="kodegroup"  name="kodegroup" data-required="1" class="form-control input-sm" type="text"> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Nama Group

                                    </label>
                                    <div class="col-md-9">
                                        <input  id="namagroup"  name="namagroup" data-required="1" class="form-control input-sm" type="text"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Jenis Asset

                                    </label>
                                    <div class="col-md-9">
                                        <select name="jenisasset" class="form-control" onchange="detail(this.value)" >

                                            <option value=""></option>
                                            <option value="0">Motor/Mobil</option>
                                            <option value="1">Computer</option>
                                            <option value="2">Genset</option>
                                            <option value="3">Inventaris</option>


                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Metode Penyusutan

                                    </label>
                                    <div class="col-md-9">
                                        <select name="metodesusut" class="form-control"  >

                                            <option value=""></option>
                                            <option value="0">Garis Lurus</option>
                                            <option value="1">Saldo Menurun</option>
                                            <option value="2">Saldo Menurun Berganda</option>
                                            <option value="3">Jumlah Angka Tahun</option>


                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Umur Asset Dalam Bulan

                                    </label>
                                    <div class="col-md-9">
                                        <input  id="umurassetdalambulan"  name="umurassetdalambulan" data-required="1" class="form-control input-sm" type="text"> 
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">Status Penyusutan

                                    </label>
                                    <div class="col-md-9">
                                        <select name="statussusut" class="form-control"  >

                                            <option value=""></option>
                                            <option value="0">Disusutkan</option>
                                            <option value="1">Tidak Disusutkan</option>



                                        </select>
                                    </div> 
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">Presentasi Nilai Sisa

                                    </label>
                                    <div class="col-md-9">
                                        <input  id="persennilaisisa"  name="persennilaisisa" data-required="1" class="form-control input-sm" type="text"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Pembulatan

                                    </label>
                                    <div class="col-md-9">
                                        <select name="pembulatan" class="form-control"  >

                                            <option value=""></option>
                                            <option value="0">Satuan</option>
                                            <option value="1">Puluhan</option>
                                            <option value="2">Ratusan</option>
                                            <option value="3">Ribuan</option>


                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Waktu Mulai Penyusutan

                                    </label>
                                    <div class="col-md-9">
                                        <select name="waktumulaisusut" class="form-control"  >

                                            <option value=""></option>
                                            <option value="0">Sejak Perolehan</option>
                                            <option value="1">Sejak Penyewaan/Dipakai</option>


                                        </select>
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Format Kode Asset

                                    </label>
                                    <div class="col-md-9">
                                        <input  id="formatkodeasset"  name="formatkodeasset" data-required="1" class="form-control input-sm" type="text"> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">No Urut Kode Asset

                                    </label>
                                    <div class="col-md-9">
                                        <input  id="noakhirkodeasset"  name="noakhirkodeasset" data-required="1" class="form-control input-sm" type="text"> 
                                    </div>
                                </div>

                                <!--==========================================classmobil========================================================-->
                                <div class="mobil" id="mobil" >               
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Merk Mobil

                                        </label>
                                        <div class="col-md-9">
                                            <select name="merk_mobil" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Type Mobil

                                        </label>
                                        <div class="col-md-9">
                                            <select name="type_mobil" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Model Mobil

                                        </label>
                                        <div class="col-md-9">
                                            <select name="model_mobil" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Warna Mobil

                                        </label>
                                        <div class="col-md-9">
                                            <select name="warna_mobil" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">No Rangka Mobil

                                        </label>
                                        <div class="col-md-9">
                                            <select name="norangka_mobil" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-3">No Mesin Mobil

                                        </label>
                                        <div class="col-md-9">
                                            <select name="nomesin_mobil" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Isi Silinder Mobil

                                        </label>
                                        <div class="col-md-9">
                                            <select name="isisilinder_mobil" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Tahun Pembuatan Mobil

                                        </label>
                                        <div class="col-md-9">
                                            <select name="tahunpembuatan_mobil" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>
                                </div>
                                <!--=======================================classcomputer================================================-->

                                <div class="computer" id="computer" >  
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Merk Computer

                                        </label>
                                        <div class="col-md-9">
                                            <select name="merk_computer" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Type Computer

                                        </label>
                                        <div class="col-md-9">
                                            <select name="type_computer" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Model Computer

                                        </label>
                                        <div class="col-md-9">
                                            <select name="model_computer" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-3">Jenis Processor Computer

                                        </label>
                                        <div class="col-md-9">
                                            <select name="jenisprocessor_computer" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Ram Computer

                                        </label>
                                        <div class="col-md-9">
                                            <select name="ram_computer" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">SD Computer

                                        </label>
                                        <div class="col-md-9">
                                            <select name="sd_computer" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <!--                                 <div class="form-group">
                                                                        <label class="control-label col-md-3">SD Computer
                                    
                                                                        </label>
                                                                        <div class="col-md-9">
                                                                            <select name="sd_computer" class="form-control">
                                    
                                    
                                                                                <option value="0">Wajib Isi</option>
                                                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                                                <option value="2">Optional</option>
                                                                                <option value="3">Tidak Diisi</option>
                                                                            </select>
                                                                        </div> 
                                                                    </div>-->

                                    <div class="form-group">
                                        <label class="control-label col-md-3">HDD Computer

                                        </label>
                                        <div class="col-md-9">
                                            <select name="hdd_computer" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Serial Number Computer

                                        </label>
                                        <div class="col-md-9">
                                            <select name="serialnumber_computer" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>
                                </div>


                                <!--=====================================classgenset==============================================================-->
                                <div class="form-group" id="genset" >
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Merk Genset

                                        </label>
                                        <div class="col-md-9">
                                            <select name="merk_genset" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Type Genset

                                        </label>
                                        <div class="col-md-9">
                                            <select name="type_genset" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Model Genset

                                        </label>
                                        <div class="col-md-9">
                                            <select name="model_genset" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">KVA Genset

                                        </label>
                                        <div class="col-md-9">
                                            <select name="kva_genset" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Engine SN Genset

                                        </label>
                                        <div class="col-md-9">
                                            <select name="enginesn_genset" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">No Engine Type Genset

                                        </label>
                                        <div class="col-md-9">
                                            <select name="noenginetype_genset" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-3">Alternator Type Genset

                                        </label>
                                        <div class="col-md-9">
                                            <select name="alternatortype_genset" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Alternator SN Genset

                                        </label>
                                        <div class="col-md-9">
                                            <select name="alternatorsn_genset" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>
                                </div>

                                <!--=====================================classinventaris===========================================-->
                                <div class="form-group" id="inventaris" >
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Merk Inventaris

                                        </label>
                                        <div class="col-md-9">
                                            <select name="merk_inventaris" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-3">Type/Model Inventaris

                                        </label>
                                        <div class="col-md-9">
                                            <select name="typemodel_inventaris" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Ukuran Inventaris

                                        </label>
                                        <div class="col-md-9">
                                            <select name="ukuran_inventaris" class="form-control">


                                                <option value="0">Wajib Isi</option>
                                                <option value="1">Wajib Isi Boleh Tunda</option>
                                                <option value="2">Optional</option>
                                                <option value="3">Tidak Diisi</option>
                                            </select>
                                        </div> 
                                    </div>
                                </div>



                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type ="button" name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                                <i class="fa fa-check"></i> Simpan
                                            </button>
                                            <button type ="button" name="btnUbah" class="btn green" id="id_btnUbah">
                                                <i class="fa fa-edit-o"></i> Ubah
                                            </button>
                                            <button type ="button" name="btnHapus" class="btn red" id="id_btnHapus">
                                                <i class="fa fa-trash-o"></i> Hapus
                                            </button>

                                            <button id="id_btnBatal" type="reset" class="btn default"><i class="fa fa-refresh"></i> Batal</button>
                                        </div>
                                    </div>
                                </div>
                        </form>
                        <!-- END FORM-->
                    </div>    
                </div>

            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>


<!-- END PAGE CONTENT-->
<!--  MODAL APPROVAL -->
<div class="modal fade draggable-modal" id="idDivTabelUser" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data User</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="id_Reload" style="display: none;"></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">



                            </div>
                        </div>
                        <!-- end col-12 -->
                    </div>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal" id="btnCloseModalDataUser">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--  END MODAL APPROVAL -->
<?php $this->load->view('app.min.inc.php'); ?>
<script>
    jQuery(document).ready(function () {
          hiden();
          TableManaged.init();
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        //UITree.init();
       
     

    });
    window.onload = function () {

        $('#mobil').hide();
        $('#computer').hide();
        ;
    };

    function hiden() {
        document.getElementById('mobil').style.display = "none";
        document.getElementById('computer').style.display = "none";
        document.getElementById('genset').style.display = "none";
        document.getElementById('inventaris').style.display = "none";
    }

    function detail(elem) {
//    alert(elem);
        if (elem == '0') {
            hiden()
//        alert();
            document.getElementById('mobil').style.display = "block";
        } else if (elem == '1') {
            hiden()
//        alert();
            document.getElementById('computer').style.display = "block";
        } else if (elem == '2') {
            hiden()
//        alert();
            document.getElementById('genset').style.display = "block";
        } else if (elem == '3') {
            hiden()
//        alert();
            document.getElementById('inventaris').style.display = "block";
        } else {
            hiden();
        }
    }



    var TableManaged = function () {

        var initTable1 = function () {
            var table = $('#idTabelUser');
            // begin first table
            table.dataTable({
                "ajax": "<?php echo base_url("/parameter/master_groupasset/getUserInfo"); ?>",
                "columns": [
                    {"data": "kodegroup"},
                    {"data": "namagroup"},
                    {"data": "jenisasset"},
                    {"data": "metodesusut"},
                    {"data": "umurassetdalambulan"},
                    {"data": "statussusut"},
                    {"data": "persennilaisisa"},
                    {"data": "pembulatan"},
                    {"data": "waktumulaisusut"},
                    {"data": "formatkodeasset"},
                    {"data": "noakhirkodeasset"},
                    {"data": "merk_mobil"},
                    {"data": "type_mobil"},
                    {"data": "model_mobil"},
                    {"data": "warna_mobil"},
                    {"data": "norangka_mobil"},
                    {"data": "nomesin_mobil"},
                    {"data": "isisilinder_mobil"},
                    {"data": "tahunpembuatan_mobil"},
                    {"data": "merk_computer"},
                    {"data": "type_computer"},
                    {"data": "model_computer"},
                    {"data": "jenisprocessor_computer"},
                    {"data": "ram_computer"},
                    {"data": "sd_computer"},
                    {"data": "hdd_computer"},
                    {"data": "serialnumber_computer"},
                    {"data": "merk_genset"},
                    {"data": "type_genset"},
                    {"data": "model_genset"},
                    {"data": "kva_genset"},
                    {"data": "enginesn_genset"},
                    {"data": "noenginetype_genset"},
                    {"data": "alternatortype_genset"},
                    {"data": "alternatorsn_genset"},
                    {"data": "merk_inventaris"},
                    {"data": "typemodel_inventaris"},
                    {"data": "ukuran_inventaris"}

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
            table.on('click', 'tbody tr', function () {
                $("#navitab_2_2").trigger('click');
                var kodegroup = $(this).find("td").eq(0).html();
                var namagroup = $(this).find("td").eq(1).html();
                var jenisasset = $(this).find("td").eq(2).html();
                var metodesusut = $(this).find("td").eq(3).html();
                var umurassetdalambulan = $(this).find("td").eq(4).html();
                var statussusut = $(this).find("td").eq(5).html();
                var persennilaisisa = $(this).find("td").eq(6).html();
                var pembulatan = $(this).find("td").eq(7).html();
                var waktumulaisusut = $(this).find("td").eq(8).html();
                var formatkodeasset = $(this).find("td").eq(9).html();
                var noakhirkodeasset = $(this).find("td").eq(10).html();
                var merk_mobil = $(this).find("td").eq(11).html();
                var type_mobil = $(this).find("td").eq(12).html();
                var model_mobil = $(this).find("td").eq(13).html();
                var warna_mobil = $(this).find("td").eq(14).html();
                var norangka_mobil = $(this).find("td").eq(15).html();
                var nomesin_mobil = $(this).find("td").eq(16).html();
                var isisilinder_mobil = $(this).find("td").eq(17).html();
                var tahunpembuatan_mobil = $(this).find("td").eq(18).html();
                var merk_computer = $(this).find("td").eq(19).html();
                var type_computer = $(this).find("td").eq(20).html();
                var model_computer = $(this).find("td").eq(21).html();
                var jenisprocessor_computer = $(this).find("td").eq(22).html();
                var ram_computer = $(this).find("td").eq(23).html();
                var sd_computer = $(this).find("td").eq(24).html();
                var hdd_computer = $(this).find("td").eq(25).html();
                var serialnumber_computer = $(this).find("td").eq(26).html();
                var merk_genset = $(this).find("td").eq(27).html();
                var type_genset = $(this).find("td").eq(28).html();
                var model_genset = $(this).find("td").eq(29).html();
                var kva_genset = $(this).find("td").eq(30).html();
                var enginesn_genset = $(this).find("td").eq(31).html();
                var noenginetype_genset = $(this).find("td").eq(32).html();
                var alternatortype_genset = $(this).find("td").eq(33).html();
                var alternatorsn_genset = $(this).find("td").eq(34).html();
                var merk_inventaris = $(this).find("td").eq(35).html();
                var typemodel_inventaris = $(this).find("td").eq(36).html();
                var ukuran_inventaris = $(this).find("td").eq(37).html();



                $('#id_kodegroup').val(kodegroup);
                $('#id_namagroup').val(namagroup);
                $('#id_jenisasset').val(jenisasset);
                $('#id_metodesusut').val(metodesusut);
                $('#id_umurassetdalambulan').val(umurassetdalambulan);
                $('#id_statussusut').val(statussusut);
                $('#id_persennilaisisa').val(persennilaisisa);
                $('#id_pembulatan').val(pembulatan);
                $('#id_waktumulaisusut').val(waktumulaisusut);
                $('#id_formatkodeasset').val(formatkodeasset);
                $('#id_noakhirkodeasset').val(noakhirkodeasset);
                $('#id_merk_mobil').val(merk_mobil);
                $('#id_type_mobil').val(type_mobil);
                $('#id_model_mobil').val(model_mobil);
                $('#id_warna_mobil').val(warna_mobil);
                $('#id_norangka_mobil').val(norangka_mobil);
                $('#id_nomesin_mobil').val(nomesin_mobil);
                $('#id_isisilinder_mobil').val(isisilinder_mobil);
                $('#id_tahunpembuatan_mobil').val(tahunpembuatan_mobil);
                $('#id_merk_computer').val(merk_computer);
                $('#id_type_computer').val(type_computer);
                $('#id_model_computer').val(model_computer);
                $('#id_jenisprocessor_computer'). val (jenisprocessor_computer);
                $('#id_ram_computer').val(ram_computer);
                $('#id_sd_computer').val(sd_computer);
                $('#id_hdd_computer').val(hdd_computer);
                $('#id_serialnumber_computer').val(serialnumber_computer);
                $('#id_merk_genset').val(merk_genset);
                $('#id_type_genset').val(type_genset);
                $('#id_model_genset').val(model_genset);
                $('#id_kva_genset').val(kva_genset);
                $('#id_enginesn_genset').val(enginesn_genset);
                $('#id_noenginetype_genset').val(noenginetype_genset);
                $('#id_alternatorsn_genset').val (alternatorsn_genset);
                $('#id_merk_inventaris').val (merk_inventaris);
                $('#id_typemodel_inventaris').val (typemodel_inventaris);
                $('#id_ukuran_inventaris').val (ukuran_inventaris);
                
                
                
                $('#id_kab').val(kode_kab);
                $('#id_prop').val(kode_propinsi);
                $('#id_namaKab').val(nm_kab);
                $('#id_btnHapus').attr('disabled', false);
                $('#id_btnUbah').attr('disabled', false);
                $('#id_btnSimpan').attr('disabled', true);
//                $('#id_karyawan').val(id_kyw);
//                $('#id_kataKunci').val(passwd);
//                $('#id_confKataKunci').val(passwd);
//                $('#id_groupUser').val(userGroup);
//                //$('#').val();
//                $('#id_userName').focus();

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
    jQuery(document).ready(function () {
        TableManaged.init();
    });
    btnStart();
    $("#id_userName").focus();
    $("#id_showPassword").click(function () {
        if ($('#id_chckshowPassword').is(':checked')) {
            $('.clsPasswd').attr('type', 'text');
        } else {
            $('.clsPasswd').attr('type', 'password');
        }
    });
    $("#id_btnSimpan").click(function () {
        $('#idTmpAksiBtn').val('1');
        var passwd = $('#id_kataKunci').val();
        var confPasswd = $('#id_confKataKunci').val();
        if (passwd == confPasswd) {
            return true;
        } else {
            alert("Password dan konfirmasi password tidak sama.");
            $("#id_password").focus();
            return false;
        }
    });

    $('#id_btnBatal').click(function () {
        btnStart();
    });

    $("#id_btnSimpan").click(function () {
        $('#idTmpAksiBtn').val('1');
        bootbox.confirm("Apakah anda yakin menyimpan data ini?", function (o) {
            if (o == true) {
                $('#idFormUser').submit();
            }
        });

    });
    $("#id_btnUbah").click(function () {
        $('#idTmpAksiBtn').val('2');
        bootbox.confirm("Apakah anda yakin mengubah data ini?", function (o) {
            if (o == true) {
                $('#idFormUser').submit();
            }
        });

    });

    $("#id_btnHapus").click(function () {
        $('#idTmpAksiBtn').val('3');
        bootbox.confirm("Apakah anda yakin menghapus data ini?", function (o) {
            if (o == true) {
                $('#idFormUser').submit();
            }
        });

    });

</script>


<!-- END JAVASCRIPTS -->