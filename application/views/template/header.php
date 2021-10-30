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
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/waves.min.js"></script>

        <script src="assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
        <!-- Sweet-Alert  -->
        <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>

        <!-- Sweet Alert -->
        <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

        <?php
        $controller_name = $this->uri->segment(1);
        $array_controller = ['Topik', 'User', 'Opd', 'Dataset'];
        if ($controller_name == '') :
        ?>
            <link rel="stylesheet" href="assets/plugins/morris/morris.css">
        <?php
        elseif (in_array($controller_name, $array_controller)) :
        ?>
            <!-- DataTables -->
            <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
            <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
            <!-- Responsive datatable examples -->
            <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <?php
        endif;

        if ($controller_name == 'Dataset' || $controller_name == 'User') :
        ?>
            <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <?php
        endif;

        if ($controller_name == 'Dataset') :
        ?>
            <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <?php
        endif;
        ?>



        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">

        <script>
            let GLOBAL_C = '<?= $controller_name ?>';
        </script>
    </head>


    </head>