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

				if (isset($_GET['category'])) {

					$cat_march_post_id = $_GET['category'];
				
				
				$query = "SELECT * FROM posts WHERE post_category_id = $cat_march_post_id AND post_status= 'published' ";
				$select_all_from_post = mysqli_query($connection, $query);

				if (mysqli_num_rows($select_all_from_post) < 1) {
					
					echo "<h1 class='text-center'>No Posts Available!</h1>";

				}else{

				while($row = mysqli_fetch_assoc($select_all_from_post)){
					$post_id = $row['post_id'];
					$post_image = $row['post_image'];
					$post_date = $row['post_date'];
					$post_tittle = $row['post_tittle'];
					$post_content = substr($row['post_content'], 0, 120);
					$post_author = $row['post_author'];
					
					?>


				<div class="col-lg-6">
					<!-- Blog post-->
					<div class="card mb-4">
						<a href="#!"><img class="card-img-top" src="images/<?php echo $post_image; ?>" alt="..." /></a>
						<div class="card-body">

							<div class="row">

                            	<div class="text-muted fst-italic col-lg-6 mb-2"><?php echo $post_date ?> </div>
	                            <div class="text-muted fst-italic col-lg-6 mb-2 text-center"><b>Author</b>
	                            <span class="badge bg-secondary text-decoration-none link-light "><?php echo $post_author ?></span>
	                            </div>
                         	</div>

							<!-- <div class="small text-muted fst-italic"><?php echo $post_date ?><span class="badge bg-secondary text-decoration-none link-light"><?php echo $post_author ?></span></div> -->

							<h2 class="card-title h4"><?php echo $post_tittle ?></h2>
							<p class="card-text"><?php echo $post_content ?></p>
							<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read more →</a>
						</div>
					</div>

				</div>



				<?php } } }else{

					header( "Location: index.php");
				}?>




			</div>
			<!-- Pagination-->
			<nav aria-label="Pagination">
				<hr class="my-0" />
				<ul class="pagination justify-content-center my-4">
					<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
					<li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
					<li class="page-item"><a class="page-link" href="#!">2</a></li>
					<li class="page-item"><a class="page-link" href="#!">3</a></li>
					<li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
					<li class="page-item"><a class="page-link" href="#!">15</a></li>
					<li class="page-item"><a class="page-link" href="#!">Older</a></li>
				</ul>
			</nav>
		</div>
		<!-- Side widgets-->


		<?php include "includes/side_widget.php" ?>




	</div>
</div>
<!-- Footer-->

<?php  include "includes/footer.php"?>
