<?php include "includes/header.php"; ?>

<div id="wrapper">

	<!-- Navigation -->


	<?php include "includes/nav.php"; ?>


	<?php  ?>

	<div id="page-wrapper">

		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">
						Welcome To Admin
						<small>Author</small>
					</h1>
					<ol class="breadcrumb">
						<li>
							<i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
						</li>

					</ol>


					<div class="col-xs-6">

						<?php Create_category(); ?>

						<form action="" method="post">

							<div class="form-group">
								<label for="cat-tittle">Add Category</label>
								<input type="text" class="form-control" name="cat_tittle">
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary" name="submit" value="Add Category">
							</div>

						</form>



						<form action="" method="post">

							<div class="form-group">
								<label for="cat-tittle">Edit Category</label>

								<?php
									
								if(isset($_GET['edit'])){

								$cat_id = $_GET['edit'];
									
									Update_category();
								}
									?>


							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary" name="update" value="Update Category">
							</div>

						</form>

					</div>

					<div class="col-xs-6">
						<table class="table table-bordered table-hover">

							<thead>

								<tr>
									<th>Id</th>
									<th>Category</th>
								</tr>

							</thead>
							<tbody>

								<?php CategoryTable(); ?>

							</tbody>

						</table>

					</div>
				</div>



			</div>
			<!-- /.row -->

		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- /#page-wrapper -->

	<?php include "includes/footer.php"; ?>
