<!doctype html>
<html lang="en">

<head>
    <title>E-census Login</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"">-->
    <link rel="stylesheet" href="stylesheet.css">
    <!--<link rel="stylesheet" href="css/custom.css">-->
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
    <div class="container">
        <section>
            <div class="row" style="margin-left: 0px;">
                <div class="col-sm-12 col-md-6 col-lg-12"
                    style="background-color: rgb(95, 143, 103);font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                    <h1>E-Census Sri Lanka</h1>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">

                    <img class="img-responsive" src="images/imgg.jpg" alt="E-Census" style="width: 555px;
						height: 586px;">
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6" style="background-color: rgb(179, 226, 185);">
                    <div class="row">
                        <p></p>
                        <p></p>
                    </div>

                    <div class="row">
                        <div class="card" style="margin-left:20px;">
                            <div class="loginBox" style="height: 566px;width: 524px;">
                                <p></p>
                                <img src="images/logooo.jpeg" class="img-responsive" alt="E-Census Sri Lanka"
                                    style="width: 50px; height: 50px; margin-left: 40%;" ;">
                                <h2 style="margin-left: 40%;">Login</h2>
								<p></p>
								<p></p>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-lg" name="username"
                                            placeholder="Username" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input type="password" class="form-control input-lg" name="password"
                                            placeholder="Password" required>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-success btn-block">Login</button>
                                </form>
                                <br>
                                <!-- Collapse a form when user click Lost your password? link-->
                                <p><a href="#showForm" data-toggle="collapse" aria-expanded="false"
                                        aria-controls="collapse"> Lost your password?</a></p>
                                <div class="collapse" id="showForm">
                                    <div class='well'>
                                        <form action="password-recovery.php" method="post">
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="Enter the email associated with the password."
                                                    required>
                                            </div>
                                            <button type="submit" class="btn btn-dark"> Recover Password</button>
                                        </form>
                                    </div>
                                </div>

                                <hr>
                                <p>New to E-Census? <a href="register.php" title="Create an account"> Create an
                                        account</a></p>
                            </div><!-- /.loginBox -->
                        </div><!-- /.card -->
                    </div><!--/row-->
                </div>
            </div><!-- /.col -->
        </section>

    </div><!-- /.container -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

</body>
</html>