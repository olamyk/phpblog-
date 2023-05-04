<?php include "includes/header.php"; ?>

<!-- Responsive navbar-->
<?php include "./includes/navbar.php"; ?>




<?php 

	

	if (isset($_POST['username']) && isset($_POST['password'])) {

		login_user($_POST['username'], $_POST['password']);

		checkIfUserLoginAndRedirect('/blog/admin');

	}



?>




<!-- Page Content -->
<div class="container">

	<div class="form-gap"></div>
	<div class="container">
		<div class="row" style="width:auto; height: auto; justify-content: center; align-content: center;">
			<div class="col-md-6 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="card mb-4 text-center">


							<h3><i class="fa fa-user fa-4x"></i></h3>
							<h2 class="card-header text-center">Login</h2>
							<div class="card-body ">


								<form id="login-form" role="form" autocomplete="off" class="form" method="post">

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>

											<input name="username" type="text" class="form-control" placeholder="Enter Username">
										</div>
									</div>
									<br>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
											<input name="password" type="password" class="form-control" placeholder="Enter Password">
										</div>
									</div>
									<br>
									<div class="form-group">

										<input name="login" class="btn btn-lg btn-primary btn-block" value="Login" type="submit">
									</div>


								</form>

							</div><!-- Body-->

						</div>
					</div>
				</div>
			</div>
		</div>


	</div>



</div> <!-- /.container -->

	<hr>

	<?php include "includes/footer.php";?>

</div> <!-- /.container -->