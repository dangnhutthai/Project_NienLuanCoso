<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand ps-2 me-1" href="#">
                <img class="rounded ms-2" src="src/images/logo.ico" alt="" style="width: 40px;"  data-bs-toggle="tooltip" data-bs-placement="top" title="Trang chủ">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 shadow ms-3">
                    <li class="nav-item">
                        <a class="nav-link text-white ms-1" aria-current="page" href="/">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white mx-1" href="index.php?controller=contact">Mẫu hồ</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Danh mục cá
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $sql_brand = "SELECT * FROM tbl_danhmuc";
                            $stmt = $pdo->prepare($sql_brand);
                            $stmt->execute();
                            while ($row = $stmt->fetch()) :
                            ?>
                                <li><a class="dropdown-item" href="index.php?controller=category&iddanhmuc=<?= htmlspecialchars($row['id_danhmuc']) ?>"><i class="fa-solid fa-shoe-prints"></i> <?= htmlspecialchars($row['tendanhmuc']) ?></a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            <?php endwhile ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white ms-1" href="index.php?controller=introduce" tabindex="-1" aria-disabled="true">Giới thiệu</a>
                    </li>
                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <form class="d-flex ms-4 ps-4" action="index.php?controller=search" method="POST">
                        <input name="hotkey" class="form-control me-2" type="search" placeholder="Bạn muốn tìm loại cá nào?" aria-label="Search" style="width: 500px;">
                        <button name="search" class="btn btn-outline-light rounded-pill" type="submit"><i class="fa-solid fa-magnifying-glass" style="color: #e0dcdc;"></i></button>
                    </form>
                </ul>

                <?php
                if (isset($_SESSION['dangnhap'])) :
                ?>
                    <div class="dropdown ">
                        <p class="dropdown-toggle m-0 me-3 text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true">
                            <?= htmlspecialchars($_SESSION['dangnhap']) ?>
                        </p>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="index.php?controller=account">Tài khoản</a></li>
                            <hr class="dropdown-divider">

                            <li><a class="dropdown-item" href="#">Quản lý đơn hàng</a></li>
                            <hr class="dropdown-divider">
                            
                            <li><a class="dropdown-item" href="model/accounts/handle.php?logout">Đăng xuất</a></li>
                        </ul>
                    </div>
                    <div class="d-flex float-end">
                        <button class="btn-fav bg-light rounded-pill me-1 position-relative py-1 px-2 border-light shadow">
                            <a href="index.php?controller=favproduct"><i class="fa-solid fa-heart" style="color: #f06666;"></i></a>
                            <span class="position-absolute top-0 start-75 translate-middle badge rounded-pill bg-danger">
                                <?php
                                if (isset($_SESSION['dangnhap'])) {
                                    $sql_select_acc = "SELECT * FROM tbl_user WHERE id_user = $_SESSION[iduser]";
                                    $stmt_select_acc = $pdo->prepare($sql_select_acc);
                                    $stmt_select_acc->execute();
                                    $row_select_acc = $stmt_select_acc->fetch();
                                    $str_select_fav = $row_select_acc['pro_fav'];
                                    $str_split = str_split($str_select_fav, 5);
                                    $i = 0;
                                    foreach ($str_split as $str) {
                                        $i++;
                                    }
                                    echo $i;
                                }
                                ?>
                            </span>
                        </button>
                        <button class="cart-btn rounded-pill mx-3 position-relative" data-bs-toggle="tooltip" data-bs-placement="top" title="Giỏ hàng của bạn">
                            <a href="index.php?controller=cart"><i class="fa-solid fa-cart-shopping py-2 px-2" style="color: #000000;"></i></a>
                            <span class="position-absolute top-0 start-75 translate-middle badge rounded-pill bg-danger">
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
                        <button class="access-btn mx-1 rounded-pill border border-light shadow py-1 px-3 me-2 border-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Đăng nhập">
                            <a href="index.php?controller=login">Đăng nhập</a>
                        </button>

                        <button class="access-btn rounded rounded-pill border border-light shadow py-1 px-3 border-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Đăng ký nếu chưa có tài khoản">
                            <a href="index.php?controller=signup">Đăng ký</a>
                        </button>
                    <?php endif ?>
                    </div>
                    <?php
                if (!isset($_SESSION['dangnhap'])) :
                ?>
                    <button class="cart-btn rounded-pill mx-3 position-relative" data-bs-toggle="tooltip" data-bs-placement="top" title="Giỏ hàng của bạn">
                        <a href="index.php?controller=login"><i class="fa-solid fa-cart-shopping py-2 px-2" style="color: #000000;"></i></a>
                        <span class="position-absolute top-0 start-75 translate-middle badge rounded-pill bg-danger">
                            0
                        </span>
                    </button>
                    <?php endif ?>
            </div>
        </div>
    </nav>
</header>