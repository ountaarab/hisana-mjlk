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
                            <label>Kategori</label>
                            <select class="form-control" name="kategori">
                                <?php
                                $select_kategori = '';
                                foreach ($kategori as $baris) :
                                    if ($produk['kategori'] == $baris->nama_kategori) :
                                        $select_kategori = ' selected';
                                    endif;
                                ?>
                                    <option value="<?= $baris->nama_kategori ?>" <?= $select_kategori ?>><?= $baris->nama_kategori ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label>Nama Produk</label>
                            <input type="hidden" class="form-control" name="id" value="<?= $produk['id'] ?>" required />
                            <input type="text" class="form-control" name="nama_produk" value="<?= $produk['nama_produk'] ?>" required placeholder="Masukkan Nama Produk.." />
                        </div>
                        <div class="col-6">
                            <label>Harga Beli</label>
                            <input type="text" class="form-control" name="harga_beli" value="<?= $produk['harga_beli'] ?>" required placeholder="Masukkan Harga Beli.." />
                        </div>
                        <div class="col-6">
                            <label>Harga jual</label>
                            <input type="text" class="form-control" name="harga_jual" value="<?= $produk['harga_jual'] ?>" required placeholder="Masukkan Harga jual.." />
                        </div>
                        <div class="col-6">
                            <label>Qty</label>
                            <input type="text" class="form-control" name="qty" value="<?= $produk['qty'] ?>" required placeholder="Masukkan Qty.." />
                        </div>
                        <!-- <div class="col-6">
                            <label>Image</label>
                            <input type="file" class="form-control" name="userfile" accept="image/png, image/gif, image/jpeg, image/jpg" />
                            <small class="text-danger">hanya menerima ext .png, .gif, .jpeg</small>
                        </div> -->
                    </div>
                    <?php
                    if ($produk['img'] != null) :
                    ?>
                        <!-- <div class="form-group">
                            <label>Gambar Lama</label>
                            <img class="img-thumbnail form-control" style="width:17%;height:auto;" src="<?= PATH_FILE . $produk['img'] ?>">
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