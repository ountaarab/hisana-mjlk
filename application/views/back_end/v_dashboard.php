<?php
$role = $this->session->userdata('role');
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Dashboard</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            Open Data Karawang
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end row -->

        <?php echo $this->session->flashdata('msg'); ?>
        <div class="row">
            <?php
            if ($role != 'opd') :
            ?>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary">
                        <div class="card-body mini-stat-img">
                            <div class="mini-stat-icon">
                                <i class="mdi mdi-account-box float-right"></i>
                            </div>
                            <div class="text-white">
                                <h6 class="text-uppercase mb-3">User
                                    <br>
                                    Open Data
                                </h6>
                                <h4 class="mb-4"><?= $user ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary">
                        <div class="card-body mini-stat-img">
                            <div class="mini-stat-icon">
                                <i class="mdi mdi-bank float-right"></i>
                            </div>
                            <div class="text-white">
                                <h6 class="text-uppercase mb-3">Perangkat <br>Daerah</h6>
                                <h4 class="mb-4"><?= $opd ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endif;
            ?>
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat bg-primary">
                    <div class="card-body mini-stat-img">
                        <div class="mini-stat-icon">
                            <i class="mdi mdi-buffer float-right"></i>
                        </div>
                        <div class="text-white">
                            <h6 class="text-uppercase mb-3">Dataset <br> Publish</h6>
                            <h4 class="mb-4"><?= $dataset_publish ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $ket = '';
            if ($role == 'wd' || $role == 'su') :
                $belum_verifikasi = get_notif_wd();
                if ($belum_verifikasi > 0) :
                    $ket = '<small class="text-warning">(<strong>' . $belum_verifikasi . '</strong>) Belum Verif</small>';
                endif;
            endif;
            ?>
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat bg-primary">
                    <div class="card-body mini-stat-img">
                        <div class="mini-stat-icon">
                            <i class="mdi mdi-buffer float-right"></i>
                        </div>
                        <div class="text-white">
                            <h6 class="text-uppercase mb-3">Dataset Belum Publish</h6>
                            <h4 class="mb-4"><?= $dataset_belum ?>&nbsp;&nbsp;<?= $ket ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if ($role == 'su' || $role == 'wd') :
        ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                Dataset Per OPD
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                if ($dataset_opd->num_rows() > 0) :
                    $no = 0;
                    $array_style = ['dark', 'secondary', 'warning', 'info', 'danger', 'success'];
                    foreach ($dataset_opd->result() as $baris) :
                        $file = PATH_FILE . $baris->img;
                        if (file_exists($file)) {
                            $gambar = $file;
                        } else {
                            $gambar = PATH_FILE . 'default-opd.png';
                        }
                ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card mini-stat bg-<?= $array_style[$no] ?>">
                                <div class="card-body mini-stat-img">
                                    <img class="rounded-circle img-fluid" alt="200x200" src="<?= $gambar ?>" data-holder-rendered="true" style="width: 50%; height:auto">
                                    <div class="text-white">
                                        <h6 class="text-uppercase mb-3">
                                            <br>
                                            <?= $baris->nama ?>
                                        </h6>
                                        <h4 class="mb-4"><?= $baris->jumlah_dataset ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                        $no++;
                        if ($no == 6) :
                            $no = 0;
                        endif;
                    endforeach;
                endif;
                ?>
            </div>
        <?php
        endif;
        ?>
        <!-- end row -->


        <div class="row">


        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->

</div>