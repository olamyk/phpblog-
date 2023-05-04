<?php 

	if(isset($_POST['create_user'])){
		
		$username = $_POST['username'];
		$user_firstname = $_POST['user_firstname'];
		$user_lastname = $_POST['user_lastname'];
		$user_email = $_POST['user_email'];
		
		$user_image = $_FILES['image']['name'];
		$post_image_tmp = $_FILES['image']['tmp_name'];
		
		$user_password = $_POST['user_password'];
		$user_role = 'subscriber';
		
		$user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
		
		move_uploaded_file($post_image_tmp,"../images/$user_image");
		
		
	$query = "INSERT INTO users (username, user_firstname, user_lastname, user_email, user_password, user_role, user_image) ";

	$query .= "VALUES('{$username}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_password}','{$user_role}','{$user_image}')";

	$create_query = mysqli_query($connection, $query);
		
		echo "User has been created  " . " " . "<a href='users.php'>View User</a>";

		
	if(!$create_query){
		
		die("QUERY FAILED" . mysqli_error($connection));
	}

		
	 }else{


	 }



?>


<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="tittle">First Name</label>
		<input type="text" class="form-control" name="user_firstname">

	</div>
	

	<!-- <div class="form-group">
		

		<select name="post_category" id="post_category">

			// <?php 

			//	$query = "SELECT * FROM categories";
			//	$select_all_cat = mysqli_query($connection, $query);
			//	confirmQuery($select_all_cat);
			//	while($row = mysqli_fetch_assoc($select_all_cat)){

			//		$cat_id = $row['cat_id'];
			//		$cat_tittle = $row['cat_tittle'];

			//		echo "<option value='{$cat_id}'>{$cat_tittle}</option>";
				//}

			//?>
			
		</select>

	</div> -->


	<div class="form-group">
		<label for="author">Lastname</label>
		<input type="text" class="form-control" name="user_lastname">

	</div>
	<div class="form-group">
		<label for="status">Username</label>
		<input type="text" class="form-control" name="username">

	</div>
	<div class="form-group">
		<label for="post_image">Email</label>
		<input type="email" class="form-control" name="user_email">

	</div>
	<div class="form-group">
		
		<input type="file"  name="image">

	</div>

	<div class="form-group">
		<label for="post_tags">Password</label>
		<input type="text" class="form-control" name="user_password">

	</div>
	
	<div class="form-group">

		<input type="submit" class="btn btn-primary" name="create_user" value="Add User">

	</div>


</form>
