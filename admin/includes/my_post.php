


<form action="" method="post" class="">


<table class="table table-bordered table-hover">

	<thead>
		<tr>
			<th><input type="checkbox" name="" id="selectAllBoxes" ></th>
			<th>Id</th>
			<th>Tittle</th>
			<th>Author</th>
			<th>Category</th>
			<th>Date</th>
			<th>Images</th>
			<th>Tags</th>
			<th>Comment_Count</th>
			<th>Status</th>
			<th>View Post</th>
			<th>Edit</th>
			<th>Delete</th>

		</tr>
	</thead>
	<tbody>

		<?php 

		// 				PAGINATION QUERY

		$post_query = "SELECT * FROM posts";
		$count_post = mysqli_query($connection, $post_query);
		$count = mysqli_num_rows($count_post);

		$count = ceil($count / 5);

		 $limited_display = 7;

		 if (isset($_GET['page'])) {

		 	$page = $_GET['page'];

		 }else{

		 	$page = "";
		 }

		 if ($page == "" || $page == 1) {

		 	$page_1 = 0;

		 }else{

		 	$page_1 = ($page * $limited_display) - $limited_display;

		 }								// PAGINATION END HERE
	


		if ($_SESSION['username']) {

			$user_role = $_SESSION['username'];
		
		}
		

		$query = "SELECT * FROM posts WHERE post_author= '{$user_role}' ";
		$post_query = mysqli_query($connection, $query);

		while($row = mysqli_fetch_assoc($post_query)){

			$post_id = $row['post_id'];
			$post_category_id = $row['post_category_id'];
			$post_tittle = $row['post_tittle'];
			$post_author = $row['post_author'];
			$post_date = $row['post_date'];
			$post_image = $row['post_image'];
			$post_tags = $row['post_tags'];
			$post_comment_count = $row['post_comment_count'];
			$post_status = $row['post_status'];
			$post_views_count = $row['post_views_count'];	
	

		echo "<tr>";
		?>

			<td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id; ?>" ></td>

		<?php

			echo "<td>{$post_id}</td>";
			
			echo "<td>{$post_tittle}</td>";
			echo "<td>{$post_author}</td>";

		$query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";

		$get_post_cat = mysqli_query($connection, $query);
		
		confirmQuery($get_post_cat);
		
		while($row = mysqli_fetch_assoc($get_post_cat)){

			$cat_id = $row['cat_id'];
			$cat_tittle = $row['cat_tittle'];


			echo "<td>{$cat_tittle}</td>";

			
		}
			
			



			echo "<td>{$post_date}</td>";
			echo "<td><img width='100' height='60' src='../images/{$post_image}' ></td>";
			echo "<td>{$post_tags}</td>";

			$query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
			$comment_query_count = mysqli_query($connection, $query);
			$row = mysqli_fetch_array($comment_query_count);
			$comment_id = $row['comment_id'];
			$count_comment = mysqli_num_rows($comment_query_count);

			echo "<td><a href='post_comment.php?id=$post_id'>{$count_comment}</a></td>";




			echo "<td>{$post_status}</td>";
			echo "<td><a href='../post.php?p_id={$post_id}'>view post</a></td>";
			echo "<td><a class='btn btn-primary' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
			echo "<td><a class='btn btn-danger ' id='my-link' href='' rel='$post_id'>Delete</a></td>";
			// echo "<td><a onClick= \" javascript: return confirm('Are you sure you want to Delete');\" class='btn btn-danger' href='posts.php?delete=$post_id'>Delete</a></td>";
			echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";

		echo "</tr>";

		}

		
	?>


	
		
	</tbody>

</table>

<div class="row">
	
	<!-- Pagination-->

			<nav aria-label="Pagination">
				<hr class="my-0" />
				<ul class="pagination justify-content-center my-4">

					<?php 

						for ($i=1; $i <= $count; $i++) { 


							if ($i == $page) {
								
								echo "<li class='page-item active' aria-current='page'><a class='page-link' href='posts.php?page={$i}'>{$i}</a></li>";

							}else{

								echo "<li class='page-item'><a class='page-link' href='posts.php?page={$i}'>{$i}</a></li>";
							}

							
						}

					?>

				</ul>
			</nav>

</div>

</form>







<?php // DELETE BLOG POSTS

	if (isset($_SESSION['user_role'])) {

		if ($_SESSION['user_role'] == 'admin') {

			if(isset($_GET['delete'])){
			
				$the_post_id = mysqli_real_escape_string($connection, $_GET['delete']);
				
				
				$query = " DELETE FROM posts WHERE post_id = {$the_post_id} ";
				$delete_query = mysqli_query($connection, $query);
				
				if(!$delete_query){
					
					die("QUery FAiled");
				}else{
					header("Location: your_post.php");
				}
		
			}
		}

		
	}
	


	if (isset($_GET['reset'])) {
		
		$the_post_id = $_GET['reset'];
										// YOU CAN CALL IT THIS WAY BY SCAPING IT
		// $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =". mysqli_escape_string($connection, $_GET['reset']) . "  ";

		$query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$the_post_id} ";


		$reset_query = mysqli_query($connection, $query);

		if (!$reset_query) {

			die("Query Failed!");
		}else{

			header("Location: posts.php");
		}
		
	}


?>


<script type="text/javascript">
	
	$(document).ready(function(){

		$("#my_link").on('click', function(){

			var id = $(this).attr("rel");

			console.log(id);
		});




	});




	



 </script> 



