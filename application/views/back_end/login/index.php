<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= APP_TITLE ?></title>
    <meta content="Aplikasi POS Hisana Majalengka" name="description" />
    <meta content="Fazri Ramadhan" name="author" />
    <meta name="keywords" content="hisana, Hisana Majalengka, Hisana, Ayam Siap Saji, Makanan Siap Saji">

    <meta property="og:site_name" content="Aplikasi POS Hisana Majalengka" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= base_url() ?>" />
    <meta property="og:title" content="Hisana Majalengka" />
    <meta property="og:description" content="Aplikasi POS Hisana Majalengka" />
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/opendata.png">
    <!-- Sweet-Alert  -->
    <script src="<?= base_url() ?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>

    <!-- Sweet Alert -->
    <link href="<?= base_url() ?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

    <!-- Begin page -->
    <div class="wrapper-page">

        <div class="card">
            <div class="card-body">

                <h3 class="text-center m-0">
                    <a href="<?= base_url('Login') ?>" class="logo logo-admin"><img src="<?= base_url() ?>assets/images/opendata.png" height="80" alt="logo"></a>
                </h3>

                <?php echo $this->session->flashdata('msg'); ?>
                <div class="p-1">
                    <!-- <h4 class="text-muted font-18 m-b-2 text-center">Hay !</h4> -->
                    <p class="text-muted text-center">Login untuk menggunakan <?= APP_TITLE ?>.</p>

                    <form class="form-horizontal m-t-5" action="cek" autocomplete="off" method="POST" id="loginform">

                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" id="nip" placeholder="Masukkan NIP" name="nip">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Masukkan Password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="password">Captcha</label>
                            <input class="form-control" id="text_capctha" name="text_capctha" type="text" required="" placeholder="Masukkan Kode Captcha dibawah ini">
                            <div id="Imageid_wadah">
                                <img alt="CaptchaImage" id="Imageid" class="img-fluid" src="/captcha/<?= $img_captcha ?>" />
                            </div>
                            <button type="button" href="javascript:void(0);" class="refreshCaptcha btn btn-dark">
                                <i class="fa fa-redo-alt"></i>
                            </button>
                        </div>

                        <div class="form-group row m-t-10">
                            <div class="col-12 text-right">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Masuk</button>
                            </div>
                        </div>

                        <!-- <div class="form-group m-t-10 mb-0 row">
                            <div class="col-12 m-t-20">
                                <a href="pages-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> Lupa Password?</a>
                            </div>
                        </div> -->
                    </form>
                </div>

            </div>
        </div>

        <div class="m-t-40 text-center">
            <p>© 2021. Dibuat dengan <i class="mdi mdi-heart text-danger"></i> Oleh <?= OWNER_APPS ?></p>
        </div>

    </div>


    <!-- jQuery  -->
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>

    <script>
        $('.refreshCaptcha').click(function() {
            $.get('<?= base_url('ref_cap'); ?>', function(data) {
                $('#Imageid_wadah').html(data);
            });
        });




        $('#loginform').submit(function(e) {
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData($(this)[0]),
                success: function(data) {
                    data = JSON.parse(data);
                    Swal.fire(data.title, data.message, data.tipe).then((value) => {
                        if (data.status == 20) {
                            if (data.return_url != '#') {
                                document.location.href = data.return_url
                            }
                        } else {
                            $.get('<?= site_url('ref_cap'); ?>', function(data) {
                                $('#Imageid_wadah').html(data);
                            });
                        }
                    });
                },
                cache: false,
                contentType: false,
                processData: false,
                error: function(data) {
                    swal(data);
                }
            });
            e.preventDefault();
        });
    </script>

</body>

</html>