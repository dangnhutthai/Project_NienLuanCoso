<div class="container dangnhap my-5">
		<div class="row my-5 justify-content-center">
			<div class="col-5 my-5 border border-2">
					<div class="row">
						<img src="src/images/banner_log_sign.png" class="p-0 rounded">	
					</div>
					<div class="row">
							<div class="card-header text-center">
								<h3>Đăng nhập</h3>
							</div>
							<div class="card-body">
								<form id="signupForm" method="post" class="form-horizontal flogin" action="model/accounts/handle.php">
									<div class="form-group row mb-2">
										<label class="col-sm-4 col-form-label ms-5" for="username">Tên đăng nhập:</label>
										<div class="col-sm-5 w-50">
											<input type="text" class="form-control" id="username" name="username"
											placeholder="Tên đăng nhập" />
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label ms-5" for="password">Mật khẩu:</label>
										<div class="col-sm-5 w-50">
											<input type="password" class="form-control" id="password" name="password"
											placeholder="Mật khẩu" />
										</div>
									</div>
									
									<div class="form-group form-check ">
										<div class="row">
											<div class="col offset-sm-1 mt-3">
												<input class="form-check-input" type="checkbox" id="" name=""
												value="agree" />
												<label class="form-check-label" for="">Ghi nhớ tôi</label>
												
											</div>

											<div class="col mt-3 me-5">
												<a href="#" class="float-end text-decoration-none">Quên mật khẩu?</a>
											</div>
										</div>
									</div>
									
									<div class="row mt-3">
										<div class="col text-center">
											<button type="submit" class="btn p-2 login-btn" name="login" value="Sign up">
												Đăng nhập
											</button>
										</div>
									</div>
									<div class="row mt-3">
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
