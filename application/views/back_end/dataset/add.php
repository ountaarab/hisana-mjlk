<?php
$controller_name = $this->uri->segment(1);
$role_aktif = $this->session->userdata('role');
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
            <form method="POST" id="form-ajax" autocomplete="off" action="<?= base_url($controller_name . '/act/add') ?>" enctype="multipart/form-data">
                <div class="card-body">
                    <button class="btn btn-danger mb-3" onclick="batal()"><i class="fa fa-reply"></i> Batal</button>
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="judul" required placeholder="Masukkan Judul.." />
                    </div>
                    <div class="form-group">
                        <label>Pengukuran</label>
                        <input type="text" class="form-control" name="pengukuran" required placeholder="Masukkan Pengukuran.." />
                    </div>
                    <div class="form-group row">
                        <?php
                        if ($role_aktif != 'opd') :
                        ?>
                            <div class="col-6">
                                <label>Produsen</label>
                                <select class="form-control select2" name="id_opd" id="id_opd" required>
                                    <?php
                                    if (!empty($opd)) :
                                    ?>
                                        <option>--Pilih--</option>
                                        <?php
                                        foreach ($opd->result() as $baris) :
                                        ?>
                                            <option value="<?= $baris->id ?>"><?= $baris->nama ?></option>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                        <?php
                        endif;
                        ?>
                        <div class="col-6">
                            <label>Topik</label>
                            <select class="form-control select2" name="id_topik" id="id_topik" required>
                                <?php
                                if (!empty($topik)) :
                                ?>
                                    <option>--Pilih--</option>
                                    <?php
                                    foreach ($topik->result() as $baris) :
                                    ?>
                                        <option value="<?= $baris->id ?>"><?= $baris->nama_topik ?></option>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-5">
                            <label>Satuan</label>
                            <input type="text" class="form-control" name="satuan" required placeholder="Masukkan Satuan.." />
                        </div>
                        <div class="col-3">
                            <label>Versi</label>
                            <input type="number" class="form-control" name="versi" required placeholder="Masukkan Versi.." />
                        </div>
                        <div class="col-4">
                            <label>Tahun Tersedia</label>
                            <select class="form-control" name="tahun_tersedia" required>
                                <option>--Pilih--</option>
                                <?php
                                for ($i = 2010; $i <= intval(date('Y')); $i++) {
                                ?>
                                    <option><?= $i ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" id="FormControlDescriptItem" name="deskripsi" rows="5" style="resize: none;"></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label>Tingkat Penyajian</label>
                            <select class="form-control select2" name="tingkat_penyajian" id="tingkat_penyajian" required>
                                <?php
                                if (!empty($tingkat_penyajian)) :
                                ?>
                                    <option>--Pilih--</option>
                                    <?php
                                    foreach ($tingkat_penyajian->result() as $baris) :
                                    ?>
                                        <option value="<?= $baris->tingkat_penyajian ?>"><?= $baris->tingkat_penyajian ?></option>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <label>Cakupan</label>
                            <input type="text" class="form-control" name="cakupan" required placeholder="Masukkan Cakupan.." />
                        </div>
                        <div class="col-4">
                            <label>Frekuensi</label>
                            <select class="form-control" name="frekuensi" required>
                                <option>--Pilih--</option>
                                <option value="Bulanan">Bulanan</option>
                                <option value="Triwulan">Triwulan</option>
                                <option value="Tahunan">Tahunan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Lampiran Dataset</label>
                        <input type="file" name="userfile" accept=".csv" class="form-control" required>
                    </div>
                    <div class="form-group mb-0">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Simpan
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect">
                                Reset
                            </button>
                            <hr>
                            <button class="btn btn-danger mb-3" onclick="batal()"><i class="fa fa-reply"></i> Batal</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div> <!-- end col -->
</div>

<script>
    $(document).ready(function() {
        $(".select2").select2();
        tinymce.remove();
        tinymce.init({
            selector: 'textarea',
            menubar: '',
            theme: 'modern'
        });
    });

    $('#form-ajax').submit(function(e) {
        tinymce.triggerSave(true, true);
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
                }, 7000);
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