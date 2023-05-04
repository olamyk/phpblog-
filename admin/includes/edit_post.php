<?php 



	if(isset($_GET['p_id'])){
		
		$get_edit_post = $_GET['p_id'];
		
	}

		$query = "SELECT * FROM posts WHERE post_id = $get_edit_post ";
		$edit_post_query = mysqli_query($connection, $query);

		while($row = mysqli_fetch_assoc($edit_post_query)){

			$post_id = $row['post_id'];
			$post_category_id = $row['post_category_id'];
			$post_tittle = $row['post_tittle'];
			$post_author = $row['post_author'];
			$post_date = $row['post_date'];
			$post_image = $row['post_image'];
			$post_content = $row['post_content'];
			$post_tags = $row['post_tags'];
			$post_comment_count = $row['post_comment_count'];
			$post_status = $row['post_status'];

		}


	if(isset($_POST['update_post'])){


		$post_category_id = $_POST['post_category'];
		$post_tittle = $_POST['tittle'];
		$post_author = $_POST['author'];
		// $post_date = $_POST['post_date'];
		$post_image = $_FILES['image']['name'];
		$post_image_tmp = $_FILES['image']['tmp_name'];
		$post_content = $_POST['post_content'];
		$post_tags = $_POST['post_tags'];
		// $post_comment_count = $_POST['post_comment_count'];
		$post_status = $_POST['post_status'];

		move_uploaded_file($post_image_tmp, "../images/$post_image");

		if(empty($post_image)){

			$query = "SELECT * FROM posts WHERE post_id = $get_edit_post ";

			$select_image = mysqli_query($connection, $query);

			while ($row = mysqli_fetch_assoc($select_image)) {

				$post_image = $row['post_image'];
			}
		}

		

		$query = "UPDATE posts SET ";
		$query .= "post_category_id = {$post_category_id },";
		$query .= "post_tittle = '{$post_tittle}', ";
		$query .= "post_author = '{$post_author}',";
		$query .= "post_date = now(), ";
		$query .= "post_image = '{$post_image}', ";
		$query .= "post_content = '{$post_content}', ";
		$query .= "post_tags = '{$post_tags}', ";
		$query .= "post_comment_count = '{$post_comment_count}', ";
		$query .= "post_status = '{$post_status}' ";
		$query .= "WHERE post_id = {$get_edit_post} ";

		$all_update_post = mysqli_query($connection, $query);

		confirmQuery($all_update_post);

		echo "<p class='bg-success'>Post Updated! <a href='../post.php?p_id={$get_edit_post}'>View Post</a> or <a href='posts.php'>Edit Other Post</a> </p>";
	}

		




?>





<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="tittle">Post Tittle</label>
		<input value="<?php echo $post_tittle ; ?> " type="text" class="form-control" name="tittle">

	</div>
	<div class="form-group">
		<select name="post_category" id="post_category">

			<?php  // FETCH ALL CATEGORIES.
			
				$query = "SELECT * FROM categories ";
				$select_all_cat = mysqli_query($connection, $query);
				
				confirmQuery($select_all_cat);
			
				while($row = mysqli_fetch_assoc($select_all_cat)){
					
					$cat_id = $row['cat_id']; 
					$cat_tittle = $row['cat_tittle'];
					
				

					if ($cat_id == $post_category_id) {

						echo "<option selected value='{$cat_id}'>{$cat_tittle}</option>";
					}else{

						echo "<option value='{$cat_id}'>{$cat_tittle}</option>";
					}
				}
			
			?>

		</select>

	</div>
	<div class="form-group">
		<label for="author">Author</label>
		<input value="<?php echo $post_author; ?> " type="text" class="form-control" name="author" readonly>

	</div>

	<div class="form-group">
		<select name="post_status" id="">
			
			<option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>

			<?php 

				if ($post_status == 'published') {

					echo "<option value='draft'>Draft</option>";

				}else{

					echo "<option value='published'>Published</option>";
				}

			 ?>

		</select>
	</div>

	<div class="form-group">

		<img width=100 src="../images/<?php echo $post_image; ?> " alt="">

		

	</div>
	<div class="form-group">
		<input type="file" name="image" alt="">
	</div>



	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input value="<?php echo $post_tags; ?> " type="text" class="form-control" name="post_tags">

	</div>
	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" id="body" value="" cols="30" rows="10"><?php echo str_replace("\r\n", "", $post_content) ; ?></textarea>

	</div>
	<div class="form-group">

		<input type="submit" class="btn btn-primary" name="update_post" value="Publish Post">

	</div>


</form>
