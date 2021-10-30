<?php
$role_aktif = $this->session->userdata('role');
$opd = $this->session->userdata('id_opd');
$tipe = $this->session->userdata('tipe');
$logged_in = '';
if ($role_aktif == 'opd') :
    $logged_in = 'OPD';
    if ($tipe == '2') :
        $logged_in = 'Instansi Non Pemerintahan';
    endif;
elseif ($role_aktif == 'wd') :
    $logged_in = 'Wali Data';
elseif ($role_aktif == 'su') :
    $logged_in = 'Super User';
endif;

?>
<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <a href="index.html" class="logo">
            <span>
                <img src="<?= base_url() ?>assets/images/opendata.png" alt="" height="58">
            </span>
            <i>
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </i>
        </a>
    </div>

    <nav class="navbar-custom">

        <ul class="navbar-right d-flex list-inline float-right mb-0">
            <?php
            $notif = 0;
            $badge_notif = '';
            if ($role_aktif == 'opd') :
                $notif = get_notif_opd($opd);
            elseif ($role_aktif == 'wd' || $role_aktif == 'su') :
                $notif = get_notif_wd();
            endif;

            $isi_notif = '';
            if ($notif > 0) :
                if ($role_aktif == 'opd') :
                    $katanotif = 'Perbaikan Dataset<span class="text-muted">ada ' . $notif . ' Dataset perlu perbaikan';
                else :
                    $katanotif = 'Verifikasi Dataset<span class="text-muted">ada ' . $notif . ' Dataset menunggu Verifikasi';
                endif;

                $badge_notif = '<span class="badge badge-pill badge-danger noti-icon-badge">' . $notif . '</span>';
                $isi_notif = '
                <h6 class="dropdown-item-text">
                    Notifikasi (' . $notif . ')
                </h6>
                <div class="slimscroll notification-item-list">
                    <!-- item-->
                    <a href="' . base_url('Dataset') . '" class="dropdown-item notify-item">
                        <div class="notify-icon bg-danger"><i class="mdi mdi-message"></i></div>
                        <p class="notify-details">' . $katanotif . '</span></p>
                    </a>
                </div>';
            else :
                $isi_notif = '
                <h6 class="dropdown-item-text">
                    Tidak Ada Notifikasi
                </h6>';
            endif;
            ?>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="ti-bell noti-icon"></i>
                    <?= $badge_notif ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                    <?= $isi_notif ?>
                </div>
            </li>
            <li class="dropdown notification-list">
                <div class="dropdown notification-list nav-pro-img">
                    <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="assets/images/users/user-4.jpg" alt="user" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i> Profile</a>
                        <a class="dropdown-item text-danger" href="<?= base_url('Logout'); ?>"><i class="mdi mdi-power text-danger"></i> Logout</a>
                    </div>
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
            <li class="d-none d-sm-block">
                <div class="dropdown pt-3 d-inline-block">
                    <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Loged in as : <?= $logged_in ?>
                    </a>
                </div>
            </li>
        </ul>

    </nav>

</div>