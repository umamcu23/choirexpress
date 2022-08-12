<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <span class="hide-menu"><?= $menu; ?>
                    </span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="<?= base_url('order'); ?>" aria-expanded="false" style="border-radius: 0 60px 60px 0;color: white;background: linear-gradient(to right,#8971ea,#7f72ea,#7574ea,#6a75e9,#5f76e8);box-shadow: 0 7px 12px 0 rgb(95 118 232 / 21%);opacity: 1;">
                        <i class="bi bi-box-seam text-white"></i>
                        <span class="hide-menu text-white"><?= $submenu ?></span>
                    </a>
                </li>
                <li class="list-divider"></li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= base_url('auth/logout'); ?>" aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span class="hide-menu">Keluar</span></a></li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->