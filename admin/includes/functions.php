<?php 


// TO SAVE DATA FROM ONLINE INJECTION

	function escape($string) {

		global $connection;

		return mysqli_real_escape_string($connection, trim($string));
	}


	function redirect($location) {

		header("Location:". $location);
		exit;
	}
	





								// WE ARE USING AJAX INSIDE FUNCTION HERE



// function user_online() {

// 	if (isset($_GET['onlineusers'])) {
		

// 		global $connection;

// 		if (!$connection) {

// 			session_start();
// 			include("../includes/db.php");

// 			$session = session_id();
// 			$time = time();
// 			$time_out_in_seconds = 05;
// 			$time_out = $time - $time_out_in_seconds;

// 			$query = "SELECT * FROM users_online WHERE session = '$session'";
// 			$count_query = mysqli_query($connection, $query);
// 			$count = mysqli_num_rows($count_query);


// 			if ($count == NULL) {

// 				mysqli_query($connection, "INSERT INTO users_online(session,time) VALUES('$session','$time') ");

// 			}else{

// 				mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
// 			}

// 			$users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");

// 			echo $count_user = mysqli_num_rows($users_online_query);


// 		}

	   


// 	}

	


// }
// user_online();











function user_online() {

	global $connection;

   $session = session_id();
    $time = time();
    $time_out_in_seconds = 60;
    $time_out = $time - $time_out_in_seconds;

    $query = "SELECT * FROM users_online WHERE session = '$session'";
    $count_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($count_query);
    

    if ($count == NULL) {

        mysqli_query($connection, "INSERT INTO users_online(session,time) VALUES('$session','$time') ");
     
    }else{

        mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
    }

    $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");

    return mysqli_num_rows($users_online_query);


}






function confirmQuery($result){
	global $connection;
	
	if(!$result){
		
		die("QUERY FAILED" . mysqli_error($connection));
	}
}




function Create_category(){
	
	global $connection;
		
	if(isset($_POST['submit'])){

		$cat_tittle = $_POST['cat_tittle'];

		if($cat_tittle == "" || empty($cat_tittle)){

			echo "This field should not be empty";
		}else{

			$stmt = mysqli_prepare("INSERT INTO categories(cat_tittle) VALUEs(?)");

			mysqli_stmt_bind_param($stmt, 's', $cat_tittle);

			mysqli_stmt_execute($stmt);

			echo "Category has been successfully created!";

			if(!$stmt){

				die("QUERY FAILED" . mysqli_error($connection));
			}
		}
	}

	
}



function Update_category(){
	
	
	global $connection;


	if(isset($_GET['edit'])){

		$cat_id = $_GET['edit'];

		$query = "SELECT * FROM categories WHERE cat_id = $cat_id ";
		$update_category = mysqli_query($connection, $query);

		while($row = mysqli_fetch_assoc($update_category)){

			$cat_tittle = $row['cat_tittle'];
		}
	?>
<input value="<?php if(isset($cat_tittle)) {echo $cat_tittle;} ?>" type="text" class="form-control" name="cat_tittle">

<?php
	}

	?>

<?php 
	if(isset($_POST['update'])){

		$cat_tittle = $_POST['cat_tittle'];

		$stmt = mysqli_prepare($connection, "UPDATE categories SET cat_tittle= ? WHERE cat_id= ? ");

		mysqli_stmt_bind_param($stmt, 'si', $cat_tittle, $cat_id);

		mysqli_stmt_execute($stmt);


		if(!$stmt){

			die("QUERY FAILED" . mysqli_error($connection));
		}else{

			header("Location: category.php");
		}


	}

}




function CategoryTable(){
	
		global $connection;

		$query = "SELECT * FROM categories";
		$all_category = mysqli_query($connection, $query);

		while($row = mysqli_fetch_assoc($all_category)){

			$cat_id = $row['cat_id'];
			$cat_tittle = $row['cat_tittle'];

			echo "<tr>";

			echo "<td>{$cat_id}</td>";
			echo "<td>{$cat_tittle}</td>";

			if ($_SESSION['user_role'] == 'subscriber') {
				
				echo "<td><a href=''>Delete</a></td>";
				echo "<td><a href=''>Edit</a></td>";
			}else {
			echo "<td><a href='category.php?delete={$cat_id}'>Delete</a></td>";
			echo "<td><a href='category.php?edit={$cat_id}'>Edit</a></td>";
			}
			echo "</tr>";

		}



		if(isset($_GET['delete'])){

			$the_cat_id = $_GET['delete'];

			$query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
			$delete_query = mysqli_query($connection, $query);
			header("Location: category.php");
		}


	
	
}




function createComment() {

	global $connection;

	if (isset($_POST['create_comment'])) {
                            
        $each_post_id  = $_GET['p_id'];
       
        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_content = $_POST['comment_content'];

        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
            

            $query ="INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
            $query .= "VALUES($each_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapprove', now())";

            $comment_query = mysqli_query($connection, $query);

            if (!$comment_query) {

                die("QUERY FAILED" . mysqli_error($connection));
            }


            // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
            // $query .= "WHERE post_id = $each_post_id";

            // $count_each_post_comment = mysqli_query($connection, $query);
        
        }else{


            return "<script>alert('FEILD CANNOT BE EMPTY')</script>";
        }

                           

    }


}


function recordCount($record) {
  		global $connection;

  		$query = "SELECT * FROM " . $record;

		$select_all_users = mysqli_query($connection, $query);

		return $count_users = mysqli_num_rows($select_all_users);



}




function checkStatus($table, $column, $status) {

	global $connection;

	$query = "SELECT * FROM $table WHERE $column = '$status' ";

    $select_all_published_posts = mysqli_query($connection, $query);

    return mysqli_num_rows($select_all_published_posts);
}	



function username_exists($username) {

	global $connection;

	$query = "SELECT username FROM users WHERE username= '$username' ";

	$result = mysqli_query($connection, $query);

	confirmQuery($result);

	if (mysqli_num_rows($result) > 0) {

		return true;

	}else{

		return false;
	}
}


function email_exists($email) {

	global $connection;

	$query = "SELECT user_email FROM users WHERE user_email = '$email' ";

	$result = mysqli_query($connection, $query);

	confirmQuery($result);

	if (mysqli_num_rows($result) > 0) {

		return true;

	}else{

		return false;
	}

}
	
	
function register_user($username, $email, $password) {

	global $connection;


    $username = mysqli_escape_string($connection, $username);
    $email    = mysqli_escape_string($connection, $email);
    $password = mysqli_escape_string($connection, $password);


    $password = password_hash($password, PASSWORD_BCRYPT, array("cost" => 10));
    
    $query = "INSERT INTO users(username, user_email, user_password, user_role) ";
    $query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber') ";
    $submit_user_query = mysqli_query($connection, $query);

    confirmQuery($submit_user_query);

	

}



function login_user($username, $password) {

	global $connection;


	$username = mysqli_escape_string($connection, $username);
	$password = mysqli_escape_string($connection, $password);

	$query = " SELECT * FROM users WHERE username = '{$username}'";
	$user_query = mysqli_query($connection, $query);

	if (!$user_query) {

		die("QUERY FAILED" . mysqli_error($connection));
	}

	while ($row = mysqli_fetch_array($user_query)) {

		$db_user_id   = $row['user_id'];
		$db_username  = $row['username'];
		$db_password  = $row['user_password'];
		$db_firstname = $row['user_firstname'];
		$db_lastname  = $row['user_lastname'];
		$db_role      = $row['user_role'];


		// $password = crypt($password, $db_password);



		if (password_verify($password, $db_password)) {

			$_SESSION['username'] = $db_username;
			$_SESSION['lastname'] = $db_lastname;
			$_SESSION['firstname'] = $db_firstname;
			$_SESSION['user_role']  = $db_role;



			redirect("/blog/admin");

		}else{

			return false;
			
		}


	}


	return true;



}



function ifIsMethod($method = null) {

	if ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {

		return true;

	}else{

		return false;
	}
}



function isLoggedIn() {

	if (isset($_SESSION['user_role'])) {

		return true;
	}

	return false;
}


function checkIfUserLoginAndRedirect($redirectLocation = null) {

	if (isLoggedIn()) {

		redirect($redirectLocation); 
	}
}







	
?>
