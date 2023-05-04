<?php include "includes/header.php"; ?>

<!-- Responsive navbar-->
<?php include "includes/navbar.php"; ?>





<?php 

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);



    $error = [

        'username' => '',
        'email'    => '',
        'password' => ''

    ];


    if (strlen($username) < 4) {

        $error['username'] = "the lenght of user name is short";
    }

    if ($username == "") {

        $error['username'] = "username can not be empty";
    }

    if (username_exists($username) > 0) {

        $error['username'] = "the name you enter '{$username}' is exist";
    }



    if ($email == "") {

        $error['email'] = "your email is required";
    }

    if (email_exists($email) > 0) {

        $error['email'] = "the email you entered already exist <a href='index.php'>please login</a>";
    }


    if ($password == "") {

        $error['password'] = "your password cannot be empty";
    }






    foreach ($error as $key => $value) {


        if (empty($value)) {

            unset($error[$key]);
        }
    }

    if (empty($error)) {

        register_user($username, $email, $password);

        login_user($username, $password);
    }
    

}



?>



<!-- Page content-->



<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
             
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username"

                            autocomplete="on" value="<?php echo isset($username) ? $username : ''?>" >

                            <p class="text-danger"><?php echo isset($error['username']) ? $error['username'] : '' ?></p>

                       
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>">

                             <p class="text-danger"><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
              
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">

                            <p class="text-danger"><?php echo isset($error['password']) ? $error['password'] : '' ?></p>


                        </div>
                
                        <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-primary btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>






<!-- Footer-->

<?php  include "includes/footer.php"?>






