<?php 



	if(isset($_GET['user_id'])){
		
		$get_edit_user = $_GET['user_id'];
		
	

		$query = "SELECT * FROM users WHERE user_id = $get_edit_user ";

		$edit_user_query = mysqli_query($connection, $query);

		confirmQuery($edit_user_query);

		while($row = mysqli_fetch_assoc($edit_user_query)){

			$user_id = $row['user_id'];
			$username = $row['username'];
			$user_firstname = $row['user_firstname'];
			$user_lastname = $row['user_lastname'];
			$user_email = $row['user_email'];
			$user_role = $row['user_role'];
			$user_password = $row['user_password'];
			$user_image = $row['user_image'];
			// $post_comment_count = $row['post_comment_count'];
			$user_date = $row['user_date'];

		}

		

if(isset($_POST['update_user'])){


	// $user_id = $_POST['user_id'];
	$username = $_POST['username'];
	$user_firstname = $_POST['user_firstname'];
	$user_date = $_POST['user_date'];
	$user_image = $_FILES['image']['name'];
	$user_image_tmp = $_FILES['image']['tmp_name'];
	$user_lastname = $_POST['user_lastname'];
	$user_email = $_POST['user_email'];
	$user_password = $_POST['user_password'];
	// $user_role = $_POST['user_role'];

	move_uploaded_file($user_image_tmp, "../images/$user_image");

	if(empty($user_image)){

		$query = "SELECT * FROM users WHERE user_id = $get_edit_user ";

		$select_image = mysqli_query($connection, $query);

		while ($row = mysqli_fetch_assoc($select_image)) {

			$user_image = $row['user_image'];
		}
	}

	// THIS QUERY RE ENCRYPT THE PASSWORD DURING UPDATE

		
	if (!empty($user_password)) {
		
		$pass_query = "SELECT user_password FROM users WHERE user_id = $get_edit_user ";
		$select_encypt = mysqli_query($connection, $pass_query);
		confirmQuery($select_encypt);
		$row = mysqli_fetch_array($select_encypt);
		$db_password = $row['user_password'];

		if ($db_password != $user_password || $db_password == $user_password) {

		$hash_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

		}


		$query = "UPDATE users SET ";
		// $query .= "user_id = {$user_id },";
		$query .= "user_firstname = '{$user_firstname}',";
		$query .= "user_date = now(), ";
		$query .= "user_lastname = '{$user_lastname}', ";
		$query .= "user_email = '{$user_email}', ";
		$query .= "user_password = '{$hash_password}' ";
		// $query .= "user_role = '{$user_role}', ";
		$query .= "WHERE user_id = {$get_edit_user} ";

		$all_update_post = mysqli_query($connection, $query);

		confirmQuery($all_update_post);

		echo "User has been Updated  " . " " . "<a href='users.php'>View User</a>";
	}
	
	
	
}


}else{

	header("Location: index.php");
}		




?>










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
	<!-- <div class="form-group">

		<img width=100 src="../images/<?php  ?> " alt="">

		

	</div> -->
	<div class="form-group">
		<img width=100 src="../images/<?php echo $user_image; ?> " alt="">
		<input type="file" name="image" alt="">
	</div>



	<div class="form-group">
		<label for="post_tags">mail</label>
		<input value="<?php echo $user_email; ?>" type="text" class="form-control" name="user_email">

	</div>
	<div class="form-group">
		<label for="post_tags">Password</label>
		<input autocomplete="off" type="password" class="form-control" name="user_password">

	</div>
	
	<div class="form-group">

		<input type="submit" class="btn btn-primary" name="update_user" value="Update User">

	</div>


</form>
