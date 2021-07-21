<!doctype html>
<html lang="en">

<head>
    <title>E-census Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1.0 shrink-to-fit=yes">
    <?php
    require_once "Layouts/Header.php";
    ?>
    <link rel="stylesheet" href="CSS/stylesheet.css">


</head>

<body>
    <?php
require_once "config.php";

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql="SELECT userId,username,Role,GramaNiladhariId FROM user WHERE username='$username' AND password='$password'";
	
	if($result=mysqli_query($link,$sql)){
        if(mysqli_num_rows($result) >0){
			$row=mysqli_fetch_assoc($result);
			$userId=$row['userId'];
			$userName=$row['username'];
			$usertype=$row['Role'];
            $gnId=$row['GramaNiladhariId'];

	        $_SESSION['userid'] = $userId;
	        $_SESSION['username'] = $userName;
	        $_SESSION['Role']=$usertype;
            $_SESSION['GramaNiladhariId']=$gnId;
	 
	 			
			if($usertype=='Admin') {
			    header("Location:admin.php");
				}
			elseif($usertype=='GramaNiladhari') {	
			header("Location:gnhome.php");
			}
            else{
                header("Location:hhhomeinterface.php");
			   //echo "Welcome ".$userId;
				//echo "<br>";
				//echo $usertype;
            }
			exit();
		}
		
		else{
			echo "ERROR in login";
			}

		mysqli_close($link);
	}
}
?>
    <div class="container-fluid p-0">
        <section>
            <div class="row no-gutters">
                <div class="col-sm-12 col-lg-6">
                    <img class="img" src="images/imgg.jpg" alt="E-Census">
                </div>

                <div class="col-sm-12 col-md-6" style="background-color: rgba(191, 192, 113, 0.986);">
<div class="indexcard">
                    <div class="card">
                        <!--<div class="loginBox">-->

                        <!--<img src="images/logooo.jpeg" class="img-responsive" alt="E-Census Sri Lanka"
                            style="width: 50px; height: 50px; margin-left: 40%;" ;>
                        <h2 style="margin-left: 40%;">Login</h2>
                        <p></p>
                        <p></p>-->

                        <i class="fas fa-5x fa-users"></i>
                        <h4 class="welcome">Already have an account?</h4>

                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="form-group">

                                <div class="col-10">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-2x fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" name=" username"
                                            placeholder="Username" required>
                                    </div>
                                </div>
</div>  
                                <!--   <i class="fas fa-user"></i><input type="text" class="form-control" name="username" placeholder="Username"
                                    required>-->


                                <div class="form-group">
                                    <div class="col-10">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-2x fa-lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control input-lg" name="password"
                                                placeholder="Password" required>
                                        </div>
                                    </div>
</div>    

                                    <button type="submit" class="btn btn-success btn-block float-right">Login</button>
                        </form>
                    
                        <!-- Collapse a form when user click Lost your password? link-->
                        <p><a href="#showForm" data-toggle="collapse" aria-expanded="false" aria-controls="collapse">
                                Lost your password?</a></p>
                        <div class="collapse" id="showForm">
                            <div class='well'>
                                <form action="password-recovery.php" method="post">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Enter the email associated with the password." required>
                                    </div>
                                    <button type="submit" class="btn btn-dark"> Recover Password</button>
                                </form>
                            </div>
                        </div>

                        <hr>
                        <p>New to E-Census? <a href="registerinterface.php" title="Create an account"> Create an
                                account</a></p>
                        <!-- /.loginBox -->
                    </div><!-- /.card -->
</div>
                </div>
            </div>
    </div><!-- /.col -->
    </section>
    <section>
        <?php
        require_once "Layouts/Footer.php";
        ?>
    </section>
</body>

</html>