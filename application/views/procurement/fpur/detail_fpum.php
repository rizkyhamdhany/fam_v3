<!-- BEGIN PAGE BREADCRUMB --> 

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
                    <span class="caption-subject font-red sbold uppercase">FORM FPUR</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <form role="form"  method="post" id="id_from_sec_group_user" enctype="multipart/form-data" action="<?php echo base_url('procurement/fpur/update_fpum/'.$ias->ID_PR); ?>">
                <div class="form-horizontal col-md-12">
                    <div class="form-group col-md-12">
                        <label class="col-sm-4 control-label" style="text-align: left;">No PR</label>
                        <div class="col-sm-4">
                            <input type="hidden" name="id_pr" value="<?php echo $ias->ID_PR?>">
                            <p class="form-control-static"><?php echo $ias->ID_PR?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-4 control-label" style="text-align: left;">No PA</label>
                        <div class="col-sm-4">
                            <input type="hidden" name="id_pa" value="<?php echo $ias->ID_PA?>">
                            <p class="form-control-static"><?php echo $ias->ID_PA?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-4 control-label" style="text-align: left;">No PO</label>
                        <div class="col-sm-4">
                            <input type="hidden" name="id_po" value="<?php echo $ias->ID_PO?>">
                            <p class="form-control-static"><?php echo $ias->ID_PO?></p>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <h5><strong>List Item</strong></h5>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Item ID</th>
                                    <th scope="col">Item NAME</th>
                                    <th scope="col">QTY</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($all_item as $bar){ ?>
                                <tr>
                                    <td><?php echo $bar->ITEM_ID?></td>
                                    <td><?php echo $bar->NAMA_BARANG?></td>
                                    <td><?php echo $bar->QTY?></td>
                                    <td><?php echo $bar->HARGA?></td>
                                    <td><?php echo $bar->TTL_HARGA?></td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="id_po_detail" value="<?php echo $dpp->ID_PO_DETAIL;?>">
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">DPP</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="dpp" id="dpp" value="<?php echo $dpp->TOTAL;?>" type="number" readonly>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">PPN</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" value="<?php echo $dpp->PPN;?>" name="ppn" id="ppn" type="number" readonly>
                        </div>
                        <!-- <div class="col-sm-3">
                            <input class="form-control m-input" value="10" name="presentase" id="presentase" type="number" readonly>
                        </div>
                        <div class="col-sm-3">
                            <button type="button" class="btn red" id="edit_presentase">Edit</button>
                        </div> -->
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">PPH</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="pph" id="pph" value="<?php echo $dpp->PPH;?>" type="number" readonly>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">Denda</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="denda" id="denda" type="number" readonly>
                        </div>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="dendas" id="dendas" type="number" value="<?php echo $total?>" readonly>
                        </div>
                        <div class="col-sm-3">
                            <label class="mt-checkbox">
                                <input type="checkbox" id="cek">
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">Nilai Dibayarkan</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" type="number" id="dibayarkan" name="dibayarkan" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="form-group m-form__group m--margin-top-10">
                    <h5 class="m-portlet__head-text"><strong>FPUR</strong></h5>
                </div>
                <div class="form-horizontal col-md-12">
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">Type FPUR</label>
                        <div class="col-sm-3">
                            <input type="radio" name="type_fpur" value="0"> Reimbursement
                        </div>
                        <div class="col-sm-3">
                            <input type="radio" name="type_fpur" value="1"> UM-FPUR
                        </div>
                    </div>
                </div>
                <div class="form-horizontal col-md-12">
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">NO FPUR</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="no_fpur" id="type_fpur" type="text" required>
                        </div>
                    </div>
                </div>
                <div class="form-horizontal col-md-12">
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">Jumlah</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="jumlah" id="type_fpur" type="text" required>
                        </div>
                    </div>
                </div>
                <div class="form-horizontal col-md-12">
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">Nama Rekening</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="nama_rekening" id="type_fpur" type="text" required>
                        </div>
                    </div>
                </div>
                <div class="form-horizontal col-md-12">
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">No Rekening</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="no_rekening" id="type_fpur" type="text" required>
                        </div>
                    </div>
                </div>
                <div class="form-horizontal col-md-12">
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">Bank</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="bank" id="type_fpur" type="text" required>
                        </div>
                    </div>
                </div>
                <div class="form-horizontal col-md-12">
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">Alamat Bank</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="alamat_bank" id="type_fpur" type="text" required>
                        </div>
                    </div>
                </div>
                <div class="form-horizontal col-md-12">
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">Dokumen Kelengkapan</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="dokumen_kelengkapan" id="type_fpur" type="text" required>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group m--margin-top-10">
                    <h5 class="m-portlet__head-text"><strong>FPUM</strong></h5>
                </div>
                <div class="form-horizontal col-md-12">
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">NO FPUM</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="no_fpum" id="type_fpur" type="text" required>
                        </div>
                    </div>
                </div>
                <div class="form-horizontal col-md-12">
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">Keterangan Jumlah</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="ket_jumlah_fpum" id="type_fpur" type="text" required>
                        </div>
                    </div>
                </div>
                <div class="form-horizontal col-md-12">
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">Jumlah</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="jumlah_fpum" id="type_fpur" type="text" required>
                        </div>
                    </div>
                </div>
                <div class="form-horizontal col-md-12">
                    <div class="form-group col-md-12">
                        <label class="col-sm-3 control-label" style="text-align: left;">Dokumen Kelengkapan</label>
                        <div class="col-sm-3">
                            <input class="form-control m-input" name="dokumen_kelengkapan_fpum" id="type_fpur" type="text" required>
                        </div>
                    </div>
                </div>
               
                <a href="<?php echo base_url('procurement/ias/home')?>" class="btn red">Cancel</a>
                <button type="submit" class="btn blue">Send</button>
                </form>

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
$("#cek").change(function() {
    if(this.checked) {
        $('#denda').val($('#dendas').val());
        var dpp = parseInt($("input[name='dpp']").val());
        var ppn = parseInt($("input[name='ppn']").val());
        var pph = parseInt($("input[name='pph']").val());
        var denda = parseInt($("input[name='denda']").val());

        $("input[name='dibayarkan']").val(dpp + ppn - pph - denda);
    }else{
        $('#denda').val(0);
        var dpp = parseInt($("input[name='dpp']").val());
        var ppn = parseInt($("input[name='ppn']").val());
        var pph = parseInt($("input[name='pph']").val());
        var denda = parseInt($("input[name='denda']").val());
        $("input[name='dibayarkan']").val(dpp + ppn - pph - denda);
    }
});
$("input[name='dpp']").on("keyup", function(){
    var dpp = parseInt($(this).val());
    var ppn = parseInt($("input[name='ppn']").val());
    var pph = parseInt($("input[name='pph']").val());
    var denda = parseInt($("input[name='denda']").val());

    $("input[name='dibayarkan']").val(dpp + ppn - pph - denda);
});

$("input[name='ppn']").on("keyup", function(){
    var dpp = parseInt($("input[name='dpp']").val());
    var ppn = parseInt($(this).val());
    var pph = parseInt($("input[name='pph']").val());
    var denda = parseInt($("input[name='denda']").val());

    $("input[name='dibayarkan']").val(dpp + ppn - pph - denda);
});

$("input[name='pph']").on("keyup", function(){
    var dpp = parseInt($("input[name='dpp']").val());
    var ppn = parseInt($("input[name='ppn']").val());
    var pph = parseInt($(this).val());
    var denda = parseInt($("input[name='denda']").val());

    $("input[name='dibayarkan']").val(dpp + ppn - pph - denda);
});

$("input[name='denda']").on("keyup", function(){
    var dpp = parseInt($("input[name='dpp']").val());
    var ppn = parseInt($("input[name='ppn']").val());
    var pph = parseInt($("input[name='pph']").val());
    var denda = parseInt($(this).val());

    $("input[name='dibayarkan']").val(dpp + ppn - pph - denda);
});

$('#edit_presentase').click(function(){
    $('#presentase').attr('readonly', false);
});

$("#presentase").on("keyup", function(){
    var dpp = parseInt($("input[name='dpp']").val());
    var presentase = parseInt(dpp*($(this).val()/100));
    var ppn = $("input[name='ppn']").val(presentase);
    var pph = parseInt($("input[name='pph']").val());
    var denda = parseInt($("input[name='denda']").val());
    console.log(dpp + presentase + pph + denda);

    $("input[name='dibayarkan']").val(dpp + presentase - pph - denda);
});

var return_data = "<?php echo $var;?>";
var doc_data = "<?php echo $doc;?>"

$('#dok1').html(doc_data);
$('#varia1').html(return_data);
// $('.varia').(function() {   
//      $.ajax({
//       url: "<?php echo base_url('procurement/ias/get_var');?>",
//       type: 'post',
//       cache: false,
//       success: function(return_data) {
//          $('.varia').html(return_data);
//       }
//    });
// });

var num = 1;

$(document).on('click', '.datepicker', function(){
   $(this).datepicker({
        orientation: "left",
        format: "dd/mm/yyyy",
        autoclose: true
    }).focus();
   $(this).removeClass('datepicker');
});

$("#add_doc").click(function(){
    num++;
    $('.dokumen').append('<div class="form-group m-form__group col-md-4"><label for="exampleInputtext1">Nama Dokumen</label><select class="form-control m-input dok" id="dok'+num+'" name="nama_dokumen[]" required><option value="">Pilih Dokumen</option></select></div><div class="form-group m-form__group col-md-4"><label for="exampleInputtext1">No Dokumen</label><input type="text" class="form-control m-input"  name="no_dokumen[]" required></div><div class="form-group m-form__group col-md-4"><label for="exampleInputtext1">Tanggal</label><input type="text" class="form-control m-input datepicker" name="tanggal[]" required></div>');

    $('#dok'+num+'').html(doc_data);
});

$("#add_val").click(function(){
    num++;
    $('.penilaian').append('<input type="hidden" name="variable[]" id="variable'+num+'"><input type="hidden" name="vars[]" id="vars'+num+'"><div class="form-group m-form__group col-md-4"><label for="exampleInputtext1">Variable</label><select id="varia'+num+'" class="form-control m-input varia" name="varia[]" required><option value="">Pilih Variabel</option></select></div><div class="form-group m-form__group col-md-4"><label for="exampleInputtext1">Penilaian</label><input type="number" id="nilai'+num+'" class="form-control m-input" name="penilaian[]" required></div><div class="form-group m-form__group col-md-4"><label for="exampleInputtext1">Penilaian X Bobot</label><input type="text" class="form-control m-input pxb" id="pxb'+num+'" name="pxb[]" required></div>');

    $('#varia'+num+'').html(return_data);

    $("input[name='penilaian[]']").on("keyup", function(){
        var total = $(this).val();
        var id = $(this).attr('id');
        var lastid = id.substring(id.length-1, id.length);
        var exp = $('#varia'+lastid+'').val().split('-');
        var percent = exp[0]/100;
        $('#vars'+lastid+'').val(exp[0]);
        $('#pxb'+lastid+'').val(percent*total);
        var sum = 0;
        $('.pxb').each(function(){
            sum += parseFloat($(this).val());
            $('#akhir').val(sum);
        });
    });

    $(".varia").change(function(){
        var id = $(this).attr('id');
        var lastid = id.substring(id.length-1, id.length);
        var total = $('#nilai'+lastid+'').val();
        var exp = $(this).val().split('-');
        $('#variable'+lastid+'').val(exp[1]);
        var percent = exp[0]/100;
        $('#vars'+lastid+'').val(exp[0]);
        $('#pxb'+lastid+'').val(percent*total);
        var sum = 0;
        $('.pxb').each(function(){
            sum += parseFloat($(this).val());
            $('#akhir').val(sum);
        });
    });

});


$("#varia1").change(function(){
        var id = $(this).attr('id');
        var lastid = id.substring(id.length-1, id.length);
        var total = $('#nilai'+lastid+'').val();
        var exp = $(this).val().split('-');
        $('#variable'+lastid+'').val(exp[1]);
        var percent = exp[0]/100;
        $('#vars'+lastid+'').val(exp[0]);
        $('#pxb'+lastid+'').val(percent*total);
        var sum = 0;
        $('.pxb').each(function(){
            sum += parseFloat($(this).val());
            $('#akhir').val(sum);
        });
    });

    $("#nilai1").on("keyup", function(){
        var total = $(this).val();
        var id = $(this).attr('id');
        var lastid = id.substring(id.length-1, id.length);
        var exp = $('#varia'+lastid+'').val().split('-');
        var percent = exp[0]/100;
        $('#vars'+lastid+'').val(exp[0]);
        $('#pxb'+lastid+'').val(percent*total);
        var sum = 0;
        $('.pxb').each(function(){
            console.log(parseFloat($(this).val()));
            sum += parseFloat($(this).val());
            $('#akhir').val(sum);
        });
        console.log(sum);
    });


</script>


<!-- END JAVASCRIPTS