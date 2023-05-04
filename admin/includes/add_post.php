<?php 

	if(isset($_POST['create_post'])){
		
		$post_tittle = escape($_POST['tittle']);
		$post_category_id = escape($_POST['post_category']);
		$post_author = escape($_POST['author']);
		$post_status = escape('draft');
		
		$post_image = escape($_FILES['image']['name']);
		$post_image_tmp = escape($_FILES['image']['tmp_name']);
		
		$post_tags = escape($_POST['post_tags']);
		$post_content = escape($_POST['post_content']);
		$post_date = escape(date('d-m-y'));
		
		move_uploaded_file($post_image_tmp,"../images/$post_image");
		
		
	$query = "INSERT INTO posts(post_category_id, post_tittle, post_author, post_status, post_image, post_tags, 
	post_content, post_date) ";

	$query .= "VALUES({$post_category_id},'{$post_tittle}','{$post_author}','{$post_status}','{$post_image}','{$post_tags}',
	'{$post_content}',now())";

	$create_query = mysqli_query($connection, $query);

		
	
	if(!$create_query){
		
		die("QUERY FAILED" . mysqli_error($connection));

	}else{

		// THIS QUERY DOESN'T WORK FOR HERE BECAUSE I SUBMIT THE CREATED POSTS AS DRAFT BY DEFAULT

		// $get_edit_post = mysql_insert_id($connection);
		echo "<p class='bg-success'>Post Created!<a href='posts.php'>Edit Other Post</a> </p>";
	}

		
	}



?>


<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="tittle">Post Tittle</label>
		<input type="text" class="form-control" name="tittle">

	</div>
	

	<div class="form-group">
		<select name="post_category" id="post_category">

			<?php 
				$query = "SELECT * FROM categories";
				$select_all_cat = mysqli_query($connection, $query);
				confirmQuery($select_all_cat);
				while($row = mysqli_fetch_assoc($select_all_cat)){

					$cat_id = $row['cat_id'];
					$cat_tittle = $row['cat_tittle'];

					echo "<option value='{$cat_id}'>{$cat_tittle}</option>";
				}

			?>
			
		</select>
	</div>

	 <?php 

	 	if(isset($_SESSION['username'])){

	 		$username = $_SESSION['username'];
	 	}

	 	echo "<div class='form-group'>
		<label for='author'>Author</label>
		<input type='text' class='form-control' name='author' value='$username' readonly> 

	</div>"

	 ?>
	
	<!-- <div class="form-group">
		<label for="status">Post Status</label>
		<input type="text" class="form-control" name="post_status">

	</div> -->
	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" name="image">

	</div>
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" class="form-control" name="post_tags">

	</div>
	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" id="body"  name="post_content" id="" cols="30" rows="10"></textarea>

	</div>

	
	

	<div class="form-group">

		<input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">

	</div>


</form>


<script type="text/javascript">

	ClassicEditor
		.create( document.querySelector( '#body' ), {
	        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
	        heading: {
	            options: [
	                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
	                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
	                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
	            ]
	        }
	    } )
	    .catch( error => {
	        
	        console.log( error );
	    } );
</script>