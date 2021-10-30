<?php
$controller_name = $this->uri->segment(1);
?>
<form method="POST" id="form-ajax" autocomplete="off" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Hasil Verifikasi : </label>
                <input type="hidden" value="<?= $detail['id'] ?>" id="id_dataset" name="id_dataset">
                <select class="form-control" id="hasil_verifikasi" name="hasil_verifikasi" onchange="berubah()">
                    <option>-Pilih-</option>
                    <option value="1">Terima dan Publish</option>
                    <option value="-1">Perbaiki</option>
                </select>
            </div>
        </div>
        <div class="col-md-4 wadah-format" style="display: none;">
            <div class="form-group">
                <label>Format Tersedia : </label>
                <select class="form-control select2 select2-multiple" multiple="multiple" id="format_tersedia" name="format_tersedia[]">
                    <option value="CSV">CSV</option>
                    <option value="Excel">Excel</option>
                    <option value="API">API</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <button class="btn btn-primary mt-4" type="submit"><i class="fa fa-save"></i> Simpan Verifikasi</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $(".select2").select2();
    });

    function berubah() {
        let nilai = $('#hasil_verifikasi').val();
        if (nilai == '1') {
            $('.wadah-format').show();
            $('#format_tersedia').prop('required', true);
        } else {
            $('.wadah-format').hide();
            $('#format_tersedia').prop('required', false);
        }
    }

    $('#form-ajax').submit(function(e) {
        let id = $('#id_dataset').val();
        let jawaban = $('#hasil_verifikasi').val();
        let format_tersedia = null;
        if (jawaban == '1') {
            format_tersedia = $('#format_tersedia').val()
        }

        Swal.fire({
            title: "Konfirmasi",
            text: "Yakin ingin menyimpan hasil verifikasi ini?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ec536c",
            cancelButtonColor: "#bb7be3",
            confirmButtonText: "Ya!"
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url($controller_name . '/act/verif') ?>",
                    dataType: 'json',
                    data: {
                        id: id,
                        jawaban: jawaban,
                        format_tersedia: format_tersedia
                    },
                    success: function(data) {
                        $('#notif-apps').html('');
                        $('#notif-apps').html(data.msg);
                        setInterval(function() {
                            $('#notif-apps').html('');
                        }, 7000);
                        $('#MyVerifikasiModal').modal('hide');
                        if (data.status == 20) {
                            view();
                            Swal.fire("Berhasil!", "Verifikasi berhasil dilakukan", "success");
                        }
                    },
                    error: function(data) {

                    }
                });
            }
        });
        e.preventDefault();
    });
</script>