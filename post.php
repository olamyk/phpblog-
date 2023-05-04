<?php include "includes/header.php"; ?>


<!-- Responsive navbar-->
<?php include "includes/navbar.php"; ?>
        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">


                    <?php 

                        if (isset($_POST['create_comment'])) {
                            
                            $each_post_id  = $_GET['p_id'];
                           
                            $comment_author = $_POST['comment_author'];
                            $comment_email = $_POST['comment_email'];
                            $comment_content = $_POST['comment_content'];

                            if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                                

                                $query ="INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                                $query .= "VALUES($each_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapprove', now())";

                                $comment_query = mysqli_query($connection, $query);

                                if (!$comment_query) {

                                    die("QUERY FAILED" . mysqli_error($connection));
                                }


                                // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                                // $query .= "WHERE post_id = $each_post_id";

                                // $count_each_post_comment = mysqli_query($connection, $query);
                            
                            }else{


                                echo "<script>alert('FEILD CANNOT BE EMPTY')</script>";
                            }

                           

                        }

                    ?>



                <?php 
                
                if(isset($_GET['p_id'])){

                    $each_post_id  = $_GET['p_id'];

                    $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$each_post_id} ";
                    mysqli_query($connection,$query);
                

                    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {
                        
                        $query = "SELECT * FROM posts WHERE post_id = $each_post_id ";

                    }else{

                        $query = "SELECT * FROM posts WHERE post_id = $each_post_id AND post_status= 'published' ";

                    }

                    
                    $select_all_from_post = mysqli_query($connection, $query);

                        if (mysqli_num_rows($select_all_from_post) < 1) {
                            
                            echo "<h1 class='text-center'>No Posts Available!</h1>";
                        }else{ 

                    while($row = mysqli_fetch_assoc($select_all_from_post)){
                        
                        $post_image = $row['post_image'];
                        $post_date = $row['post_date'];
                        $post_tittle = $row['post_tittle'];
                        $post_content = $row['post_content'];
                        $post_author = $row['post_author'];
                    
                ?>


                            <div class="col-lg-8">
                                <!-- Post content-->
                                <article>
                                    <!-- Post header-->
                                    <header class="mb-4">
                                        <!-- Post title-->

                                        <h1 class="fw-bolder mb-1"><?php echo $post_tittle ?></h1>
                                        <!-- Post meta content-->
                                       
                                        <!-- Post categories-->
                                        
                                        <a class="badge bg-secondary text-decoration-none link-light" href="#!">Freebies</a>
                                    </header>
                                    <!-- Preview image figure-->

                                    <figure class="mb-4"><img class="img-fluid rounded" src="images/<?php echo $post_image; ?>" alt="..." /></figure>

                                    <div class="row">

                                        <div class="text-muted fst-italic col-lg-6 mb-2"><?php echo $post_date ?> </div>
                                        <div class="text-muted fst-italic col-lg-6 mb-2 text-center"><b>Author</b>
                                        <span class="badge bg-secondary text-decoration-none link-light "><?php echo $post_author ?></span>
                                        </div>
                                    </div>
                                     

                                    <!-- Post content-->
                                    <section class="mb-5">
                                        <p class="fs-5 mb-4"><?php echo $post_content ?></p>
                                    </section>
                                </article>


                            <?php }  } }?>




                                <!-- Comments section-->
                                <section class="mb-5">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <!-- Comment form-->
                                            <form class="mb-4 form-group" action="" method="post">
                                                <div class="mb-4 form-group">
                                                    <input class="form-control" type="text" name="comment_author" placeholder="Your Name!">
                                                </div>
                                                <div class="mb-4 form-group">
                                                    <input class="form-control" type="text" name="comment_email" placeholder="Enter Email!">
                                                </div>
                                                <textarea class="form-control" name ="comment_content" rows="4" placeholder="Join the discussion and leave a comment!"></textarea>
                                                <div class="mb-4 mt-2 form-group">
                                                    <input type="submit" class="btn btn-primary" value="Submit" name="create_comment">
                                                </div>
                                                
                                            </form>
                                            <!-- Comment with nested comments-->





                                            </div>

                                        </div>
                                </section>



                                        <?php 

                                            $query = "SELECT * FROM comments WHERE comment_post_id = $each_post_id ";
                                            $query .="AND comment_status = 'approved' ORDER BY comment_id DESC ";

                                            $display_comment = mysqli_query($connection, $query);

                                            while ($row = mysqli_fetch_assoc($display_comment)) {
                                                
                                                $comment_author = $row['comment_author'];
                                                $comment_date = $row['comment_date'];
                                                $comment_content = $row['comment_content'];


                                            ?>


                                                    <!-- Single comment -->
                                            <div class="d-flex">
                                                <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>

                                                <div class="ms-3 mb-3">
                                                    <div class="fw-bold"><?php echo $comment_author; ?>&nbsp;&nbsp;<span class="text-muted fst-italic"><?php echo $comment_date; ?></span></div>
                                                    <span><?php echo $comment_content; ?></span>
                                                </div>
                                            </div>

                                                <?php } ?>
                                              
           
                                    </div>

                                           <?php include "includes/side_widget.php" ?>

                                            


       

                </div>
            </div>

                
                    
                    


