<table class="table table-bordered table-hover">

	<thead>
		<tr>
			<th>Id</th>
			<th>Username</th>
			<th>Firstname</th>
			<th>Lastname</th>
			<th>Email</th>
			<th>Role</th>
			<th>Image</th>
			<th>Change Role</th>
			<!-- <th>Sub</th> -->
			<th>Edit</th>
			<th>Delete</th>

		</tr>
	</thead>
	<tbody>

		<?php 

		$query = "SELECT * FROM users";
		$user_query = mysqli_query($connection, $query);

		while($row = mysqli_fetch_assoc($user_query)){

			$user_id = $row['user_id'];
			$username = $row['username'];
			$user_password = $row['user_password'];
			$user_firstname = $row['user_firstname'];
			$user_lastname = $row['user_lastname'];
			$user_email = $row['user_email'];
			$user_image = $row['user_image'];	
			$user_role = $row['user_role'];

		echo "<tr>";

			echo "<td>{$user_id}</td>";
			
			echo "<td>{$username}</td>";
			echo "<td>{$user_firstname}</td>";

		// $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";

		// $get_post_cat = mysqli_query($connection, $query);
		
		// confirmQuery($get_post_cat);
		
		// while($row = mysqli_fetch_assoc($get_post_cat)){

		// 	$cat_id = $row['cat_id'];
		// 	$cat_tittle = $row['cat_tittle'];


		// 	echo "<td>{$cat_tittle}</td>";

			
		// }
			
			



			echo "<td>{$user_lastname}</td>";
			
			echo "<td>{$user_email}</td>";
			echo "<td>{$user_role}</td>";
			echo "<td><img width='100' src='../images/{$user_image}' ></td>";
			
			if($user_role == 'admin'){

				echo "<td><a class='btn btn-dark' href='users.php?subscibe={$user_id}'>Subscriber</a></td>";
			}else{

			echo "<td><a class='btn btn-dark' href='users.php?admin={$user_id}'>Admin</a></td>";
			}
			echo "<td><a class='btn btn-primary' href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>";
			echo "<td><a class='btn btn-danger' href='users.php?delete={$user_id}'>Delete</a></td>";

		echo "</tr>";

		}
	?>


	</tbody>

</table>


<?php //     DELETE USER

	if(isset($_GET['delete'])){
		
		

		if (isset($_SESSION['user_role'])) {

			if ($_SESSION['user_role'] == 'admin') {
				
				$the_user_id = $_GET['delete'];
			
				$query = " DELETE FROM users WHERE post_id = {$the_user_id} ";
				$delete_query = mysqli_query($connection, $query);
				
				if(!$delete_query){
					
					die("QUery FAiled");
				}else{
					header("Location: users.php");
				}
			}
			
			


		}
		
	}



	//				EDIT USER

	if(isset($_GET['edit'])){
		
		$the_user_id = $_GET['edit'];
		
		
		$query = " SELECT * FROM posts WHERE user_id = {$the_user_id} ";
		$edit_user_query = mysqli_query($connection, $query);
		
		if(!$edit_user_query){
			
			die("QUery FAiled");
		}else{
			header("Location: users.php");
		}
		
	}



	//				ASSIGN USER AS ADMIN

	if(isset($_GET['admin'])){
		
		$the_user_id = $_GET['admin'];
		
		
		$query = " UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";
		$change_user_role_query = mysqli_query($connection, $query);
		
		if(!$change_user_role_query){
			
			die("QUery FAiled");
		}else{
			header("Location: users.php");
		}
		
	}




	//				ASSIGN USER AS SUBSCRIBER

	if(isset($_GET['subscibe'])){
		
		$the_user_id = $_GET['subscibe'];
		
		
		$query = " UPDATE users SET user_role = 'subsciber' WHERE user_id = $the_user_id ";
		$change_user_role_query = mysqli_query($connection, $query);
		
		if(!$change_user_role_query){
			
			die("QUery FAiled");
		}else{
			header("Location: users.php");
		}
		
	}

?>
