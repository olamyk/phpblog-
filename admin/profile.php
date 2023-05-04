<?php include "includes/header.php"; ?>

<div id="wrapper">

	<!-- Navigation -->


	<?php include "includes/nav.php"; ?>

	<?php 
		if (isset($_SESSION['username'])) {
	
 			$username = $_SESSION['username'];


 			$query = "SELECT * FROM users WHERE username = '{$username}'";

 			$update_ech_user_query = mysqli_query($connection, $query);

 			while ($row = mysqli_fetch_array($update_ech_user_query)) {

				$user_id = $row['user_id'];
				$username = $row['username'];
				$user_firstname = $row['user_firstname'];
				$user_lastname = $row['user_lastname'];
				$user_email = $row['user_email'];
				$user_role = $row['user_role'];
				$user_password = $row['user_password'];
				$user_image = $row['user_image'];
				// $post_comment_count = $row['post_comment_count'];
				// $post_status = $row['post_status'];
 			
 			}

 			
	}

	if (isset($_POST['update_profile'])) {
		
		


		$username 		= $_POST['username'];
		$user_firstname = $_POST['user_firstname'];
		$user_lastname 	= $_POST['user_lastname'];
		$user_email 	= $_POST['user_email'];
		$user_role 		= $_POST['user_role'];
		$user_password	= $_POST['user_password'];
		$user_image 	= $_FILES['image']['name'];
		$user_image_tmp = $_FILES['image']['tmp_name'];
		// $post_status = $_POST['post_status'];

		move_uploaded_file($user_image_tmp, "../images/$user_image");

		
		$hash_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

		if (!empty($username) && !empty($user_email) && !empty($user_password)) {

			$query = "UPDATE users SET ";
			// $query .= "user_id = {$user_id },";
			$query .= "user_image = '{$user_image}', ";
			$query .= "user_firstname = '{$user_firstname}',";
			// $query .= "post_date = now(), ";
			$query .= "user_lastname = '{$user_lastname}', ";
			$query .= "user_email = '{$user_email}', ";
			$query .= "user_password = '{$hash_password}', ";
			$query .= "user_role = '{$user_role}' ";
			$query .= "WHERE username = '{$username}' ";


			// $query = "UPDATE users SET username = '{$username}', user_firstname = {$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_role = '{$user_role}', user_password = '{$user_password}', user_image = '{$user_image}') ";
			// $query .=" WEHERE user_id = '{$username}' ";

			$submit_edit_profile = mysqli_query($connection, $query);

			if (!$submit_edit_profile) {
				
				die("QUERY FAILED" . mysqli_error($connection));
			}
		}
		
	}

 			
 
	?>


	<div id="page-wrapper">

		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<?php include "includes/welcome_author.php"?>


				</div>







<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="tittle">Firstname</label>
		<input value="<?php echo $user_firstname ; ?>" type="text" class="form-control" name="user_firstname">

	</div>
	<!-- <div class="form-group">
		<select name="user_role" id="user_role">

			<option value=''>Select Role</option>
			<option value='{$user_id}'>Admin</option>
			<option value='{$cat_id}'>subscriber</option>

		</select>

	</div> -->
	<div class="form-group">
		<label for="author">Lastname</label>
		<input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">

	</div>
	<div class="form-group">
		<label for="status">Username</label>
		<input value="<?php echo $username; ?>" type="text" class="form-control" name="username">

	</div>

	<div class="form-group">
		<img width=100 src="../images/<?php echo $user_image; ?> " alt="">
		<input type="file" name="image" alt="">
	</div>



	<div class="form-group">
		<label for="post_tags">mail</label>
		<input value="<?php echo $user_email; ?>" type="text" class="form-control" name="user_email">

	</div>
	<div class="form-group">
		<label for="post_tags">User's Role</label>
		<input value="<?php echo $user_role; ?>" type="text" class="form-control" name="user_role" readonly>

	</div>
	<div class="form-group">
		<label for="post_tags">Password</label>
		<input autocomplete="off" type="password" class="form-control" name="user_password">

	</div>
	
	<div class="form-group">

		<input type="submit" class="btn btn-primary" name="update_profile" value="Update User">

	</div>


</form>



			</div>


		</div>



	</div>
	<!-- /.row -->

</div>
<!-- /.container-fluid -->


<!-- /#page-wrapper -->

<?php include "includes/footer.php"; ?>
