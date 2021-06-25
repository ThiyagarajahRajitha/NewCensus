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

    echo "filter query";
    $qertyshow = "SELECT h.genderId, g.gender, COUNT(h.householdMemberId) AS gender_count
  FROM ((householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
  INNER JOIN status AS s ON s.statusId=h.statusId)
  $where GROUP BY h.genderId";

    $qertyshow2 = "SELECT h.employementTypeId, e.employmentType, COUNT(h.employementTypeId) AS employementType_count
FROM ((householdmember AS h INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId)
INNER JOIN status AS s ON s.statusId=h.statusId)
$where GROUP BY h.employementTypeid";
    //echo $qertyshow2;

    $qertyshow3 = "SELECT h.householdMemberId AS 'eid', TIMESTAMPDIFF(YEAR, h.DOB, CURDATE()) AS 'age'
FROM ((householdmember AS h INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId)
INNER JOIN status AS s ON s.statusId=h.statusId) $where";

    $qertyshow4 = "SELECT h.householdMemberId AS 'eid', h.income as 'income'
FROM ((householdmember AS h INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId)
INNER JOIN status AS s ON s.statusId=h.statusId) $where";
} else {
    //echo "pageloaf";

    $qertyshow = "SELECT h.genderId, g.gender, COUNT(h.householdMemberId) AS gender_count
FROM ((householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
INNER JOIN status AS s ON s.statusId=h.statusId) WHERE h.gramaNiladhariId='$gnId'
AND (h.statusId=0 OR h.statusId=1 OR h.statusId=4 OR h.statusId=9)
GROUP BY h.genderId ";
    //"AND (h.statusId=0 OR h.statusId=2 OR h.statusId=5 OR h.statusId=8)'";

    $qertyshow2 = "SELECT h.employementTypeId, e.employmentType, COUNT(h.employementTypeId) AS employementType_count
FROM ((householdmember AS h INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId)
INNER JOIN status AS s ON s.statusId=h.statusId) WHERE h.gramaNiladhariId='$gnId'
AND (h.statusId=0 OR h.statusId=1 OR h.statusId=4 OR h.statusId=9)
GROUP BY h.employementTypeid";

    $qertyshow3age = "SELECT t.range as 'age', count(*) as 'countt' from
(select h.DOB, case
when TIMESTAMPDIFF(YEAR, h.DOB, CURDATE()) between 1 and 10 then ' 0 - 10'
when TIMESTAMPDIFF(YEAR, h.DOB, CURDATE()) between 11 and 20 then ' 11 - 20'
when TIMESTAMPDIFF(YEAR, h.DOB, CURDATE()) between 21 and 30 then ' 21 - 30'
when TIMESTAMPDIFF(YEAR, h.DOB, CURDATE()) between 31 and 40 then ' 31 - 40'
when TIMESTAMPDIFF(YEAR, h.DOB, CURDATE()) between 41 and 50 then ' 41 - 50'
when TIMESTAMPDIFF(YEAR, h.DOB, CURDATE()) between 51 and 60 then ' 51 - 60'
else 'Above 61' end as 'range' from householdmember h
INNER JOIN status AS s ON s.statusId=h.statusId
WHERE h.gramaNiladhariId=$gnId AND (h.statusId=0 OR h.statusId=1 OR h.statusId=4 OR h.statusId=9)) t
group by t.range";

    $qertyshow4 = "SELECT h.householdMemberId AS 'eid', h.income as 'income'
FROM ((householdmember AS h INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId)
INNER JOIN status AS s ON s.statusId=h.statusId) WHERE h.gramaNiladhariId='$gnId'
AND (h.statusId=0 OR h.statusId=1 OR h.statusId=4 OR h.statusId=9)";

}
$result = mysqli_query($link, $qertyshow);
$result2 = mysqli_query($link, $qertyshow2);
$result3age = mysqli_query($link, $qertyshow3age);
$result4 = mysqli_query($link, $qertyshow4);

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
    while ($row = mysqli_fetch_array($result)) {
        echo "['" . $row["gender"] . "', " . $row["gender_count"] . "],";
    }
}
?>
        ]);
        var options = {
            title: 'Gender',
            pieHole: 0.4,
            width: 600,
            height: 400,
            //backgroundColor: 'transparent',
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
    //employmenttype chart
    google.charts.load("current", {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
        var data = google.visualization.arrayToDataTable([
            ["EmploymentType", "Count", {
                role: "style"
            }],
            <?php
if (mysqli_num_rows($result2) > 0) {
    while ($row2 = mysqli_fetch_array($result2)) {
        echo "['" . $row2["employmentType"] . "', " . $row2["employementType_count"] . ",'orange'],";
    }
}
?>
        ]);
        var options = {
            title: 'Employment type',
            pieHole: 0.4,
            width: 600,
            height: 400,
            //backgroundColor: 'transparent',
            is3D: true,
            slices: {
                0: {
                    color: 'orange'
                },
                1: {
                    color: 'green'
                },
                2: {
                    color: 'yellow'
                },
                3: {
                    color: 'brown'
                }
            },
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
        chart.draw(data, options);
    }
    //age column chart
    google.charts.load("current", {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart3);

    function drawChart3() {
        var data = google.visualization.arrayToDataTable([
            ["Age", "Count", {
                role: "style"
            }],
            <?php
if (mysqli_num_rows($result3age) > 0) {
    while ($row3 = mysqli_fetch_array($result3age)) {
        echo "['" . $row3["age"] . "', " . $row3["countt"] . ",'orange'],";
    }
}
?>
        ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },
            2
        ]);
        var options = {
            title: "Age range",
            width: 600,
            height: 400,
            backgroundColor: {
                stroke: 'white'
            },
            backgroundColor: {
                strokeWidth: 2
            },
            backgroundColor: {
                color: '#82ce68'
            },
            bar: {
                groupWidth: "95%"
            },
            legend: {
                position: "none"
            },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(view, options);
    }
    //histogram
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart4);

    function drawChart4() {
        var data = google.visualization.arrayToDataTable([
            ['Income Range', 'Income'],
            <?php
if (mysqli_num_rows($result4) > 0) {
    while ($row4 = mysqli_fetch_array($result4)) {
        echo "['" . $row4['eid'] . "', " . $row4['income'] . "],";
    }
}
?>
        ]);
        var options = {
            title: 'Income Range',
            legend: {
                position: 'none'
            },
            width: 600,
            height: 400,
            colors: ['orange'],
        };
        var chart = new google.visualization.Histogram(document.getElementById('chart_div_income'));
        chart.draw(data, options);
    }
    </script>
</head>

<body>
    <div class="container-fluid">
        <section>
            <div class="row" style="background-color: rgb(95, 143, 103);">
                <div class="col-sm-8"
                    style="background-color: rgb(95, 143, 103);font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                    <h1>E-Census Sri Lanka</h1>
                </div>
                <div class="col-sm-1" style="background-color: rgb(95, 143, 103);">
                 <!--<i class="fa fa-bell" style="font-size:36px; margin-top:24px; float:right;"></i>-->
                 
                 <div><a class="fa fa-bell"  href="GNApproval.php" style='font-size:36px; float: right;margin-top:30px; color:black;'></a>
                 <div><a href="GNApproval.php" style='font-size:24px; float: right;margin-top:5px; color:yellow;'><?php
require_once "config.php";

$gn = "SELECT GramaNiladhariId FROM user WHERE userId=$userId";
if ($result_gnId = mysqli_query($link, $gn)) {
    if (mysqli_num_rows($result_gnId) > 0) {
        $res = mysqli_fetch_array($result_gnId);
        $gnId = $res['GramaNiladhariId'];
    }
}

$qertyshow = "SELECT count(h.householdMemberId) AS countt FROM householdmember AS h 
INNER JOIN status AS s ON s.statusId=h.statusId WHERE h.gramaNiladhariId=16 
AND (h.statusId=0 OR h.statusId=1 OR h.statusId=4 OR h.statusId=7)";

if ($result_history = mysqli_query($link, $qertyshow)) {
    if (mysqli_num_rows($result_history) > 0) {
        while ($hcount = mysqli_fetch_array($result_history)) {
        echo $hcount['countt'];
    }
}
}
?></a></div>

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
                   <!-- <i class='far fa-user-circle' style='font-size:36px; float: right;margin-top:30px;'></i>-->
                    <a href="logout.php" class="far fa-user-circle" style='font-size:36px; float: right;margin-top:30px; color:black;'></a>
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
                        <lable> Income: From: </lable>
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
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <input type="submit" name="search" value="Search">
                </div>
            </form>

            <div style="background-image:url('images/bckedit.png'); height: 100vh; width:100%;">

                <div class="row">
                    <div class="col-lg-1">
                    </div>
                    <div class="col-lg-4">
                        <div id="donutchart" style="width: 100%; height:100vh;"></div>
                    </div>
                    <div class="col-lg-4">
                        <div id="columnchart_values" style="width: 100%; height: 100vh;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1">
                    </div>
                    <div class="col-lg-4">
                        <div id="donutchart2" style="width: 100%; height: 100vh;"></div>
                    </div>
                    <div class="col-lg-4">
                        <div id="chart_div_income" style="width: 100%; height: 100vh;"></div>
                    </div>
                </div>
            </div>
</body>

</html>