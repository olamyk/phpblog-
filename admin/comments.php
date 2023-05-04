<?php include "includes/header.php"; ?>

<div id="wrapper">

	<!-- Navigation -->


	<?php include "includes/nav.php"; ?>




	<div id="page-wrapper">

		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<?php include "includes/welcome_author.php"; ?>

					<?php 
					
						if(isset($_GET['source'])){
							
							$source = $_GET['source'];
						}else{
							$source = '';
						}
					
						switch($source){
							case 'add_post':
								include "includes/add_post.php";
								break;
							case 'edit_post':
								include "includes/edit_post.php";
								break;
							case '37':
								echo "we get 37";
								break;
								
							default:
								include "includes/view_all_comments.php";
								break;
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
