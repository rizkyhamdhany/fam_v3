<script>
    var dataTable;
    var iSearch = 'BranchName';

    jQuery(document).ready(function () {
        loadGridMutation();

    });
    // jQuery(document).ready(function () {
    //     TableManaged.init();
    // });
    btnStart();

    function search(e) {
        iSearch = e;
    }
    
    function loadGridMutation() {
        dataTable = $('#table_gridMutation').DataTable({
            dom: 'C<"clear">l<"toolbar">frtip',
            initComplete: function () {
                $("div.toolbar").append('<div class="col-md-8">\n\
            <div class="row">\n\
                <div class="col-md-6"></div>\n\
                <div class="col-md-3 text-right">Search Param</div>\n\
                <div class="col-md-3">\n\
                    <select id="cat_itemclass" name="cat_itemclass" onchange="search(this.value)" class="form-control">\n\
                        <option value="BranchName">Branch</option>\n\
                        <option value="ItemName">Item Name</option>\n\
                    </select>\n\
                </div>\n\
            </div>\n\
        </div>');
            },
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
//                // set the initial value
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("operational/mutationinventaris/ajax_GridMutation"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sSearch = iSearch;
                },
                error: function () {  // error handling
                    $(".table_gridMutation-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_gridMutation tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_gridMutation_processing").css("display", "none");

                }
            },
            "columnDefs": [
                {"targets": [0], "orderable": false, "searchable": false},
//                {"targets": [0], "orderable": false},
//                {"targets": [1], "orderable": false},
//                {"targets": [2], "orderable": false},
//                {"targets": [3], "orderable": false},
//                {"targets": [4], "orderable": false},
//                {"targets": [5], "orderable": false},
//                {"targets": [6], "orderable": false},
//                {"targets": [7], "orderable": false},
//                {"targets": [8], "orderable": false},
//                {"targets": [9], "visible": false, "searchable": false},
//                {"targets": [10], "visible": false, "searchable": false},
//                {"targets": [11], "visible": false, "searchable": false},
            ],
        });
    }

</script>