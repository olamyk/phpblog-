<?php include_once("admin/includes/functions.php"); ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container">




		<a class="navbar-brand color-#29ABE2" href="/blog">Cip<span class="text-primary">her</span>Bug</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">

				<?php
	
				$query = "SELECT * FROM categories";
				$select_all_from_query = mysqli_query($connection, $query);
				
				while($row = mysqli_fetch_assoc($select_all_from_query)){
					
					$get_all = $row['cat_tittle'];
					$nav_cat = $row['cat_id'];


					$category_class = "";
					$registration = "";

					$pageName = basename($_SERVER['PHP_SELF']);

					$registration = "registration.php";

					$contact = "contact.php";

					if (isset($_GET['category']) && $_GET['category'] == $nav_cat) {

						$category_class = "active";

					}elseif ($pageName == $registration) {

						$registration = "active";

					}elseif ($pageName == $contact) {

						$contact = "active";
					}

					echo "<li class='nav-item '><a class='nav-link {$category_class}' href='/blog/category.php?category=$nav_cat'>{$get_all}</a></li>";
				}

				?>
				<!-- USING THIS TO GIVE SPACE IN NAV BAR -->
				<li class="nav-item"><a class="nav-link"></a></li>
				<li class="nav-item"><a class="nav-link"></a></li>
				<li class="nav-item"><a class="nav-link active" aria-current="page"></a></li>



				<?php if (isLoggedIn()): ?>

						<li class="nav-item"><a class="nav-link" href="/blog/admin">Admin</a></li>

				<?php else: ?>

						<li class="nav-item"><a class="nav-link" href="/blog/login">Login</a></li>

				<?php endif; ?>




				<li class="nav-item"><a class="nav-link <?php echo $registration; ?>" href="/blog/registration">Registration</a></li>

				
				<!--
				<li class="nav-item"><a class="nav-link" href="#!">About</a></li>
				<li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
				-->


				<li class="nav-item"><a class="nav-link <?php echo $contact; ?>" aria-current="page" href="/blog/contact">Contact</a></li>

				<?php 

					if (isset($_SESSION['username'])) {

						if (isset($_GET['p_id'])) {

							echo $_GET['p_id'];

							$the_post_id = $_GET['p_id'];

					echo " <li class='nav-item'><a class='nav-link' href='/blog/admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit</a></li>";
							
						}


					}



				?>

			</ul>
		</div>
	</div>
</nav>


<style type="text/css">
	.background {

		width: 100%;
		height: 250px;
	}

	.get {
		position: absolute;
		top: 50%;
		left: 50%;
		right: 10%;
		bottom: -30%;
		transform: translate(-50%, -50%);
	}

</style>
<!-- Page header with logo and tagline-->
<header class="py-2 bg-light border-bottom mb-4 has-bg-img ">
	<img class="bg-img background" src="images/banner.jpg">
	<div class="container">
		<div class="text-center my-5 get">
			<h1 class="fw-bolder text-white">Welcome To Our Blog!</h1>

			<p class="lead mb-0 text-white">A Bootstrap 5 starter layout for your next blog homepage</p>

		</div>
	</div>
</header>
