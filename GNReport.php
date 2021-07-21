<!doctype html>
<html>

<head>
    <title>GramaNiladhari Home</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="CSS/stylesheetbody.css">
    <!-- Bootstrap CSS -->

    <?php
require_once "Layouts/HeaderBody.php";

if (isset($_POST['search'])) {
    $gender = $_POST['gender'];
    $employmenttype = $_POST['employmenttype'];
    $amountfrom = $_POST['amountfrom'];
    $amountto = $_POST['amountto'];
    $dobfrom = $_POST['dobfrom'];
    $dobto = $_POST['dobto'];

    $where = " WHERE h.gramaNiladhariId='$gnId' AND (h.statusId=2 OR h.statusId=5 OR h.statusId=8)";
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

    //echo "filter query";
    $qertyshow = "SELECT h.genderId, g.gender, COUNT(h.householdMemberId) AS gender_count
  FROM ((householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
  INNER JOIN status AS s ON s.statusId=h.statusId)
  $where GROUP BY h.genderId";
//echo $qertyshow;
    $qertyshow2 = "SELECT h.employementTypeId, e.employmentType, COUNT(h.employementTypeId) AS employementType_count
FROM ((householdmember AS h INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId)
INNER JOIN status AS s ON s.statusId=h.statusId)
$where GROUP BY h.employementTypeid";
    //echo $qertyshow2;

   /* $qertyshow3 = "SELECT h.householdMemberId AS 'eid', TIMESTAMPDIFF(YEAR, h.DOB, CURDATE()) AS 'age'
FROM ((householdmember AS h INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId)
INNER JOIN status AS s ON s.statusId=h.statusId) $where";
*/
$qertyshow3age="SELECT t.range as 'age', count(*) as 'countt' from
(select h.DOB, case
when TIMESTAMPDIFF(YEAR, h.DOB, CURDATE()) between 1 and 10 then ' 0 - 10'
when TIMESTAMPDIFF(YEAR, h.DOB, CURDATE()) between 11 and 20 then ' 11 - 20'
when TIMESTAMPDIFF(YEAR, h.DOB, CURDATE()) between 21 and 30 then ' 21 - 30'
when TIMESTAMPDIFF(YEAR, h.DOB, CURDATE()) between 31 and 40 then ' 31 - 40'
when TIMESTAMPDIFF(YEAR, h.DOB, CURDATE()) between 41 and 50 then ' 41 - 50'
when TIMESTAMPDIFF(YEAR, h.DOB, CURDATE()) between 51 and 60 then ' 51 - 60'
else 'Above 61' end as 'range' from householdmember h
INNER JOIN status AS s ON s.statusId=h.statusId $where) t
group by t.range";
//echo $qertyshow3age;

    $qertyshow4 = "SELECT h.householdMemberId AS 'eid', h.income as 'income'
FROM ((householdmember AS h INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId)
INNER JOIN status AS s ON s.statusId=h.statusId) $where";
//echo $qertyshow4;
} else {
    //echo "pageloaf";

    $qertyshow = "SELECT h.genderId, g.gender, COUNT(h.householdMemberId) AS gender_count
FROM ((householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
INNER JOIN status AS s ON s.statusId=h.statusId) WHERE h.gramaNiladhariId='$gnId'
AND (h.statusId=2 OR h.statusId=5 OR h.statusId=8)
GROUP BY h.genderId ";

    $qertyshow2 = "SELECT h.employementTypeId, e.employmentType, COUNT(h.employementTypeId) AS employementType_count
FROM ((householdmember AS h INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId)
INNER JOIN status AS s ON s.statusId=h.statusId) WHERE h.gramaNiladhariId='$gnId'
AND (h.statusId=2 OR h.statusId=5 OR h.statusId=8)
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
WHERE h.gramaNiladhariId=$gnId AND (h.statusId=2 OR h.statusId=5 OR h.statusId=8)) t
group by t.range";
//echo $qertyshow3age;

    $qertyshow4 = "SELECT h.householdMemberId AS 'eid', h.income as 'income'
FROM ((householdmember AS h INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId)
INNER JOIN status AS s ON s.statusId=h.statusId) WHERE h.gramaNiladhariId='$gnId'
AND (h.statusId=2 OR h.statusId=5 OR h.statusId=8)";

}
$result = mysqli_query($link, $qertyshow);
$result2 = mysqli_query($link, $qertyshow2);
$result3age = mysqli_query($link, $qertyshow3age);
$result4 = mysqli_query($link, $qertyshow4);

?>


    <link rel="stylesheet" href="stylesheetbody.css">
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
                    color: 'brown'
                },
                3: {
                    color: 'yellow'
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
        echo "['" . $row3["age"] . "', " . $row3["countt"] . ",'brown'],";
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
            colors: ['Chocolate'],
        };
        var chart = new google.visualization.Histogram(document.getElementById('chart_div_income'));
        chart.draw(data, options);
    }
    </script>
</head>

<body class="GNReport">
    <div id="main-wrapper">
        <br>
        <div class="row no-gutters" id="filter">
            <form id="form1" action="" method="post">
                <table id="rowdataselect">
                    <tr>
                        <td>
                            <lable> Gender: </lable>
                        </td>
                        <td><select name="gender" id="gender" class="form-control">
                                <option value=""> ---Select--- </option>


                                <?php
require_once "config.php";
$dd_res = mysqli_query($link, "Select * from gender ORDER BY genderId");
while ($row = mysqli_fetch_array($dd_res)) {
    $genderId = $row[0];
    $gender_name = $row[1];
    echo "<option value='$genderId'> $gender_name </option>";
}
?>
                            </select>
                        </td>
                        <td> </td>
                        <td>
                            <lable> Employment Type: </lable>
                        </td>
                        <td><select name="employmenttype" id="employmenttype" class="form-control">
                                <option value=""> ---Select--- </option>


                                <?php
require_once "config.php";
$dd_res = mysqli_query($link, "Select * from employmenttype ORDER BY employmentTypeid");
while ($row = mysqli_fetch_array($dd_res)) {
    $employmenttypeId = $row[0];
    $employmenttype_name = $row[1];
    echo "<option value='$employmenttypeId'> $employmenttype_name </option>";
}
?>
                            </select></td>
                    </tr>

                    <tr>
                        <td>
                            <lable> Amount From: </lable>
                        </td>
                        <td><input type="text" name="amountfrom" id="amountfrom" class="form-control"></td>
                        <td> </td>
                        <td>
                            <lable> To: </lable>
                        </td>
                        <td> <input type="text" name="amountto" id="amountto" class="form-control"></td>
                    </tr>

                    <tr>
                        <td>
                            <lable> Date of Birth From: </lable>
                        </td>
                        <td><input type="date" name="dobfrom" id="dobfrom" class="form-control"></td>
                        <td> </td>
                        <td>
                            <lable> To: </lable>
                        </td>
                        <td> <input type="date" name="dobto" id="dobto" class="form-control"></td>
                    </tr>
                    <tr>
                        
                        <td><a class="btn btn-secondary btn-lg btn-block" href="gnhome.php"><i class="fas fa-hand-point-left"></i>  BACK</a></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="submit" class="btn btn-primary btn-lg btn-block" name="search" value="Search" onclick="onClear()">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="overflow-auto" id="chart body">
            <div class="row" id="chart">
                <div class="col-lg-1">
                </div>
                <div class="col-lg-4">
                    <div id="donutchart" style="width: 100%; height:100vh;"></div>
                </div>

                <div class="col-lg-1"></div>

                <div class="col-lg-4">
                    <div id="columnchart_values" style="width: 100%; height: 100vh;"></div>
                </div>
            </div>
            <div class="row" id="chart">
                <div class="col-lg-1"></div>

                <div class="col-lg-4">
                    <div id="donutchart2" style="width: 100%; height: 100vh;"></div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-4">
                    <div id="chart_div_income" style="width: 100%; height: 100vh;"></div>
                </div>
            </div>

           <!-- <div class="container" id="testing">
                <form method="post" id="make_pdf" action="create_pdf.php">
                    <input type="hidden" name="hidden_html" id="hidden_html" />
                    <button type="button" name="create_pdf" id="create_pdf" class="btn btn-dark btn-lg"><i
                            class="far fa-file-pdf"></i> Download PDF</button>
                </form>
            </div>
            -->
        </div>

        <section>
        <?php
        require_once "Layouts/Footer.php";
        ?>
        </section>
    </div>
</body>

</html>

<!--
<script>
$(document).ready(function() {
    $('#create_pdf').click(function() {
        $('#hidden_html').val($('#testing').html());
        $('#make_pdf').submit();
    });
});
</script>
-->