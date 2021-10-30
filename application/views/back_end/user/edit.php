<?= $controller_name = $this->uri->segment(1); ?>
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
                <form method="POST" id="form-ajax" autocomplete="off" action="<?= base_url($controller_name . '/act/edit') ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="hidden" class="form-control" value="<?= $user['id'] ?>" name="id" required placeholder="Masukkan NIP.." />
                        <input type="text" readonly class="form-control" value="<?= $user['nip'] ?>" name="nip" required placeholder="Masukkan NIP.." />
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" value="<?= $user['nama_lengkap'] ?>" required placeholder="Masukkan Nama Lengkap.." />
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" required placeholder="Masukkan Jabatan.." value="<?= $user['jabatan'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Role User</label>
                        <select class="form-control" name="role" required>
                            <option>Pilih</option>
                            <?php
                            $role_now = $user['role'];
                            $su = '';
                            $wd = '';
                            $opd_now = '';
                            if ($role_now == 'su') :
                                $su = ' selected';
                            endif;
                            if ($role_now == 'wd') :
                                $wd = ' selected';
                            endif;
                            if ($role_now == 'opd') :
                                $opd_now = ' selected';
                            endif;
                            ?>
                            <option value="su" <?= $su ?>>Super User</option>
                            <option value="wd" <?= $wd ?>>Wali Data</option>
                            <option value="opd" <?= $opd_now ?>>OPD</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>OPD</label>
                        <select class="form-control" name="id_opd" required>
                            <option>Pilih</option>
                            <?php
                            if (!empty($opd)) :
                                foreach ($opd->result() as $baris) :
                                    $pilih = '';
                                    if ($baris->id == $user['id_opd']) :
                                        $pilih = 'selected';
                                    endif;
                            ?>
                                    <option value="<?= $baris->id ?>" <?= $pilih ?>><?= $baris->nama ?></option>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
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