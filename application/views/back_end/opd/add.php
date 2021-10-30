<?php $controller_name = $this->uri->segment(1); ?>
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
<div class="row">
    <div class="col-lg-6">
        <div class="card m-b-20">
            <div class="card-body">
                <button class="btn btn-danger mb-3" onclick="batal()"><i class="fa fa-reply"></i> Batal</button>
                <form method="POST" id="form-ajax" autocomplete="off" action="<?= base_url($controller_name . '/act/add') ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama OPD</label>
                        <input type="text" class="form-control" name="nama" required placeholder="Masukkan Nama OPD.." />
                    </div>
                    <div class="form-group">
                        <label>Nama Alias OPD</label>
                        <input type="text" class="form-control" name="alias" required placeholder="Masukkan Nama Alias OPD.." />
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" rows="3" style="resize:none" name="alamat" placeholder="Masukkan Alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label>No. Telp</label>
                        <input type="number" class="form-control" name="no_telepon" required placeholder="Masukkan No Telp.." />
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="userfile" accept="image/png, image/gif, image/jpeg, image/jpg" />
                        <small class="text-danger">hanya menerima ext .png, .gif, .jpeg</small>
                    </div>
                    <div class="form-group mb-0">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Simpan
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect">
                                Reset
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div> <!-- end col -->
</div>

<script>
    $('#form-ajax').submit(function(e) {
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                data = JSON.parse(data);
                $('#notif-apps').html('');
                $('#notif-apps').html(data.msg);
                setInterval(function() {
                    $('#notif-apps').html('');
                }, 3000);
                if (data.status == 20) {
                    view();
                    batal();
                }
            },
            error: function(data) {

            }
        });
        e.preventDefault();
    });
</script>