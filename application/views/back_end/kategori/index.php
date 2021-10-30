<?= $controller_name = $this->uri->segment(1); ?>
<div class="content">
    <div id="notif-apps">
    </div>
    <div class="container-fluid" id="tujuan"></div>
    <div class="container-fluid" id="utama">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title"><?= $title_page ?></h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?= $pengelolaan ?></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <button class="btn btn-primary mb-2" onclick="add()"><i class="fa fa-plus"></i> Data</button>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Kategori</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Tanggal Diperbaharui</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->



    </div> <!-- container-fluid -->

</div> <!-- content -->

<script>
    $(document).ready(function() {
        view();
    });

    function view() {
        $('#datatable-buttons').dataTable().fnDestroy();
        $('#datatable-buttons').DataTable({
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                "url": GLOBAL_C + '/get',
                "type": "POST"
            }
        });
    }


    function add() {
        $('#notif-apps').html('');
        $.get(GLOBAL_C + '/form', function(result) {
            $('#utama').hide();
            $('#tujuan').show();
            $('#tujuan').html(result);
            $('#form-ajax')[0].reset();
        });
    }

    function edit(id) {
        $('#notif-apps').html('');
        $.get(GLOBAL_C + '/formedit/' + id, function(result) {
            $('#utama').hide();
            $('#tujuan').show();
            $('#tujuan').html(result);
        });
    }

    function batal() {
        $('#utama').show();
        $('#tujuan').hide();
    }

    function hapus(id) {

        Swal.fire({
            title: "Anda Yakin?",
            text: "Menghapus data terpilih?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ec536c",
            cancelButtonColor: "#bb7be3",
            confirmButtonText: "Ya hapus"
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: GLOBAL_C + '/act/hapus',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#notif-apps').html('');
                        $('#notif-apps').html(data.msg);
                        setInterval(function() {
                            $('#notif-apps').html('');
                        }, 3000);
                        if (data.status == 20) {
                            view();
                            Swal.fire("Berhasil!", "Data Berhasil dihapus!", "success");
                        }
                    },
                    error: function(data) {

                    }
                });
            }
        });
    }
</script>