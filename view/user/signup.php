<div class="container dangky">
    <div class="row my-6">
        <div class="col-sm-6 offset-sm-3 my-5 border border-2 rounded">
            <div class="row">
                <img src="src/images/banner_log_sign.png" class="p-0 rounded">
            </div>
            <div class="row">

                <div class="card-header text-center">
                    <h3>Đăng ký</h3>
                </div>

                <form id="signupForm" method="post" class="form-horizontal" action="model/accounts/handle.php">
                    <div class="form-group row mt-3">
                        <label class="col-sm-4 offset-1 col-form-label" for="username">Tên đăng nhập</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Tên đăng nhập" />
                        </div>
                    </div>

                    <div class="form-group row my-2">
                        <label class="col-sm-4 offset-1 col-form-label" for="email">Hộp thư điện tử</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Hộp thư điện tử" />
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-4 offset-1 col-form-label" for="phone">Số điện thoại</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 offset-1 col-form-label" for="address">Địa chỉ</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control w-100" id="address" name="address" placeholder="Địa chỉ" />
                        </div>
                    </div>
                    <div class="form-group row my-2">
                        <label class="col-sm-4 offset-1 col-form-label" for="password">Mật khẩu</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 offset-1 col-form-label" for="confirm_password">Nhập lại mật khẩu</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu" />
                        </div>
                    </div>
                    <div class="form-group form-check my-2">
                        <div class="col-sm-6 offset-sm-3">
                            <input class="form-check-input" type="checkbox" id="agree" name="agree" value="agree" />
                            <label class="form-check-label" for="agree">Đồng ý các quy định của chúng tôi</label>
                        </div>
                    </div>
                    <div class="row my-1">
                        <div class="col-sm-6 offset-sm-3 text-center">
                            <button type="submit" class="login-btn py-2 px-3" name="signup">
                                Đăng ký
                            </button>
                        </div>

                </form>
                <p class="text-center mt-3">Đã có tài khoản? <a class="text-decoration-none" href="index.php?controller=login">Đăng nhập</a> </p>
            </div>
        </div>
    </div>
</div>
<script src="js/script.js">
</script>