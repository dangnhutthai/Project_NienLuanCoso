<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand ps-2 me-1" href="#">
                <img class="rounded-pill" src="src/images/logo.ico" alt="" style="width: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark" aria-current="page" href="/">Trang chủ</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Thương hiệu giày
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $sql_brand = "SELECT * FROM brands";
                            $stmt = $pdo->prepare($sql_brand);
                            $stmt->execute();
                            while ($row = $stmt->fetch()) :
                            ?>
                                <li><a class="dropdown-item" href="index.php?controller=brand&idbrand=<?= htmlspecialchars($row['id_brand']) ?>"><i class="fa-solid fa-shoe-prints"></i> <?= htmlspecialchars($row['brand']) ?></a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            <?php endwhile ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="index.php?controller=introduce" tabindex="-1" aria-disabled="true">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="index.php?controller=contact">Liên hệ</a>
                    </li>
                    <form class="d-flex ms-4 ps-4" action="index.php?controller=search" method="POST">
                        <input name="hotkey" class="form-control me-2" type="search" placeholder="Bạn muốn tìm loại giày nào?" aria-label="Search" style="width: 500px;">
                        <button name="search" class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </ul>
                <?php
                if (isset($_SESSION['dangnhap'])) :
                ?>
                    <div class="dropdown ">
                        <p class="dropdown-toggle m-0 me-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true">
                            <?= htmlspecialchars($_SESSION['dangnhap']) ?>
                        </p>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="index.php?controller=account">Tài khoản</a></li>
                            <li><a class="dropdown-item" href="#">Quản lý đơn hàng</a></li>
                            <li><a class="dropdown-item" href="model/accounts/handle.php?logout">Đăng xuất</a></li>
                        </ul>
                    </div>
                    <div class="d-flex float-end">
                        <button class="access-btn rounded-pill me-2 position-relative">
                            <a href="index.php?controller=favproduct"><i class="fa-solid fa-heart" style="color: #f06666;"></i></a>
                        </button>
                        <button class="access-btn rounded-pill me-5 position-relative">
                            <a href="index.php?controller=cart"><i class="fa-solid fa-cart-shopping" style="color: #ffffff;"></i></a>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php
                                if (isset($_SESSION['cart'])) {

                                    $i = 0;
                                    foreach ($_SESSION['cart'] as $cart_item) {
                                        $i++;
                                    }
                                    echo $i;
                                } else {
                                    echo '0';
                                }
                                ?>
                            </span>
                        </button>
                        
                    <?php else : ?>
                        <button class="access-btn mx-1 rounded">
                            <a href="index.php?controller=login">Đăng nhập</a>
                        </button>

                        <button class="access-btn rounded">
                            <a href="index.php?controller=signup">Đăng ký</a>
                        </button>
                    <?php endif ?>
                    </div>


            </div>
        </div>
    </nav>
</header>