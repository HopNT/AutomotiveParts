<header>
    <nav class="navbar navbar-expand-md navbar-orange fixed-top bg-orange">
        <a class="navbar-brand" href="<?= url('/') ?>" style="color:#fff;">
            <img src="<?= asset('images/steering-wheel.png') ?>" >
            <?= env('APP_NAME') ?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars" style="color: #fff"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="javascript:void(0);">Kênh người bán</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);">Tải ứng dụng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);">Kết nối &nbsp;&nbsp;<i class="fab fa-facebook-square"></i>&nbsp;&nbsp;<i class="fab fa-instagram"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);"><i class="far fa-bell"></i>&nbsp; Thông báo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);"><i class="far fa-question-circle"></i>&nbsp; Trợ giúp</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);">Đăng ký</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);">Đăng nhập</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
