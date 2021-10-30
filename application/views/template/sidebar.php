<?php $role = $this->session->userdata('role'); ?>
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Data Master</li>
                <li>
                    <a href="<?= base_url('Welcome') ?>" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span>
                    </a>
                </li>
                <?php
                if ($role == 'su') :
                ?>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-clipboard-outline"></i><span> Data Master</span></a>
                        <ul class="submenu">
                            <!-- <li><a href="<?= base_url('Topik') ?>">Topik</a></li>
                            <li><a href="<?= base_url('User') ?>">User</a></li>
                            <li><a href="<?= base_url('Opd') ?>">OPD</a></li> -->
                            <li><a href="<?= base_url('Produk') ?>">Produk</a></li>
                            <li><a href="<?= base_url('Kategori') ?>">Kategori</a></li>
                            <li><a href="<?= base_url('Stok') ?>">Stok</a></li>
                            <li><a href="<?= base_url('Gerai') ?>">Gerai</a></li>
                        </ul>
                    </li>

                <?php
                endif;
                ?>

                <li class="menu-title">Transaksi</li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-buffer"></i> <span> Input Data <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                    <ul class="submenu">
                        <li><a href="<?= base_url('Laporan_harian') ?>">Input Laporan Harian</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>