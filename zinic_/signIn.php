<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ZINIC | Sign in</title>
	<link rel="stylesheet" href="bootstrap.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="./logoH.jpeg">
	<style>
		body {
			background-image: url('./signin.png.png');
			background-size: cover;
			/* Cover the entire background */
			background-position: center;
			/* Center the background image */
		}

		.card {
			background: transparent;
			border: 2px solid rgba(255, 255, 255, .5);
			border-radius: 20px;
			backdrop-filter: blur(20px);
			color: white;
			font-weight: 500;
		}

	</style>
</head>

<body>
	<div class="container d-flex flex-column">
		<div class="row vh-100">
			<div class="col-sm-10 col-md-8 col-lg-4 mx-auto d-table h-100">
				<div class="d-table-cell align-middle">



					<?php

					$email = null;
					$password = null;

					if (isset($_COOKIE["u_email"])) {
						$email = $_COOKIE["u_email"];
					}
					if (isset($_COOKIE["u_pw"])) {
						$password = $_COOKIE["u_pw"];
					}

					?>

					<div class="d-none" id="alert_signin" role="alert">
						<strong>Error!</strong> <span id="alert_msg_signin"></span>
						<button type="button" class="btn-close" aria-label="Close" onclick="signInAlertClose()"></button>
					</div>

					<div class="card ">
						<div class="text-center mt-4 ">
							<p class="lead" style="color: white; font-weight:500;">
								Sign in to your account to continue
							</p>
						</div>
						<div class="card-body">
							<div class="m-sm-4">
								<div class="mb-3">
									<label for="email_signin" class="form-label">Email</label>
									<input class="form-control form-control bg-transparent" style="color: #fff;" type="email" id="email_signin" placeholder="Enter you Email" value="<?php echo ($email) ?>" />
								</div>
								<div class="mb-3">
									<label for="password_signim" class="form-label">Password</label>
									<input class="form-control form-control bg-transparent" type="password" id="password_signin" placeholder="Enter your password" value="<?php echo ($password) ?>" />
									<small>
										<a onclick="forgetPasswordModal()">Forgot password?</a>
									</small>

									<!-- Forget Password Modal -->
									<div class="modal" tabindex="-1" id="forgetPasswordSendEmail">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Enter your Email</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<input type="text" class="form-control" id="forgetPasswordUserEmail">
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
													<button type="button" class="btn btn-primary" onclick="fordetPasswordSendVcode();">Get Verification Code</button>
												</div>
											</div>
										</div>
									</div>
									<!-- Forget Password Modal -->

									<!-- Send vcode -->

									<div class="modal" tabindex="-1" id="forgetPasswordSendVcode">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Send Your Verification Code</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<input type="text" class="form-control" id="forgetPasswordVcode">
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
													<button type="button" class="btn btn-primary" onclick="foegetPasswordSendVcode()">Send Verification Code</button>
												</div>
											</div>
										</div>
									</div>

									<!-- Send vcode -->
								</div>
								<div>
									<label class="form-check">
										<input class="form-check-input" type="checkbox" value="remember-me" id="remember-me" checked>
										<span class="form-check-label">
											Remember me next time
										</span>
									</label>
								</div>
								<div class="text-center my-3 d-grid">
									<a href="#">
										<div style="background-color: #7B6958; height:40px; border-radius:5px; text-align:center;font-size:larger" onclick="signIn();">Sign in</div>
									</a>
								</div>
								<label for="" class="form-label">New User? please Sign Up</label>
								<div class="text-center mb-3 d-grid">
									<a href="signUp.php" class="btn btn-dark">Sign Up</a>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<script src="jQuery 3.6.1.js"></script>
	<script src="bootstrap.bundle.js"></script>
	<script src="script.js"></script>
	<script>
		var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
		var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
			return new bootstrap.Popover(popoverTriggerEl)
		})
	</script>

</body>

</html>