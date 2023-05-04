<?php include "includes/header.php"; ?>

<!-- Responsive navbar-->
<?php include "includes/navbar.php"; ?>
        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">


                <?php 
                
                if(isset($_GET['p_id'])){

                    $each_post_id  = $_GET['p_id'];
                    $the_post_author = $_GET['author'];
                }


                    $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' ";
                    $select_all_from_post = mysqli_query($connection, $query);

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

                    <?php } ?>



                    <?php 

                        if (isset($_POST['create_comment'])) {
                            
                            $each_post_id  = $_GET['p_id'];
                           
                            $comment_author = $_POST['comment_author'];
                            $comment_email = $_POST['comment_email'];
                            

                            if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                                

                                $query ="INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                                $query .= "VALUES($each_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapprove', now())";

                                $comment_query = mysqli_query($connection, $query);

                                if (!$comment_query) {

                                    die("QUERY FAILED" . mysqli_error($connection));
                                }


                                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                                $query .= "WHERE post_id = $each_post_id";

                                $count_each_post_comment = mysqli_query($connection, $query);
                            
                            }else{


                                echo "<script>alert('FEILD CANNOT BE EMPTY')</script>";
                            }

                            
                           

                            

                        }

                    ?>


       

                </div>

                
                     <?php include "includes/side_widget.php" ?>
                    


