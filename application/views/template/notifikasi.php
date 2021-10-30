<?php
$role_aktif = $this->session->userdata('role');
$opd = $this->session->userdata('id_opd');

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
            <a class="dropdown-item" href="#"><i class="mdi mdi-wallet m-r-5"></i> My Wallet</a>
            <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings m-r-5"></i> Settings</a>
            <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5"></i> Lock screen</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" href="<?= base_url('Logout'); ?>"><i class="mdi mdi-power text-danger"></i> Logout</a>
        </div>
    </div>
</li>