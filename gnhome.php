<!doctype html>
<html lang="en">
  <head>
    <title>GramaNiladhari's Home</title>
	
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"">-->
    <link rel="stylesheet" href="stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    
    <link rel="stylesheet" href="css/custom.css">
   
  </head>

  <body>
		<div class="container-fluid" style="margin-right:-20px; margin-right:-10px">
			<section>
            <div style="background-image:url('images/bckedit.png'); height: 100vh; width:100% ; min-height:100vh; max-height:auto;">
				<div class="row">
					<div class="col-sm-7" style="background-color: rgb(95, 143, 103);font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                        <h1>E-Census Sri Lanka</h1>	
                    </div>  

                    <div class="col-sm-1" style="background-color: rgb(95, 143, 103);">
                        <i class="fa fa-bell" style="font-size:36px; margin-top:24px; float:right;"></i>
                        
                    </div>
                    <?php
                    
                    ?>
                    <div class="col-sm-3" style="background-color: rgb(95, 143, 103);">
                        <label style="margin-top:30px; float:right;"><h5> <?php session_start(); $userId=$_SESSION['userid'];
                    $username=$_SESSION['username']; echo $username ?></h5></label>
					</div>
                    <div class="col-sm-1" style="background-color: rgb(95, 143, 103);">
                        <i class='far fa-user-circle' style='font-size:36px; float: right;margin-top:30px;'><a href="logout.php">out</a></i>
					</div>
                </div>

                
                 
            

                <div class="row">

                    <div class="col-md-2"> 

                    </div>
                <div class="col-md-2 mt-3 card-container"  style="margin-left:-70px; margin-right:40px;">
                <a href="http://localhost/NewCensus/GNProfile.php"/>
                    <div class="card text-center product p-4 pt-5 border-0 rounded-0" style="background-color: #b6b64e;">
                     <img src="images/profile.png" style="width: 100px; height: 100px;">
                     
                     <div class="card-body p-4 py-0 h-xs-440p" style="font-size: large;">
                    <b>PROFILE</b>
                    </div>
                    </div>
                </div>


                <div class="col-md-2 mt-3 card-container" style="margin-right:80px;">
                <a href="http://localhost/NewCensus/GNApproval.php"/>
                    <div class="card text-center product p-4 pt-5 border-0  rounded-0" style="background-color: #b6b64e;">
                     <img src="images/download.png" style="width: 100px; height: 100px ;">
                     <div class="card-body p-4 py-0 h-xs-440p" style="font-size: large;">
                    <b>APPROVALS</b>
                     </div>
                    </div>
                </div>

                <div class="col-md-2 mt-3 card-container" style="margin-right:40px;">
                <a href="http://localhost/NewCensus/GNDownloads.php"/>
                    <div class="card text-center product p-4 pt-5 border-0 rounded-0" style="background-color: #b6b64e;">
                     <img src="images/the-business-report-icon-audit-and-analysis-vector-6522497.jpg" style="width: 100px; height: 100px;">
                     <div class="card-body p-4 py-0 h-xs-440p" style="font-size: large;">
                      <b>REPORT</b>
                     </div>
                    </div>
                </div>

                <div class="col-md-2 mt-3 card-container" style="margin-right:40px;">
                <a href="http://localhost/NewCensus/GNDataTable.php"/>
                    <div class="card text-center product p-4 pt-5 border-0 rounded-0" style="background-color: #b6b64e;">
                     <img src="images/data_table.png" style="width: 100px; height: 100px;">
                     <div class="card-body p-4 py-0 h-xs-440p" style="font-size: large;">
                      <b>RAW DATA</b>
                     </div>
                    </div>
                </div>

                <div class="col-md-2">
                        
                </div>
                </div>

        
            </div>
                

            </section>
        </div>

<?php
$userId=$_SESSION['userid'];
$username=$_SESSION['username']
?>

    </body>
    </html>
