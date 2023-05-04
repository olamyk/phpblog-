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
                            
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <div class='huge'><?php echo $select_all_post = recordCount('posts'); ?></div>
                              		
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                     <div class='huge'><?php echo $count_comments = recordCount('comments'); ?></div>

                                  <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                		 <div class='huge'><?php echo $count_users = recordCount('Users'); ?></div>
                                	
                               
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                         <div class='huge'><?php echo $count_categories = recordCount('categories'); ?></div>

                                     <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="category.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
                            <!-- /.row -->
            <div class="row">

            	<?php 


                    

                    $count_all_published_posts = checkStatus('posts', 'post_status', 'published');




            		$count_all_draft_posts = checkStatus('posts', 'post_status', 'draft');

            		


            		$count_unapproved_comments = checkStatus('posts', 'post_status', 'unapproved');

            	


            		$count_sub_users = checkStatus('users', 'user_role', 'subscriber');
               
                                	



                ?>
            	

               <script type="text/javascript">
                  google.charts.load('current', {'packages':['bar']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                      ['Data', 'Count'],

                      <?php 

                      	$element_text = ['Posts','Active Posts','Draft Post','Comments','Unapproved Comments','Users', 'Subscribers','Categories'];

                      	$element_count = [$count_post, $count_all_published_posts, $count_all_draft_posts, $count_comments, $count_unapproved_comments, $count_users, $count_sub_users,$count_categories];

                      	$element_counts = [$count_post,$count_comments,];



                      	for ($i = 0; $i < 8; $i++) {
                      		
                      		echo "['{$element_text[$i]}'" . "," . " {$element_count[$i]}],";
                      	}



                       ?>

                      // ['2014', 1000],
                      
                    ]);

                    var options = {
                      chart: {
                        title: 'Chipher Blog Performance',
                        subtitle: 'Users, Posts, and  Comments, :',
                      }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                  }
                </script>


                 <div id="columnchart_material" style="width: 'auto'; height: 400px;"></div>

            </div>



		</div>
		<!-- /.container-fluid -->





	</div>
	<!-- /#page-wrapper -->

</div>

	<?php include "includes/footer.php"; ?>
