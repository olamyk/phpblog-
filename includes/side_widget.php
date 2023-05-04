
<?php 

	

	if (isset($_POST['username']) && isset($_POST['password'])) {

		login_user($_POST['username'], $_POST['password']);

		checkIfUserLoginAndRedirect('/blog/admin');

	}


?>

	<div class="col-lg-4">
		<!-- Search widget-->


		<div class="card mb-4">
			<div class="card-header">
				<b>Search</b>
			</div>
			<div class="card-body">
				<form action="search.php" method="post">
					<div class="input-group">
						<input class="form-control" name="search" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
						<button class="btn btn-primary" name="submit" id="button-search" type="submit">Go!</button>
					</div>
				</form>
			</div>
		</div>

		<!-- Login Widget -->

			<?php if (isset($_SESSION['user_role'])): ?>

				<div class="card-header text-center">
					<b class="">Login as <?php echo $_SESSION['username']; ?></b>

						<a href="includes/logout.php" class="btn btn-primary">Logout</a>
				</div>

			<?php else: ?>

				<div class="card mb-4">
					<div class="card-header text-center">
						<b class="">User Login</b>

					</div>
					<div class="card-body">
						<form  action="" method="post">
							<div class="input-group">
								<input class="form-control" name="username" type="text" placeholder="Enter Username..." />
								
							</div>
							<br>
							<div class="input-group">
								<input class="form-control" name="password" type="password" placeholder="Enter Password" aria-label="" aria-describedby="button-search" />
								<button class="btn btn-primary" name="login" type="submit">Login</button>
							</div>
							<div class="input-group">
								<a href="forget_password.php?forget=<?php echo uniqid(); ?>">forget password</a>
								
							</div>
						</form>
					</div>
				</div>

			<?php endif; ?>

		
		<!-- Categories widget-->
		<div class="card mb-4">
			<div class="card-header"><b>Categories</b></div>
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12">
						<ul class="list-unstyled mb-0">

							<?php 
							if (isset($_GET['cat_id'])){
								
								$cat_id = $_GET['cat_id'];
							}

							// $query = "SELECT * FROM posts WHERE post_category_id = $cat_id";
							// $count_each_categories = mysqli_query($connection, $query);
							 
							$query = "SELECT * FROM categories";
							$get_all_categories = mysqli_query($connection,$query);
							
							while($row=mysqli_fetch_assoc($get_all_categories)){
								
								$all_cat = $row['cat_tittle'];
								$cat_id  = $row['cat_id'];
								
								echo "<li><a href='category.php?category=$cat_id'>{$all_cat}()</a></li>";
								
							}
							
							?>

						</ul>
					</div>

				</div>
			</div>
		</div>
		<!-- Side widget-->
		<div class="card mb-4">
			<div class="card-header">Side Widget</div>
			<div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
		</div>
	</div>
