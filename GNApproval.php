<!doctype html>
<html lang="en">

<head>
    <title>GramaNiladhari Home</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height,initial-scale=1, shrink-to-fit=no">
    <?php
    require_once "Layouts/HeaderBody.php";
    ?>
    <link rel="stylesheet" href="CSS/stylesheetbody.css">

</head>

<body>
            <?php

require_once "config.php";

$gn = "SELECT GramaNiladhariId FROM user WHERE userId=$userId";
if ($result_gnId = mysqli_query($link, $gn)) {
    if (mysqli_num_rows($result_gnId) > 0) {
        $res = mysqli_fetch_array($result_gnId);
        $gnId = $res['GramaNiladhariId'];
    }
}

$qertyshow = "SELECT h.householdMemberId, h.memberFirstName, h.memberLastName, h.NIC, h.DOB,h.genderId, g.gender,
 h.Relationship, e.employmentType, h.employementTypeId,h.employementDescription, h.income, h.statusId,s.status,
 h.userId, h.gramaNiladhariId FROM (((householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
    INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId) INNER JOIN status AS s
    ON s.statusId=h.statusId)
    WHERE h.gramaNiladhariId='$gnId'AND (h.statusId=1 OR h.statusId=4 OR h.statusId=7)";
//"SELECT * FROM householdmember WHERE userId='$userId'";

if ($result_history = mysqli_query($link, $qertyshow)) {
    if (mysqli_num_rows($result_history) > 0) {
        // echo "before";
        echo "<div class='table-responsive'>";
        echo "<table id='t01' class='table table-striped'>";
        echo "<thead >";
        echo "<tr>";
        echo "<th>#</th>";
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
        echo "<th colspan='3'>Action</th>";
        
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($hh = mysqli_fetch_array($result_history)) {
            echo "<tr><form action='approval.php' method='post'>";
            echo "<td><input type='text' name='householdMemberId' size='3' value='" . $hh['householdMemberId'] . "'readonly='readonly'</td>";
            //echo "<td>".$hh['householdMemberId']."</td>";
            echo "<td><input type='text' name='memberFirstName' size='10' value='" . $hh['memberFirstName'] . "'readonly='readonly'></td>";
            echo "<td><input type='text' name='memberLastName' size='10' value='" . $hh['memberLastName'] . "'readonly='readonly'></td>";
            echo "<td><input type='text' name='NIC' size='10' value='" . $hh['NIC'] . "'readonly='readonly'></td>";
            echo "<td><input name='DOB' type='date' size='10' value='" . $hh['DOB'] . "'readonly='readonly'></td>";
            echo "<td><select name='gender'>
                                <option value=" . $hh['genderId'] . ">" . $hh['gender'] . "</option>
                                </select></td>";
            //echo "<td><input type='text' name='gender' size='6' value='".$hh['gender']."'></td>";
            echo "<td><input type='text' name='Relationship' size='10' value='" . $hh['Relationship'] . "'readonly='readonly'></td>";
            echo "<td><select name='employment' id='employment'>
                                <option value=" . $hh['employementTypeId'] . ">" . $hh['employmentType'] . "</option>

                            </select></td>";
            //echo "<td><input type='text' name='employmentType' size='10' value='".$hh['employmentType']."'</td>";
            echo "<td><input type='text' name='employementDescription' size='10' value='" . $hh['employementDescription'] . "'readonly='readonly'</td>";
            echo "<td><input type='text' name='income' size='8' value='" . $hh['income'] . "'readonly='readonly'</td>";
            //echo "<td><input type='text' name='gramaNiladhariId' size='5' value='".$hh['gramaNiladhariId']."'</td>";
            echo "<td><input type='text' name='statusId' size='5' value='" . $hh['status'] . "'readonly='readonly'</td>";

            //echo "<td><a href='view.php?id=".$hh['hosssuseholdMemberId']."'>VIEW</a></td>";
            echo "<td><input type='Submit' class='btn btn-primary' Name='view' Value='VIEW'></td>";
            echo "<td><INPUT TYPE ='Submit' class='btn btn-success' Name = 'approve' VALUE = 'APPROVE'></td>";
            echo "<td><INPUT TYPE ='Submit' class='btn btn-danger' Name = 'reject' VALUE = 'REJECT'></td>";
            //echo "<td><a href='edit.php?id=".$hh['householdMemberId']."'>Edit</a></td>";

            echo "</form></tr>";
        }

           echo "</tbody>";
           echo "</table>";
           echo "</div>";

        //for new row for the existing userid

    }
}
?>
<a class="btn btn-secondary btn-lg " href="gnhome.php"><i class="fas fa-hand-point-left"></i>  BACK</a>



<section>
        <?php
        require_once "Layouts/Footer.php";
        ?>
    </section>

</body>

</html>