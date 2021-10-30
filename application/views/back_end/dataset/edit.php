<?php
$controller_name = $this->uri->segment(1);
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
                <form method="POST" id="form-ajax" autocomplete="off" action="<?= base_url($controller_name . '/act/edit') ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="hidden" class="form-control" value="<?= $dataset['id'] ?>" name="id" required placeholder="Masukkan Judul.." />
                        <input type="text" class="form-control" value="<?= $dataset['judul'] ?>" name="judul" required placeholder="Masukkan Judul.." />
                    </div>
                    <div class="form-group">
                        <label>Pengukuran</label>
                        <input type="text" class="form-control" value="<?= $dataset['pengukuran'] ?>" name="pengukuran" required placeholder="Masukkan Pengukuran.." />
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Produsen</label>
                            <select class="form-control select2" name="id_opd" id="id_opd" required>
                                <?php
                                if (!empty($opd)) :
                                ?>
                                    <option>--Pilih--</option>
                                    <?php
                                    foreach ($opd->result() as $baris) :
                                        $pilih = '';
                                        if ($baris->id == $dataset['id_opd']) :
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
                        <div class="col-6">
                            <label>Topik</label>
                            <select class="form-control select2" name="id_topik" id="id_topik" required>
                                <?php
                                if (!empty($topik)) :
                                ?>
                                    <option>--Pilih--</option>
                                    <?php
                                    foreach ($topik->result() as $baris) :
                                        $pilih = '';
                                        if ($baris->id == $dataset['id_topik']) :
                                            $pilih = 'selected';
                                        endif;
                                    ?>
                                        <option value="<?= $baris->id ?>" <?= $pilih ?>><?= $baris->nama_topik ?></option>
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
                            <input type="text" class="form-control" value="<?= $dataset['satuan'] ?>" name="satuan" required placeholder="Masukkan Satuan.." />
                        </div>
                        <div class="col-3">
                            <label>Versi</label>
                            <input type="number" class="form-control" name="versi" value="<?= $dataset['versi'] ?>" required placeholder="Masukkan Versi.." />
                        </div>
                        <div class="col-4">
                            <label>Tahun Tersedia</label>
                            <select class="form-control" name="tahun_tersedia" required>
                                <option>--Pilih--</option>
                                <?php
                                for ($i = 2010; $i <= intval(date('Y')); $i++) {
                                    $pilih = '';
                                    if ($i == $dataset['tahun_tersedia']) :
                                        $pilih = 'selected';
                                    endif;
                                ?>
                                    <option value="<?= $i ?>" <?= $pilih ?>><?= $i ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5" required style="resize: none;"></textarea>
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
                                        $pilih = '';
                                        if ($dataset['tingkat_penyajian'] == $baris->tingkat_penyajian) :
                                            $pilih = ' selected';
                                        endif;
                                    ?>
                                        <option value="<?= $baris->tingkat_penyajian ?>" <?= $pilih ?>><?= $baris->tingkat_penyajian ?></option>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <label>Cakupan</label>
                            <input type="text" class="form-control" name="cakupan" required placeholder="Masukkan Cakupan.." value="<?= $dataset['cakupan'] ?>""/>
                        </div>
                        <div class=" col-4">
                            <label>Frekuensi</label>
                            <select class="form-control" name="frekuensi" required>
                                <option>--Pilih--</option>
                                <?php
                                $b = '';
                                $tw = '';
                                $t = '';
                                if ($dataset['frekuensi'] == 'Bulanan') :
                                    $b = 'selected';
                                endif;
                                if ($dataset['frekuensi'] == 'Triwulan') :
                                    $tw = 'selected';
                                endif;
                                if ($dataset['frekuensi'] == 'Tahunan') :
                                    $t = 'selected';
                                endif;
                                ?>
                                <option value="Bulanan" <?= $b ?>>Bulanan</option>
                                <option value="Triwulan" <?= $tw ?>>Triwulan</option>
                                <option value="Tahunan" <?= $t ?>>Tahunan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <?php
                            if (!empty($dataset['file'])) :
                            ?>
                                <label>Dataset Terupload : </label>&nbsp;&nbsp;<a alt="Detail" class="btn btn-success mr-2" target="_blank" href="<?= base_url('dl_dataset/' . en_crypt($dataset['id_file'])); ?>"><i class="fa fa-file-excel"></i> Dataset Terupload</a>
                            <?php
                            endif;
                            ?>
                            <br>
                            <br>
                            <label>Lampiran Dataset</label>
                            <input type="file" name="userfile" accept=".csv" class="form-control">
                            <small class="text-danger">Note : Pilih file jika ingin merubah lampiran</small>
                        </div>
                    </div>
                    <div class=" form-group mb-0">
                        <div>
                            <button type="submit" class="btn btn-warning waves-effect waves-light mr-1">
                                Edit
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect">
                                Reset
                            </button>
                            <hr>
                            <button class="btn btn-danger mb-3" onclick="batal()"><i class="fa fa-reply"></i> Batal</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div> <!-- end col -->
</div>

<script>
    $(document).ready(function() {
        $(".select2").select2();
        $('#deskripsi').html(`<?= $dataset['deskripsi'] ?>`);
        tinymce.remove();
        tinymce.init({
            selector: 'textarea',
            menubar: '',
            theme: 'modern'
        });
    });

    $(' #form-ajax').submit(function(e) {
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
            error: function(data) {}
        });
        e.preventDefault();
    });
</script>