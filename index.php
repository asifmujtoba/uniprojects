<?php
include "lib/oms.php";
$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/lib/session.php';
$oms = new Oms();
if(isset($_POST['login'])){
    $login = $oms->login_check($_POST);
}
//Session::sessionCheck();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Uniprojects TaskBoard">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Sign In | TaskBoard</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">TaskBoard Sign In</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="img/avatars/profile-blue.png" alt="Profile Pic" class="img-fluid rounded-circle" width="132" height="132" />
									</div>
									<form role="form" action="" method="post">
                                        <fieldset>
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" />
                                            <?php
                                            if(isset($login['email'])){
                                                echo $login['email'];
                                            }
                                            ?>
                                        </div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
											<?php
                                            if(isset($login['password'])){
                                                echo $login['password'];
                                            }
                                            ?>
                                            <small>
            <a href="pages-reset-password.html">Forgot password?</a>
          </small>
										</div>
										<div>
											<label class="form-check">
            <input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
            <span class="form-check-label">
              Remember me next time
            </span>
          </label>
										</div>
										<div class="text-center mt-3">
											<!-- <a href="index.html" class="btn btn-lg btn-primary">Sign in</a> -->
                                          <input type="submit" name="login" class="btn btn-lg btn-success " value="Login"/> 
                                            <?php 
                                                if(isset($login["error"])){
                                                    echo $login["error"];
                                                }
                                            ?>
                                        </div>
                                            </fieldset>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>
</body>
</html>