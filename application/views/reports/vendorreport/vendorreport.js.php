<script>
    var i1 = "";
    var i2 = "";
    var i3 = "";
    var i4 = "";
    var i5 = "";
    var i6 = "";
    var i7 = "";
    var i8 = "";
    var i9 = "";
    var i10 = "";
    var i11 = "";
    jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        loadGridVendor();

    });
    // jQuery(document).ready(function () {
    //     TableManaged.init();
    // });
    btnStart();

    $("#fm_param").submit(function (e) {
        e.preventDefault();
        $('#divGrid').show();
        $('#table_gridVendor').DataTable().ajax.reload();
        $('#id_downlod').fadeIn('slow');
        $('#id_downlod').attr('href', "<?php echo base_url() . 'reports/vendorreport/downloadReport?' ?>" + $('form#fm_param').serialize());
    });

    function sch(e) {
        console.log(e.value);
        if (e.name == "ias") {
            i1 = e.value;
        }
        if (e.name == "deskripsi") {
            i2 = e.value;
        }
        if (e.name == "vendor") {
            i3 = e.value;
        }
        if (e.name == "kwi") {
            i4 = e.value;
        }
        if (e.name == "Fpur") {
            i5 = e.value;
        }
        if (e.name == "Nomor") {
            i6 = e.value;
        }
        if (e.name == "nominal") {
            i7 = e.value;
        }
        if (e.name == "tgl_upload_doc") {
            i8 = e.value;
        }
        if (e.name == "tgl_dibayar") {
            i9 = e.value;
        }
        if (e.name == "status_doc") {
            i10 = e.value;
        }
        if (e.name == "status_pembayaran") {
            i11 = e.value;
        }
        $('#table_gridVendor').DataTable().ajax.reload();
    }

    function loadGridVendor() {
        var table2 = $('#table_gridVendor');
        table2.dataTable({
            "ajax": {
                "url": "<?php echo base_url("/reports/vendorreport/ajax_GridVendor"); ?>",
                "type": "POST",
                "data": function (z) {
                    z.from = $('#from').val();
                    z.to = $('#to').val();
                    z.branch = $('#id_branch').val();
                    z.vendor = $('#id_vendor').val();
                    z.status = $('#status').val();
                    z.s1 = i1;
                    z.s2 = i2;
                    z.s3 = i3;
                    z.s4 = i4;
                    z.s5 = i5;
                    z.s6 = i6;
                    z.s7 = i7;
                    z.s8 = i8;
                    z.s9 = i9;
                    z.s10 = i10;
                    z.s11 = i11;
                }
            },
            "columns": [
                {"data": "no"},
                {"data": "ias"},
                {"data": "deskripsi"},
                {"data": "vendor"},
                {"data": "kwi"},
                {"data": "Fpur"},
                {"data": "Nomor"},
                {"data": "nominal"},
                {"data": "tgl_upload_doc"},
                {"data": "tgl_dibayar"},
                {"data": "status_doc"},
                {"data": "status_pembayaran"},
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
    }


</script>