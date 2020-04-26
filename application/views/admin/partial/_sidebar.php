        <aside class="main-sidebar sidebar-dark-success elevation-4">
            <a href="<?=base_url('admin/member');?>" class="brand-link">
                <img src="<?=base_url('assets/images/logo-mini3.png');?>"
                     alt="BullBear Logo"
                     class="brand-image">
                <span class="brand-text font-weight-light">Bullbear Course</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item" id="menuMember">
                            <a href="<?=base_url('admin/member');?>" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Manajemen Member</p>
                            </a>
                        </li>
                        <li class="nav-item" id="menuVideo">
                            <a href="<?=base_url('admin/video');?>" class="nav-link">
                                <i class="nav-icon fas fa-video"></i>
                                <p>Manajemen Video</p>
                            </a>
                        </li>
                        <li class="nav-item" id="menuTransaksi">
                            <a href="<?=base_url('admin/transaksi');?>" class="nav-link">
                                <i class="nav-icon fas fa-receipt"></i>
                                <p>Manajemen Transaksi</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>