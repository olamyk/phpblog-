<?php include "includes/header.php"; ?>

<!-- Responsive navbar-->
<?php include "includes/navbar.php"; ?>


<!-- Page content-->
<div class="container">
	<div class="row">
		<!-- Blog entries-->
		<div class="col-lg-8">
	
			<div class="row">

				<?php 

				$post_query = "SELECT * FROM posts WHERE post_status = 'published' ";
				$count_post = mysqli_query($connection, $post_query);
				$count = mysqli_num_rows($count_post);

				if ($count < 1 ) {
					
					echo "<h1 class='text-center'> No Posts Available!</h1>";

				}else{


				

				$count = ceil($count / 6);

				if (isset($_GET['page'])) {

					$page = $_GET['page'];

				}else{

					$page = "";
				}

				if ($page == '' || $page == 1) {
					
					$page_1 = 0;
				}else{

					$page_1 = ($page * 6) - 6;
				}


				
				$query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_date LIMIT $page_1, 6 ";
				$select_all_from_post = mysqli_query($connection, $query);
				
				while($row = mysqli_fetch_assoc($select_all_from_post)){
					$post_id = $row['post_id'];
					$post_image = $row['post_image'];
					$post_date = $row['post_date'];
					$post_tittle = $row['post_tittle'];
					$post_content = substr($row['post_content'], 0, 110);
					$post_author = $row['post_author'];
					$post_status = $row['post_status'];


					?>

						<div class="col-lg-6">
						
						<!-- Blog post-->
						<div class="card mb-4">
							<a href="post.php?p_id=<?php echo $post_id; ?>"><img class="card-img-top " src="images/<?php echo $post_image; ?>" alt="..." /></a>
							<div class="card-body">

								<div class="row">
	                            	<div class="text-muted fst-italic col-lg-6 mb-2"><?php echo $post_date ?> </div>
		                            <div class="text-muted fst-italic col-lg-6 mb-2 text-center"><b>Author</b>&nbsp;&#160;
		               <span class="badge  text-decoration-none link-light "><a href="author_post.php?author=<?php echo $post_author;?>&p_id=<?php echo $post_id;?>"><?php echo $post_author ?></a></span>
		                            </div>
	                         	</div>
								<h2 class="card-title h4"><?php echo $post_tittle ?></h2>
								<p class="card-text"><?php echo $post_content ?>...</p>
								<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read more →</a>

							</div>
						</div>
					</div>


				<?php } }?>




			</div>
			<!-- Pagination-->
			<nav aria-label="Pagination">
				<hr class="my-0" />
				<ul class="pagination justify-content-center my-4">

					<?php 

						for ($i=1; $i <= $count; $i++) { 


							if ($i == $page) {
								
								echo "<li class='page-item active' aria-current='page'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";

							}else{

								echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
							}

							
						}

					?>


					<!-- <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
					<li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
					<li class="page-item"><a class="page-link" href="#!">2</a></li>
					<li class="page-item"><a class="page-link" href="#!">3</a></li>
					<li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
					<li class="page-item"><a class="page-link" href="#!">15</a></li>
					<li class="page-item"><a class="page-link" href="#!">Older</a></li> -->
				</ul>
			</nav>
		</div>
		<!-- Side widgets-->


		<?php include "includes/side_widget.php" ?>




	</div>
</div>
<!-- Footer-->

<?php  include "includes/footer.php"?>
