<!doctype html>
<html lang="en">
  <head>
    <title>Create an account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		 --><?php
    require_once "Layouts/Header.php";
    ?>
    <link rel="stylesheet" href="CSS/stylesheet.css">
		<script src="main.js"></script>
  </head>

  <body>
<?php
require_once "config.php";
?>

  <div class="container-fluid p-0">
        <section>
            <div class="row no-gutters">
                <div class="col-sm-12 col-lg-6">
                    <img class="img" src="images/imgg.jpg" alt="E-Census">
                </div>

                <!--<div class="col-sm-12 col-md-6" style="background-color: rgba(191, 192, 113, 0.986);">-->


		<div class="col-sm-12 col-md-6 col-lg-6" style="background-color: rgb(179, 226, 185);">

		<h3>Create an account</h3><hr/>

		<form id="registration" action="register.php" method="POST">
			<div class="form-group">
				<select name="usertype" id="usertype" onchange="usertypeonChange(this.value)">
					<option id= 'gn' value="GramaNiladhari">Grama Niladhari</option>
					<option id='hh' value="HouseholdHead">Household Head</option>
				</select>
		    </div>

			<div id="gnregisterform">
			<div class="form-group">
            <select name="province" id="province" onchange="provinceonChange(this.value)">
            	<option value=""> ---Select Your Province--- </option>
<?php
$dd_res = mysqli_query($link, "Select * from province ORDER BY provinceId");
while ($row = mysqli_fetch_array($dd_res)) {
    $provinceid = $row[0];
    $province_name = $row[1];
    echo "<option value='$provinceid'> $province_name </option>";
}
?></select>
			</div>

			<div class="form-group">
				<select name="district" id="district" onchange="districtOnChange(this.value)">
                <option value="">---Select Your District---</option>
				</select>
			</div>

			<div class="form-group">
				<select name="dsdivision" id="dsdivision" onchange="DivSecOnChange(this.value)">
					<option value="">---Select Your DS Division---</option>
				</select>
			</div>

			<div class="form-group">
				<select name="gndivision" id="gndivision" onchange="gnOnChange(this.value)">
					<option value="">---Select Your GN Division---</option>
				</select>
			</div>

		  <!--<div class="form-group">
				<input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter your email">
			</div>-->

			<div class="form-group">
				<input type="text" class="form-control" name="gnusername" id="gnusername" placeholder="Username" readonly="readonly">
		  </div>

		  <div class="form-group">
				<input type="password" class="form-control" name="gnpassword" placeholder="Password" >
			</div>

			<div class="form-group">
				<input type="password" class="form-control" name="gnconfirmpassword" placeholder="Confirm Password" >
			</div>

		  <button type="submit" class="btn btn-success btn-block btn-lg" name= "gnregister">Register</button>

		</div>

		<div id="hhregisterform" style="display: none;">
		<!--<div class="form-group">
			<input type="text" class="form-control" name="Name" placeholder="Enter your name" >
	  </div>-->

	  <div class="form-group">
		<input type="text" class="form-control" id="nic" name="nic" onkeyup="nicOnkeypress()" maxlength="10" placeholder="Enter your NIC number" >
 		 </div>

  		<div class="form-group">
		<input type="text" class="form-control" id="hhusername" name="hhusername" placeholder="Username" disabled>
		</div>
	  <div class="form-group">
			<input type="password" class="form-control" name="hhpassword" placeholder="Password" >
		</div>

		<div class="form-group">
			<input type="password" class="form-control" name="hhconfirmpassword" placeholder="Confirm Password" >
		</div>

	  <button type="submit" class="btn btn-success btn-block btn-lg" name="hhregister">Register</button>
		</div>


	<div >
		<p style="text-align: center;">Already have an account? <a href="http://localhost/NewCensus/index.php" title="Login Here">Login here!</a></p>
	</div>
</div>

</section>

		</form>
		</div>

	</div>
</div>

<section>
        <?php
        require_once "Layouts/Footer.php";
        ?>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" type="text/javascript"></script>
-->
	</body>
</html>