<!doctype html>
<html lang="en">

<head>
    <title>GramaNiladhari Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <?php
require_once "Layouts/HeaderBody.php";
?>
    <link rel="stylesheet" href="CSS/stylesheetbody.css">
</head>

<body>
    <?php
require_once "config.php";
$userId = $_SESSION['userid'];
$username = $_SESSION['username'];
$gn = "SELECT GramaNiladhariId FROM user WHERE userId=$userId";
if ($result_gnId = mysqli_query($link, $gn)) {
    if (mysqli_num_rows($result_gnId) > 0) {
        $res = mysqli_fetch_array($result_gnId);
        $gnId = $res['GramaNiladhariId'];
    }
}
//$id = $_GET['id'];
//if(isset($_POST['Edit']))
if (isset($_POST['view'])) {
    $qertyshow = "SELECT h.householdMemberId, h.memberFirstName, h.memberLastName, h.NIC, h.DOB,h.genderId, g.gender,
 h.Relationship, e.employmentType, h.employementTypeId,h.employementDescription, h.income, h.statusId,s.status,
 h.userId, h.gramaNiladhariId FROM (((history AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
    INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId) INNER JOIN status AS s
    ON s.statusId=h.statusId)
    WHERE h.gramaNiladhariId='135'"; //'$gnId135'

    if ($result_history = mysqli_query($link, $qertyshow)) {
        if (mysqli_num_rows($result_history) > 0) {
            //echo "after";
            echo "<div class='table-responsive'>";
            echo "<table id='t02' class='table table-striped'>";
            echo "<thead >";
            echo "<tr>";
            echo "<th>Member No.</th>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>NIC</th>";
            echo "<th>DOB</th>";
            echo "<th>Gender</th>";
            echo "<th>Relationship</th>";
            echo "<th>EmploymentType</th>";
            echo "<th>Employement Desc</th>";
            echo "<th>Income</th>";
            echo "<th>Status</th>";
            echo "<th colspan='2'>Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($hh = mysqli_fetch_array($result_history)) {
                echo "<td>" . $hh['householdMemberId'] . "</td>";
                //echo "<td>".$hh['householdMemberId']."</td>";
                echo "<td>" . $hh['memberFirstName'] . "</td>";
                echo "<td>" . $hh['memberLastName'] . "</td>";
                echo "<td>" . $hh['NIC'] . "</td>";
                echo "<td>" . $hh['DOB'] . "</td>";
                echo "<td><select name='gender'>
                                <option value=" . $hh['genderId'] . ">" . $hh['gender'] . "</option>
                                </select></td>";
                //echo "<td><input type='text' name='gender' size='6' value='".$hh['gender']."'></td>";
                echo "<td>" . $hh['Relationship'] . "</td>";
                echo "<td>" . $hh['employmentType'] . "</td>";
                //echo "<td><input type='text' name='employmentType' size='10' value='".$hh['employmentType']."'</td>";
                echo "<td>" . $hh['employementDescription'] . "</td>";
                echo "<td>" . $hh['income'] . "</td>";
                //echo "<td><input type='text' name='gramaNiladhariId' size='5' value='".$hh['gramaNiladhariId']."'</td>";
                echo "<td>" . $hh['status'] . "</td>";
                echo "<td><form action='approval.php' method='post'><INPUT TYPE ='Submit' Name = 'approve' class='btn btn-success' VALUE = 'APPROVE'></form></td>";
                echo "<td><form action='approval.php' method='post'><INPUT TYPE ='Submit' Name = 'reject' class='btn btn-danger' VALUE = 'REJECT'></form></td>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "No record is matching your query";
        }
    } else {
        "ERROR:Could not able to execute $history " . mysqli_error($link);
    }
}
//approving the row
if (isset($_POST['approve'])) {
    $update = "UPDATE householdmember SET statusId=5
WHERE householdMemberId = '$_POST[householdMemberId]'";

    if (mysqli_query($link, $update)) {

        echo "Approved";
        header("refresh:0; url=GNApproval.php");
    } else {
        echo "Not Updated.";
    }
}

if (isset($_POST['reject'])) {
    $update = "UPDATE householdmember SET statusId=9
WHERE householdMemberId = '$_POST[householdMemberId]'";

    if (mysqli_query($link, $update)) {

        echo "Rejected";
        header("refresh:0; url=GNApproval.php");
    } else {
        echo "Not Updated.";
    }
}
?>
    </div>
    <section>
        <?php
require_once "Layouts/Footer.php";
?>
    </section>

</body>

</html>