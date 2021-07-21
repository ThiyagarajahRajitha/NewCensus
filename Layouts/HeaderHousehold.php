<!doctype html>
<html lang="en">

<head>
<title>Homepage</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="CSS/externalcss.css">
</head>

<body style="background-image:url('images/bckedit.png');height: 100vh; width:100% ; background-size: cover;">

<section>
<?php
require_once "config.php";
session_start();
?>
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
</body>
</div>