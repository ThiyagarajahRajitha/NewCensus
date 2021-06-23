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

/*$qertyshow = "SELECT h.householdMemberId,h.genderId, g.gender, COUNT(h.householdMemberId) AS gender_count
FROM ((householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
INNER JOIN status AS s ON s.statusId=h.statusId) WHERE h.gramaNiladhariId='$gnId'
AND (h.statusId=0 OR h.statusId=1 OR h.statusId=4 OR h.statusId=9)
GROUP BY h.genderId ";*/
/*$qertyshow ="SELECT g.gender,h.income 
FROM householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId 
INNER JOIN status AS s ON s.statusId=h.statusId WHERE h.gramaNiladhariId='$gnId' 
AND (h.statusId=0 OR h.statusId=1 OR h.statusId=4 OR h.statusId=9)";*/
$qertyshow ="SELECT g.gender,h.income,a.gender_count
FROM
(SELECT g.genderId,COUNT(g.gender) as gender_count
FROM householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId
INNER JOIN status AS s ON s.statusId=h.statusId 
WHERE h.gramaNiladhariId=16
AND (h.statusId=0 OR h.statusId=1 OR h.statusId=4 OR h.statusId=9)
GROUP BY g.genderId)
 as a 
 inner join householdmember h on h.genderId=a.genderId
 INNER JOIN gender AS g ON g.genderId = h.genderId
INNER JOIN status AS s ON s.statusId=h.statusId 
WHERE h.gramaNiladhariId=16
AND (h.statusId=0 OR h.statusId=1 OR h.statusId=4 OR h.statusId=9)";

/*$qertyshow="SELECT h.income,COUNT(h.householdMemberId) AS count FROM (INNER JOIN status AS s
ON s.statusId=h.statusId)
WHERE h.gramaNiladhariId='$gnId' AND (h.statusId=0 OR h.statusId=1 OR h.statusId=4 OR h.statusId=9) GROUP BY h.income";
//"AND (h.statusId=0 OR h.statusId=2 OR h.statusId=5 OR h.statusId=8)'";
 */
$result = mysqli_query($link, $qertyshow);
/*if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {

        echo "['" . $row["income"] . "', " . $row["gender_count"] . "],";
        //echo "[2, ".$row["gender_count"]."],";
        //echo "['".'Michael'."' , ".'5'."],['".'Elisa'."', ".'7'."],";
    }
}
*/

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

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    // Load the Visualization API and the controls package.
    google.charts.load('current', {
        'packages': ['corechart', 'controls']
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawDashboard);

    // Callback that creates and populates a data table,
    // instantiates a dashboard, a range slider and a pie chart,
    // passes in the data and draws it.
    function drawDashboard() {

        // Create our data table.
        var data = google.visualization.arrayToDataTable([
            ['Gender', 'Income','Count'],
            //  ['Michael' , 5],
            //['Elisa', 7],

            <?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        //echo "['".$row["gender"]."', ".$row["gender_count"]."],";
        //echo "[".'Michael'." , ".'5'."],[".'Elisa'.", ".'7'."],";
        //echo "['" . $row["gender"] . "', " . $row["gender_count"] . "],";
        echo "['" . $row["gender"] . "', " . $row["income"] . "," . $row["gender_count"] . "],";
    }
}
?>
        ]);

        // Create a dashboard.
        var dashboard = new google.visualization.Dashboard(
            document.getElementById('dashboard_div'));

        // Create a range slider, passing some options
        var donutRangeSlider = new google.visualization.ControlWrapper({
            'controlType': 'NumberRangeFilter',
            'containerId': 'filter_div',
            'options': {
                'filterColumnLabel': 'Income'
            }
        });

        // Create a pie chart, passing some options
        var pieChart = new google.visualization.ChartWrapper({
            'chartType': 'PieChart',
            'containerId': 'chart_div',
            'options': {
                'width': 300,
                'height': 300,
                'pieSliceText': 'value',
                'legend': 'right'
            }
        });

        // Establish dependencies, declaring that 'filter' drives 'pieChart',
        // so that the pie chart will only display entries that are let through
        // given the chosen slider range.
        dashboard.bind(donutRangeSlider, pieChart);

        // Draw the dashboard.
        dashboard.draw(data);
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


            <!--Div that will hold the dashboard-->
            <div id="dashboard_div">
                <!--Divs that will hold each control and chart-->
                <div id="filter_div"></div>
                <div id="chart_div"></div>
            </div>
</body>

</html>