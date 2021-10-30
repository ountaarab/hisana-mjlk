<!DOCTYPE html>
<html lang="en">

<!-- Header Start -->
<?php echo $_head; ?>
<!-- Header End -->

<body>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Navbar Start -->
        <div id="notifikasi">
            <?= $_navbar; ?>
        </div>
        <!-- Navbar End -->

        <!-- ========== Left Sidebar Start ========== -->
        <?= $_sidebar; ?>

        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <?= $_content ?>
            <!-- content -->

            <!-- Start Footer -->
            <?= $_footer; ?>
            <!-- End Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->
    <!-- jQuery  -->
    <script>
        $(document).ready(function() {
            setInterval(function() {
                $.get("<?= base_url('nv') ?>", function(result) {
                    $('#notifikasi').html('');
                    $('#notifikasi').html(result);
                });
            }, 10000);

        });
    </script>
    <?php
    $controller_name = $this->uri->segment(1);
    $array_controller = ['Topik', 'User', 'Opd', 'Dataset', 'Produk'];
    if (in_array($controller_name, $array_controller)) :
    ?>
        <!-- Required datatable js -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>
    <?php
    endif;
    if ($controller_name == 'Dataset' || $controller_name == 'User') :
    ?>
        <script src="assets/plugins/select2/js/select2.min.js"></script>
        <script src="assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>
    <?php
    endif;

    if ($controller_name == 'Dataset') :
    ?>
        <!--Wysiwig js-->
        <script src="assets/plugins/tinymce/tinymce.min.js"></script>
    <?php
    endif;

    if ($controller_name == '') :
    ?>
        <!--Morris Chart-->
        <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/plugins/raphael/raphael-min.js"></script>
        <script src="assets/pages/dashboard.js"></script>

    <?php
    endif;
    ?>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>