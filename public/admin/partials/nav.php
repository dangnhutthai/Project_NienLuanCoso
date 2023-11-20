<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand ps-2 me-1 " href="#">
                <img class="rounded-pill" src="src/images/logo.ico" alt="" style="width: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-4 ">
                    <li class="nav-item border border-dark rounded shadow">
                        <a class="nav-link text-dark fw-bold px-4" aria-current="page" href="admin.php?controller=product">Product</a>
                    </li>
                    <li class="nav-item border border-dark rounded mx-3 px-4 shadow">
                        <a class="nav-link text-dark fw-bold" href="admin.php?controller=brand&action=index" tabindex="-1" aria-disabled="true">Brand</a>
                    </li>
                    <li class="nav-item border border-dark rounded px-4 shadow">
                        <a class="nav-link text-dark fw-bold" href="admin.php?controller=order&action=index">Order</a>
                    </li>
                    <li class="nav-item border border-dark rounded px-4 shadow ms-3">
                        <a class="nav-link text-dark fw-bold" href="admin.php?controller=account&action=index">Account</a>
                    </li>
                </ul>
                <div class="d-flex float-end">
                    <a class="exit-btn py-2 px-3 me-4 btn" href="../model/accounts/handle.php?logout" class="text-decoration-none text-dark">Đăng xuất: <?= htmlspecialchars($_SESSION['dangnhap']) ?></a>
                </div>
            </div>
        </div>
    </nav>
</header>