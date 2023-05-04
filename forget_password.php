<?php use PHPMailer\PHPMailer\PHPMailer; ?>

<?php include "includes/header.php"; ?>





<?php 

    require "./vendor/Autoload.php";
    require "./classes/config.php";





    if (!ifIsMethod('get') && !isset($_GET['forget'])) {

        redirect('/blog');
    }


    if (ifIsMethod('post')) {

        if ($_POST['email']) {

            $email = $_POST['email'];

            $length = 50;

            $token = bin2hex(openssl_random_pseudo_bytes($length));


            if (email_exists($email)) {

               if ($stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' WHERE user_email= ?")) {

                   mysqli_stmt_bind_param($stmt, "s", $email);
                   mysqli_stmt_execute($stmt);
                   mysqli_stmt_close($stmt);


                   
                   /* 
                    * 
                    * Configure PHPMailer
                    * 
                    */


                    $mail = new PHPMailer(true);


                    $mail->SMTPOptions = array(

                        'ssl' => array(
                        'verify_per' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true,
                        )
                    );

                  
                        $mail->SMTPDebug = 2;                  
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = Config::SMTP_HOST;                     
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = Config::SMTP_USER;                     
                        $mail->Password   = Config::SMTP_PASSWORD;                   //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = Config::SMTP_PORT;
                        $mail->isHTML(true);


                        //Recipients
                        $mail->setFrom('saadolamilekan71@gmail.com', 'Adejimmy');
                        $mail->addAddress($email);   
                        $mail->Subject = "This is a test Email";           
                        $mail->Body  = "test Body";
                       

                        if(!$mail->send()){
                            echo 'Your message could not be develired, try again later ';

                            echo 'Error: ' . $mail->ErrorInfo;
                            

                        } else {
                            
                            echo 'Your message has been sent successfully.';
                        }

                    }

               }


        }
    }



?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


              


                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">

                                    </form>
                                </div><!-- Body-->

                         


                                <h2>Please check your email</h2>


                 


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


   

</div> <!-- /.container --> <hr>

    <?php include "includes/footer.php";?>