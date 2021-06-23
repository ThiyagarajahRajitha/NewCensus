<?php
require "config.php";
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

if (isset($_POST['search'])) {
    $gender = $_POST['gender'];
    $employmenttype = $_POST['employmenttype'];
    $amountfrom = $_POST['amountfrom'];
    $amountto = $_POST['amountto'];
    $dobfrom = $_POST['dobfrom'];
    $dobto = $_POST['dobto'];


  
    $where = " WHERE h.gramaNiladhariId='$gnId' AND (h.statusId=0 OR h.statusId=1 OR h.statusId=4 OR h.statusId=9)";
    //echo $where;
    if (!empty($gender)) {
        $where .= "AND h.genderId='$gender'";
        //echo $where;
    }
    if (!empty($employmenttype)) {
        //for any other filter
        $where .= "AND h.employementTypeId='$employmenttype'";
    }
    if (!empty($amountfrom)) {
        //for any other filter
        $where .= "AND h.income>'$amountfrom'";
    }
    if (!empty($amountto)) {
        //for any other filter
        $where .= "AND h.income<'$amountto'";
    }
    if (!empty($dobfrom)) {
        //for any other filter
        $where .= "AND h.DOB>'$dobfrom'";
    }
    if (!empty($dobto)) {
        //for any other filter
        $where .= "AND h.DOB<'$dobto'";
    }


   //if (!empty($employmenttype)) {
    //for any other filter
    /*$qertyshow = "SELECT h.householdMemberId,h.genderId, g.gender, COUNT(h.householdMemberId) AS gender_count 
    FROM ((householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
    INNER JOIN status AS s ON s.statusId=h.statusId) WHERE h.gramaNiladhariId='$gnId' 
    AND (h.statusId=0 OR h.statusId=1 OR h.statusId=4 OR h.statusId=9) 
    AND h.employementTypeId='$employmenttype' GROUP BY h.genderId";
  //}
  */
  echo "filter query";
  $qertyshow = "SELECT h.genderId, g.gender, COUNT(h.householdMemberId) AS gender_count 
  FROM ((householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
  INNER JOIN status AS s ON s.statusId=h.statusId)
  $where GROUP BY h.genderId";
  /*"SELECT h.memberFirstName, h.memberLastName, h.NIC, h.DOB,h.genderId, g.gender,
 h.Relationship, e.employmentType, h.employementTypeId,h.employementDescription, h.income, h.statusId,s.status,
 h.userId, h.gramaNiladhariId FROM (((householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
    INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId) INNER JOIN status AS s
    ON s.statusId=h.statusId) $where GROUP BY h.genderId"
    */
    echo $qertyshow;
}
else {
  echo "pageloaf";
$qertyshow = "SELECT h.genderId, g.gender, COUNT(h.householdMemberId) AS gender_count 
FROM ((householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
INNER JOIN status AS s ON s.statusId=h.statusId) WHERE h.gramaNiladhariId='$gnId' 
AND (h.statusId=0 OR h.statusId=1 OR h.statusId=4 OR h.statusId=9) 
GROUP BY h.genderId ";
    //"AND (h.statusId=0 OR h.statusId=2 OR h.statusId=5 OR h.statusId=8)'";
  
}
$result = mysqli_query($link, $qertyshow);  


?>

<!doctype html>
<html>

<head>
    <title>GramaNiladhari Home</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
        integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"">

    <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="main.js"></script>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Gender', 'Count'],

            <?php
          if (mysqli_num_rows($result) > 0) {
              while($row=mysqli_fetch_array($result)){
                  echo "['".$row["gender"]."', ".$row["gender_count"]."],";
              }
            }

          ?>

        ]);

        var options = {
            title: 'Gender',
            pieHole: 0.4,
            backgroundColor: 'transparent',
            is3D: true,
            slices: {
                0: {
                    color: 'orange'
                },
                1: {
                    color: 'green'
                }
            },
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }

    
    </script>
</head>

<body>
    <div class="container-fluid">
        <section>
            <div class="row">
                <div class="col-sm-7"
                    style="background-color: rgb(95, 143, 103);font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                    <h1>E-Census Sri Lanka</h1>
                </div>

                <div class="col-sm-1" style="background-color: rgb(95, 143, 103);">
                    <i class="fa fa-bell" style="font-size:36px; margin-top:24px; float:right;"><a
                            href="logout.php">out</a></i>
                </div>
                <?php
?>
                <div class="col-sm-3" style="background-color: rgb(95, 143, 103);">
                    <label style="margin-top:30px; float:right;">
                        <h5> <?php 
$userId = $_SESSION['userid'];
$username = $_SESSION['username'];
echo $username?></h5>
                    </label>
                </div>
                <div class="col-sm-1" style="background-color: rgb(95, 143, 103);">
                    <i class='far fa-user-circle' style='font-size:36px; float: right;margin-top:30px;'></i>
                </div>
            </div>
        </section>

        <div style="background-image:url('images/bckedit.png'); height: 610px; width:1560px;">
            <br>

        <form id="form1" action="" method="post">
          <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-4">
                    <lable> Gender: </lable>
                    <select name="gender" id="gender">
                        <option value=""> ---Select--- </option>

                        <?php

require "config.php";

$dd_res = mysqli_query($link, "Select * from gender ORDER BY genderId");
while ($row = mysqli_fetch_array($dd_res)) {

    $genderId = $row[0];
    $gender_name = $row[1];
    echo "<option value='$genderId'> $gender_name </option>";
}

?>

                    </select>
                </div>

<div class="col-5m-12 col-md-8 col-lg-6">
                    <lable> Income:  From: </lable>
                    <input type="text" name="amountfrom" id="amountfrom">

                    <lable> To: &nbsp; </lable>
                    <input type="text" name="amountto" id="amountto">
                </div>
</div>
<div class="row"><br></div>

<div class="row">
            <div class="col-5m-12 col-md-6 col-lg-4">
                <lable> Employment Type: </lable>
                <select name="employmenttype" id="employmenttype">
                    <option value=""> ---Select--- </option>

                    <?php

require "config.php";

$dd_res = mysqli_query($link, "Select * from employmenttype ORDER BY employmentTypeid");
while ($row = mysqli_fetch_array($dd_res)) {

    $employmenttypeId = $row[0];
    $employmenttype_name = $row[1];
    echo "<option value='$employmenttypeId'> $employmenttype_name </option>";
}
?>
                </select>
            </div>



                <div class="col-5m-12 col-md-6 col-lg-6">
                    <lable> Date of Birth From: </lable>
                    <input type="date" name="dobfrom" id="dobfrom">
                    <lable> To: </lable>
                    <input type="date" name="dobto" id="dobto">
                </div>
                <br>
</div>
            <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                <input type="submit" name="search" value="Search">
            </div>
   
        </form>

        <div style="background-image:url('images/bckedit.png'); height: 610px; width:1560px;">

            <div id="donutchart" style="width: 50%; height:50vh;"></div>
</body>

</html>