<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="CSS/externalcss.css">

</head>

<body style="background-image:url('images/bckedit.png'); height: 135vh;  width:100% ; background-size: cover;">

        

<section>
    <div class="navbar navbar-expand-lg">
        <div class="container-fluid p-0 nav-container">
            <h1><i class="fas fa-1x fa-laptop-house"></i> E-Census Sri Lanka</h1>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav ml-auto">
                    <li>
                        <a href="GNApproval.php"><i class="fa fa-bell"></i>
                        <sup><div id="circle">
                        
                            <?php
//have to check whether this can write in separate file>
require_once "config.php";
session_start();
$userId = $_SESSION['userid'];
$username = $_SESSION['username'];
$gn = "SELECT GramaNiladhariId FROM user WHERE userId=$userId";
if ($result_gnId = mysqli_query($link, $gn)) {
    if (mysqli_num_rows($result_gnId) > 0) {
        $res = mysqli_fetch_array($result_gnId);
        $gnId = $res['GramaNiladhariId'];
    }
}

$qertyshow = "SELECT count(h.householdMemberId) AS countt FROM householdmember AS h
INNER JOIN status AS s ON s.statusId=h.statusId WHERE h.gramaNiladhariId=16
AND (h.statusId=1 OR h.statusId=4 OR h.statusId=7)";

if ($result_history = mysqli_query($link, $qertyshow)) {
    if (mysqli_num_rows($result_history) > 0) {
        while ($hcount = mysqli_fetch_array($result_history)) {
            echo $hcount['countt'];
        }
    }
}
?>
               </div></sup></a>
                    </li>
                    <li>
                        <label style="margin-top:30px;">
                            <h5> <?php $userId = $_SESSION['userid'];
$username = $_SESSION['username'];
echo $username?>&nbsp&nbsp&nbsp&nbsp;</h5>
                        </label>
                        <a href="logout.php" style="color:white;"><i class="fas fa-sign-out-alt"
                                style='font-size:36px; float: right;margin-top:30px;'></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>