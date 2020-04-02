        <nav class="main-header navbar navbar-expand-md navbar-dark navbar-primary">
            <div class="container">
                <a href="<?=base_url('member/home');?>" class="navbar-brand">
                    <span class="brand-text">Bullbear Course</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="<?=base_url('member/video');?>" class="nav-link">
                                My Courses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=base_url('member/transaction');?>" class="nav-link">
                                Purchase History
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#modalPassword">
                                Change Password
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=base_url('member/credential/logout');?>" class="nav-link">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>