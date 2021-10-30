<?php
$cont = $this->uri->segment(1);
?>
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
    <div class="col-lg-12">
        <div class="card m-b-20">
            <div class="card-body">
                <button class="btn btn-danger mb-3" onclick="batal()"><i class="fa fa-reply"></i> Batal</button>
                <form method="POST" id="form-ajax" autocomplete="off" action="<?= base_url($cont . '/act/edit') ?>" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Nama Kategori</label>
                            <input type="text" class="form-control" name="id" value="<?= $kategori['id'] ?>" required />
                            <input type="text" class="form-control" name="nama_kategori" value="<?= $kategori['nama_kategori'] ?>" required placeholder="Masukkan Nama Produk.." />
                        </div>
                        <!-- <div class="col-6">
                            <label>Image</label>
                            <input type="file" class="form-control" name="userfile" accept="image/png, image/gif, image/jpeg, image/jpg" />
                            <small class="text-danger">hanya menerima ext .png, .gif, .jpeg</small>
                        </div> -->
                    </div>
                    <?php
                    if ($kategori['img'] != null) :
                    ?>
                        <!-- <div class="form-group">
                            <label>Gambar Lama</label>
                            <img class="img-thumbnail form-control" style="width:17%;height:auto;" src="<?= PATH_FILE . $kategori['img'] ?>">
                        </div> -->
                    <?php
                    endif;
                    ?>
                    <div class="form-group mb-0">
                        <div>
                            <button type="submit" class="btn btn-warning waves-effect waves-light mr-1">
                                Edit
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
        e.preventDefault();
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