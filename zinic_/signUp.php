<?php require "connection.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ZINIC | Home</title>
	<link rel="stylesheet" href="bootstrap.css">
	<link rel="stylesheet" href="chosen.css">
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

		::placeholder {
			color: white;
			opacity: 1;
			/* Firefox */
		}
	</style>
</head>

<body>

	<div class="container d-flex flex-column">
		<div class="row vh-100">
			<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
				<div class="d-table-cell align-middle">
					<div class="d-none" id="alert_signup" role="alert">
						<strong>Error!</strong> <span id="alert_msg_signup"></span>
						<button type="button" class="btn-close" aria-label="Close" onclick="signUpAlertClose()"></button>
					</div>

					<div class="card">
						<div class="text-center mt-4">
							<h1 class="h2">Get started!</h1>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="mb-3 col-6">
									<label class="form-label" for="fname_signup">First Name</label>
									<input class="form-control form-control bg-transparent" style="color: #fff;" type="text" id="fname_signup" placeholder="Enter your name" />
								</div>
								<div class="mb-3 col-6">
									<label class="form-label" for="lname_signup">Last Name</label>
									<input class="form-control form-control bg-transparent" style="color: #fff;" type="text" id="lname_signup" placeholder="Enter your name" />
								</div>
								<div class="mb-3">
									<label class="form-label" for="email_signup">Email</label>
									<input class="form-control form-control bg-transparent" style="color: #fff;" type="email" id="email_signup" placeholder="Enter your email" />
								</div>
								<div class="mb-3">
									<label class="form-label" for="mobile_signup">Mobile</label>
									<input class="form-control form-control bg-transparent" style="color: #fff;" type="text" id="mobile_signup" placeholder="Enter your Mobile" />
								</div>
								<div class="mb-3 col-6">
									<label class="form-label" for="password_signup">Password</label>
									<input class="form-control form-control bg-transparent" style="color: white;" type="password" id="password_signup" placeholder="Enter password" />
								</div>
								<div class="mb-3 col-6">
									<label class="form-label" for="cpassword_signup">Comfirm Password</label>
									<input class="form-control form-control bg-transparent" style="color: white;" type="password" id="cpassword_signup" placeholder="Re-Enter password" />
								</div>
								<?php
								$dis_rs = Database::search("SELECT * FROM shipping");
								$dis_num = $dis_rs->num_rows;
								?>
								<div class="col-12">
									<label for="line1" class="form-label">Select Your District</label>
									<select name="" id="district_signup" class="mySelect form-select">
										<?php
										for ($x = 0; $x < $dis_num; $x++) {
											$dis_d = $dis_rs->fetch_assoc();
										?>
											<option value="<?php echo ($dis_d["id"]) ?>"><?php echo ($dis_d["district"]) ?></option>
										<?php
										}
										?>

									</select>
								</div>
								<div class="text-center my-3 d-grid col-12">
									<a href="#">
										<div style="background-color: #7B6958; height:40px; border-radius:5px; text-align:center;font-size:larger" onclick="signUp();">Sign up</div>
									</a>
								</div>
								<label for="" class="form-label">Already have account please signin</label>
								<div class="text-center d-grid col-12">
									<a href="signIn.php" class="btn btn-dark">Sign In</a>
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
	<script src="chosen.jquery.js"></script>
	<script src="script.js"></script>
	<script>
		var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
		var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
			return new bootstrap.Popover(popoverTriggerEl)
		})
	</script>

</body>

</html>