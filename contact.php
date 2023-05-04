<?php include "includes/header.php"; ?>

<!-- Responsive navbar-->
<?php include "includes/navbar.php"; ?>


<?php 

if (isset($_POST['submit'])) {


    $to         = "saadolamilekan71@gmail.com";
    $subject    = wordwrap($_POST['subject'], 70);
    $body       = $_POST['body'];
    $header     = $_POST['email'];

mail($to, $subject, $body, $header);

}


?>



<!-- Page content-->
<section id="login">
    <div class="container">
        <div class="row">
            <div class=" col-xs-6  col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                       

                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Your Email..." autocomplete="on">

                             <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
              
                        </div>
                        <div class="form-group">
                            <label for="email" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Your Subject" autocomplete="on">

                             <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
              
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Your Thought...</label>
                            <textarea class="form-control" name="body" id="body" rows="7" cols="30"></textarea>

                            <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>


                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-primary btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>






<!-- Footer-->

<?php  include "includes/footer.php"?>






