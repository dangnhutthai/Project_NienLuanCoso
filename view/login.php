<div class="container dangnhap my-5">
		<div class="row my-5">

			<div class="col-sm-10 offset-sm-1 my-5">

				<div class="card my-5">
					<div class="row">
						<div class="col rounded form-detail">
							<h1 style="text-shadow: #8FEBDE 4px -10px 3px, #000 -3px 10px 4px; ">WELCOM</h1>
							<p class=" rounded fs-5 bg-secondary bg-gradient bg-opacity-25">Chào mừng bạn đến trang mua
								<br> hàng của chúng tôi
							</p>
						</div>
						<div class="col-5">
							<div class="card-header text-center">
								<h3>Đăng nhập</h3>
							</div>
							<div class="card-body">
								<form id="signupForm" method="post" class="form-horizontal flogin" action="model/accounts/handle.php">
									<div class="form-group row mb-2">
										<label class="col-sm-4 col-form-label" for="username">Tên đăng nhập:</label>
										<div class="col-sm-5 w-50">
											<input type="text" class="form-control" id="username" name="username"
												placeholder="Tên đăng nhập" />
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label" for="password">Mật khẩu:</label>
										<div class="col-sm-5 w-50">
											<input type="password" class="form-control" id="password" name="password"
												placeholder="Mật khẩu" />
										</div>
									</div>

									<div class="form-group form-check ">
										<div class="row">
											<div class="col offset-sm-1 mt-4">
												<input class="form-check-input" type="checkbox" id="" name=""
													value="agree" />
												<label class="form-check-label" for="">Ghi nhớ tôi</label>

											</div>

											<div class="col mt-4 me-4">
												<a href="#" class="float-end ">Quên mật khẩu?</a>
											</div>
										</div>
									</div>

									<div class="row mt-4">
										<div class="col text-center">
											<button type="submit" class="btn fs-5 p-2 login-btn" name="login" value="Sign up">
												Đăng nhập
											</button>
										</div>
									</div>
									<div class="row mt-5">
										<div class="col text-center">
											<p>Không có tài khoản?
												<a href="index.php?controller=signup" class="text-decoration-none">Đăng ký</a>
											</p>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>