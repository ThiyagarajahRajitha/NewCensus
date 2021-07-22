<!doctype html>
<html lang="en">

<head>
    <title>House Head Home</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <?php
require_once "Layouts/HeaderHousehold.php";
?>
    <link rel="stylesheet" href="CSS/stylesheetbody.css">
    <script src="main.js"></script>
</head>

<body class="hhome" style="height:135vh;">
    <h2 style="text-align: center;margin-top:10px">Family Members Details</h2>
    <hr />
    <div class="row" id="memberdetails">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form1">
            <table id="memberdetailsform">
                <tr>
                    <td></td>
                    <td><label>First Name: </label></td>
                    <td>
                        <input type="text" class="form-control input-lg" name="fname" placeholder="First Name" required>
                    </td>
                    <td></td>
                    <td><label>Last Name: </label></td>
                    <td>
                        <input type="text" class="form-control input-lg" name="lname" placeholder="Last Name" required>
                    </td>

                </tr>

                <tr>
                    <td></td>
                    <td><label>Province: </label></td>
                    <td>
                        <select name="province" id="province" class="form-control"
                            onchange="provinceonChange(this.value)">
                            <option value=""> ---Select--- </option>
                            <?php

$dd_res = mysqli_query($link, "Select * from province ORDER BY provinceId");
while ($row = mysqli_fetch_array($dd_res)) {
    $provinceid = $row[0];
    $province_name = $row[1];
    echo "<option value='$provinceid'> $province_name </option>";
}
?>
                        </select>
                    </td>
                    <td></td>
                    <td><label>District: </label></td>
                    <td>
                        <select name="district" id="district" class="form-control"
                            onchange="districtOnChange(this.value)">
                            <option value="">---Select---</option>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><label>DS Division: </label></td>
                    <td>
                        <select name="dsdivision" id="dsdivision" class="form-control"
                            onchange="DivSecOnChange(this.value)">
                            <option value="">---Select---</option>
                        </select>
                    </td>
                    <td></td>
                    <td><label>GN Division: </label></td>
                    <td>
                        <select name="gndivision" id="gndivision" class="form-control"
                            onchange="gnOnChange(this.value)">
                            <option value="">---Select---</option>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td><td><label>Date of Birth: </label></td></td>
                    <td>
                        <input name="dob" class="form-control" type="date">
                    </td>
                    <td></td>
                    <td><label>Gender: </label></td>
                    <td>
                        <select name="gender" class="form-control">
                            <option >---Gender---</option>
                            <option value="1">Female</option>
                            <option value="2">Male</option>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>

                    <!-- <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">

                            <textarea rows="5" columns="300" placeholder="Address"></textarea>
                        </div>
                        <br> -->
                        <td><label>NIC Number: </label></td>
                        <td>
                    <input type="NIC" class="form-control input-lg" name="nic" placeholder="NIC">
                    <!--<input type="text" class="form-control" name="gnusername" id="gnusername" placeholder="Username" readonly="readonly">-->
                    </td>
                    <td></td>
                    <td><label>Employment Type: </label></td>
<td>
                    <select name="employment" id="employment" class="form-control">
                        <option value="0">--Select Employement Type--</option>
                        <option value="1">Government</option>
                        <option value="2">Private</option>
                        <option value="3">Daily Wage</option>
                        <option value="4">Business</option>
                    </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><label>Relationship to Household Head: </label></td>
                    <td>
                        <input type="text" name="relationship" class="form-control" placeholder="Relationship to HH Head">
                    </td>
                    <td></td>
                    <td><label>Employment Description: </label></td>
                    <td rowspan="2">
                        <textarea rows="5" columns="300" class="form-control" name="employment_desc"
                            placeholder="Employement Description"></textarea>
                    </td>
                    <!--<div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <input type="text" placeholder="Education Level">
                        </div>
                        <br>-->

                    <td></td>
</tr>
<tr>
<td></td>
<td><label>Income: </label></td>
                    <td>
                        <input type="number" class="form-control" name="income" placeholder="Income">
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
<td></td>
                    <td>
                        <button class="btn btn-primary btn-lg btn-block" id="btnAdd" onclick="onClear()">SAVE</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <?php
require_once "config.php";

$qertyshow = "SELECT h.householdMemberId, h.memberFirstName, h.memberLastName, h.NIC, h.DOB,h.genderId, g.gender, h.Relationship,
    e.employmentType, h.employementTypeId,h.employementDescription, h.income, h.statusId,s.status,h.userId,
    h.gramaNiladhariId FROM (((householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
    INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId) INNER JOIN status AS s
    ON s.statusId=h.statusId)
    WHERE userId='$userId'";
//"SELECT * FROM householdmember WHERE userId='$userId'";

if ($result_history = mysqli_query($link, $qertyshow)) {
    if (mysqli_num_rows($result_history) > 0) {
        // echo "before";
        echo "<div class='table-responsive' id='household_table'>";
        echo "<table id='t01'>";
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
            echo "<tr><form action='edit.php' method='post'>";
            echo "<td><input type='text' name='householdMemberId' size='3' value='" . $hh['householdMemberId'] . "'readonly='readonly'</td>";
            //echo "<td>".$hh['householdMemberId']."</td>";
            echo "<td><input type='text' name='memberFirstName' size='10' value='" . $hh['memberFirstName'] . "'></td>";
            echo "<td><input type='text' name='memberLastName' size='10' value='" . $hh['memberLastName'] . "'></td>";
            echo "<td><input type='text' name='NIC' size='10' value='" . $hh['NIC'] . "'></td>";
            echo "<td><input name='DOB' type='date' size='10' value='" . $hh['DOB'] . "'></td>";
            echo "<td><select name='gender'>
                                <option value=" . $hh['genderId'] . ">" . $hh['gender'] . "</option>
                                <option value='1'>Male</option>
                                <option value='2'>Female</option></select></td>";
            //echo "<td><input type='text' name='gender' size='6' value='".$hh['gender']."'></td>";
            echo "<td><input type='text' name='Relationship' size='10' value='" . $hh['Relationship'] . "'></td>";
            echo "<td><select name='employment' id='employment'>
                                <option value=" . $hh['employementTypeId'] . ">" . $hh['employmentType'] . "</option>
                                <option value='1'>Government</option>
                                <option value='2'>Private</option>
                                <option value='3'>Daily Wage</option>
                                <option value='4'>Business</option>
                            </select></td>";
            //echo "<td><input type='text' name='employmentType' size='10' value='".$hh['employmentType']."'</td>";
            echo "<td><input type='text' name='employementDescription' size='10' value='" . $hh['employementDescription'] . "'</td>";
            echo "<td><input type='text' name='income' size='8' value='" . $hh['income'] . "'></td>";
            //echo "<td><input type='text' name='gramaNiladhariId' size='5' value='".$hh['gramaNiladhariId']."'</td>";
            echo "<td><input type='text' name='statusId' size='5' value='" . $hh['status'] . "'></td>";

            echo "<td><INPUT TYPE ='Submit' class='btn btn-info btn-block' Name = 'Submit1' VALUE = 'Edit & Save'></td>";
            //echo "<td><a href='edit.php?id=".$hh['householdMemberId']."'>Edit</a></td>";
            echo "<td><a href='delete.php?id=" . $hh['householdMemberId'] . "' class='btn btn-danger btn-block'>Delete</a></td>";

            echo "</form></tr>";
        }

        echo "</tbody>";
        echo "</table>";

        //for new row for the existing userid

    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $nic = $_POST['nic'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $relationship = $_POST['relationship'];
    $employment = $_POST['employment'];
    $employment_desc = $_POST['employment_desc'];
    $income = $_POST['income'];
    $userId = $_SESSION['userid'];
    $gndivision = $_POST['gndivision'];

    //echo $userId;
    //echo $username;
    //echo $fname;
    //echo $lname;
    //echo $nic;

    $query = "INSERT INTO householdmember (memberFirstName, memberLastName, NIC, DOB,genderId, Relationship, employementTypeId,
                      employementDescription, income, userId, gramaNiladhariId, statusId) VALUES ('$fname', '$lname',
                            '$nic','$dob', '$gender', '$relationship', '$employment', '$employment_desc', '$income','$userId', '$gndivision',7)";

    if (mysqli_query($link, $query)) {
        //echo "Inserted Successfully";
        //header("Location:login.php"); //to redirect back to "login.php" after registeration
        //exit();
    } else {
        echo "Error gn: " . $query . "<br>";
    }

    $qertyshow = "SELECT h.householdMemberId, h.memberFirstName, h.memberLastName, h.NIC, h.DOB, g.gender,h.genderId, h.Relationship, e.employmentType,h.employementTypeId, h.employementDescription, h.income, h.statusId,s.status,h.userId, h.gramaNiladhariId FROM (((householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
                INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId) INNER JOIN status AS s ON s.statusId=h.statusId)
                WHERE userId='$userId'ORDER BY householdMemberId DESC LIMIT 1";
    //"SELECT * FROM householdmember WHERE userId='$userId'";

    if ($result_history = mysqli_query($link, $qertyshow)) {
        if (mysqli_num_rows($result_history) > 0) {
            
            while ($hh = mysqli_fetch_array($result_history)) {
                echo "<tr><form action='edit.php' method='POST'>";
                echo "<td><input type='text' name='householdMemberId' size='3' value='" . $hh['householdMemberId'] . "'readonly='readonly'</td>";
                //echo "<td>".$hh['householdMemberId']."</td>";
                echo "<td><input type='text' name='memberFirstName' size='10' value='" . $hh['memberFirstName'] . "'></td>";
                echo "<td><input type='text' name='memberLastName' size='10' value='" . $hh['memberLastName'] . "'></td>";
                echo "<td><input type='text' name='NIC' size='10' value='" . $hh['NIC'] . "'></td>";
                echo "<td><input name='DOB' type='date' size='10' value='" . $hh['DOB'] . "'></td>";
                echo "<td><select name='gender'>
                                <option value=" . $hh['genderId'] . ">" . $hh['gender'] . "</option>
                                <option value='1'>Male</option>
                                <option value='2'>Female</option></select></td>";
                //echo "<td><input type='text' name='gender' size='6' value='".$hh['gender']."'></td>";
                echo "<td><input type='text' name='Relationship' size='10' value='" . $hh['Relationship'] . "'></td>";
                echo "<td><select name='employment' id='employment'>
                                <option value=" . $hh['employementTypeId'] . ">" . $hh['employmentType'] . "</option>
                                <option value='1'>Government</option>
                                <option value='2'>Private</option>
                                <option value='3'>Daily Wage</option>
                                <option value='4'>Business</option>
                            </select></td>";
                //echo "<td><input type='text' name='employmentType' size='10' value='".$hh['employmentType']."'</td>";
                echo "<td><input type='text' name='employementDescription' size='10' value='" . $hh['employementDescription'] . "'</td>";
                echo "<td><input type='text' name='income' size='8' value='" . $hh['income'] . "'</td>";
                //echo "<td><input type='text' name='gramaNiladhariId' size='5' value='".$hh['gramaNiladhariId']."'</td>";
                echo "<td><input type='text' name='statusId' size='5' value='" . $hh['status'] . "'</td>";
                echo "<td><INPUT TYPE ='Submit' class='btn btn-warning btn-block'Name = 'Submit1' VALUE = 'Edit'></td>";
                echo "<td><a href='delete.php?id=" . $hh['householdMemberId'] . "' class='btn btn-danger btn-block'>Delete</a></td>";

                echo "</form></tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "No record is matching to your query";
        }
    } else {
        "ERROR:Could not able to execute $history " . mysqli_error($link);
    }

}

?>
<p></p></hr><p></p><p></p><p></p><p></p><p>&nbsp&nbsp&nbsp</p><p></p><p></p>
</div>
    
<section>
        <?php
require_once "Layouts/Footer.php";
?>
    </section>
</body>

</html>