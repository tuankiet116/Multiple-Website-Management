<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="<?=$myuser->use_avatar?>" class="img-circle elevation-2" alt="<?=$myuser->use_name?>">
        </div>
        <div class="info">
            <?=$myuser->use_name?> &nbsp; <a href="<?=LOGOUT_URL?>" title="Thoát" class="icon_logout"><i class="fa fa-power-off" aria-hidden="true"></i></a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <!-- Menu for Officials -->
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header">QUẢN LÝ LỊCH DAILY</li>
            <li class="nav-item">
                <a href="/addcalender" class="nav-link">
                    <i class="far fa-circle text-danger"></i>
                    <p>Thêm mới Lịch</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/listcalender" class="nav-link">
                    <i class="far fa-circle text-warning"></i>

                    <p>Danh sách Lịch</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>