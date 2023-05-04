<?php include "includes/header.php"; ?>


<div id="wrapper">

	<!-- Navigation -->


	<?php include "includes/nav.php"; ?>



	<div id="page-wrapper">

		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<?php include "includes/welcome_author.php"?>
				</div>
			</div>
			<!-- /.row -->


<table class="table table-bordered table-hover">

	<thead>
		<tr>
			<th>ID</th>
			<th>Author</th>
			<th>Email</th>
			<th>Status</th>
			<th>In Response To</th>
			<th>Post ID</th>
			<th>Approve</th>
			<th>Unapprove</th>
			<th>Comment</th>
			<th>Date</th>
			<th>Delete</th>

		</tr>
	</thead>
	<tbody>

		<?php 

		$query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($connection, $_GET['id']) . " ";
		$comment_query = mysqli_query($connection, $query);

		while($row = mysqli_fetch_assoc($comment_query)){

			$comment_id = $row['comment_id'];
			$comment_post_id = $row['comment_post_id'];
			$comment_email = $row['comment_email'];
			$comment_author = $row['comment_author'];
			$comment_date = $row['comment_date'];
			$comment_status = $row['comment_status'];
			$comment_content = $row['comment_content'];

		echo "<tr>";

			echo "<td>{$comment_id}</td>";
			
			echo "<td>{$comment_author}</td>";
			echo "<td>{$comment_email}</td>";
			echo "<td>{$comment_status}</td>";

			$query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
			$get_post_id = mysqli_query($connection, $query);
		
			while($row = mysqli_fetch_assoc($get_post_id)){

				$post_id = $row['post_id'];
				$post_tittle = $row['post_tittle'];

			echo "<td><a href='../post.php?p_id=$post_id'> $post_tittle</a></td>";	
		}

		
			echo "<td>{$comment_post_id}</td>";
			echo "<td><a class='btn btn-primary' href='post_comment.php?approve=$comment_id'>Approve</a></td>";
			echo "<td><a class='btn btn-warning' href='post_comment.php?unapprove=$comment_id'>Unapprove</a></td>";
			echo "<td>{$comment_content}</td>";
			echo "<td>{$comment_date}</td>";
			echo "<td><a class='btn btn-danger' href='post_comment.php?delete=$comment_id&id=" . $_GET['id'] ."'>Delete</a></td>";

		echo "</tr>";
    }
	?>
	</tbody>

</table>


<?php 



	if(isset($_GET['approve'])){
		
		$approve_comment = $_GET['approve'];
		
		
		$query = " UPDATE comments SET comment_status = 'approved' WHERE comment_id = $approve_comment  ";
		$approve_query = mysqli_query($connection, $query);
		
		if(!$approve_query){
			
			die("QUERY FAILED");
		}else{
			header("Location: post_comment.php");
		}
		
	}





	if(isset($_GET['unapprove'])){
		
		$unapprove_comment = $_GET['unapproved'];
		
		$query = " UPDATE comments SET comment_status = 'unapproved' ";
		$unapprove_query = mysqli_query($connection, $query);
		
		if(!$unapprove_query){
			
			die("QUERY FAILED");
		}else{
			header("Location: post_comment.php");
		}
		
	}








	if(isset($_GET['delete'])){
		
		$delete_comment = $_GET['delete'];
		
		
		$query = " DELETE FROM comments WHERE comment_id = {$delete_comment} ";
		$delete_query = mysqli_query($connection, $query);
		
		if(!$delete_query){
			
			die("QUERY FAILED");
		}else{
			header("Location: post_comment.php?id=". $_GET['id']. " ");
		}
		
	}


?>



				</div>


			</div>


		</div>



	</div>
	<!-- /.row -->

</div>
<!-- /.container-fluid -->


<!-- /#page-wrapper -->

<?php include "includes/footer.php"; ?>