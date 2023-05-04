<?php include "includes/header.php"; ?>
<!-- Responsive navbar-->
<?php include "includes/navbar.php"; ?>

<!-- Page header with logo and tagline-->
<!-- <header class="py-5 bg-light border-bottom mb-4">
	<div class="container">
		<div class="text-center my-5">
			<h1 class="fw-bolder">Welcome to Blog Home!</h1>
			<p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
		</div>
	</div>
</header> -->
<!-- Page content-->
<div class="container">
	<div class="row">
		<!-- Blog entries-->
		<div class="col-lg-8">
			<!-- Featured blog post-->
			<!--
			<div class="card mb-4">
				<a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a>
				<div class="card-body">
					<div class="small text-muted">January 1, 2022</div>
					<h2 class="card-title">Featured Post Title</h2>
					<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
					<a class="btn btn-primary" href="#!">Read more →</a>
				</div>
			</div>
-->
			<!-- Nested row for non-featured blog posts-->
			<div class="row">

				<?php 
				
		
			if(isset($_POST['submit'])){
				
				$search = $_POST['search'];
				
				
				$query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
				
				$search_query = mysqli_query($connection, $query);
				
				if(!$search_query){
					
					die("QUERY FAILED" . mysqli_error($connection));
				}
				
				$count = mysqli_num_rows($search_query);
				if($count == 0){
					
					echo "<h1>No Result</h1>";
				}else{
			
				while($row = mysqli_fetch_assoc($search_query)){
					$post_id = $row['post_id'];
					$post_image = $row['post_image'];
					$post_date = $row['post_date'];
					$post_tittle = $row['post_tittle'];
					$post_content = substr($row['post_content'], 0, 110);
					
					?>
				<div class="col-lg-6">
					<!-- Blog post-->
					<div class="card mb-4">
						<a href="#!"><img class="card-img-top" src="images/<?php echo $post_image; ?>" alt="..." /></a>
						<div class="card-body">
							<div class="small text-muted"><?php echo $post_date ?></div>
							<h2 class="card-title h4"><?php echo $post_tittle ?></h2>
							<p class="card-text"><?php echo $post_content ?></p>
							<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read more →</a>
						</div>
					</div>

				</div>
				<?php

		}
		}


		 } 
	?>




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


		<?php include "includes/side_widget.php"; ?>




	</div>
</div>
<!-- Footer-->

<?php include "includes/footer.php"; ?>
