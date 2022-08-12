<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md">
        <div class="navbar-header" data-logobg="skin6">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-brand">
                <!-- Logo icon -->
                <a href="<?= base_url('') ?>">
                    <b class="logo-icon">
                        <!-- Dark Logo icon -->
                        <img src="https://choirexpress.co.id/media/frontend/choirexpress-horizontal.webp" alt="homepage" class="dark-logo " width="200" />
                        <!-- Light Logo icon -->
                        <img src="https://choirexpress.co.id/media/frontend/choirexpress-horizontal.webp" alt="homepage" class="light-logo" width="200" />
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span class="logo-text">
                        <!-- dark Logo text -->
                        <!-- <img src="<?= base_url('assets/'); ?>images/logo-text.png" alt="homepage" class="dark-logo" /> -->

                        <!-- Light Logo text -->
                        <img src="<?= base_url('assets/'); ?>images/logo-light-text.png" class="light-logo" alt="homepage" />
                    </span>
                </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item ">
                    <a class="nav-link" href="javascript:void(0)" aria-haspopup="true" aria-expanded="false">
                        <span class="ml-2 d-none d-lg-inline-block"><span>Hai,</span> <span class="text-dark"> <?= $user['username']; ?>
                         </span></span>
                    </a>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->