<!doctype html>
<html lang="en">

<head>
    <title>GramaNiladhari Home</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,height=device-height initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <?php
    require_once "Layouts/HeaderBody.php";
    ?>
    <link rel="stylesheet" href="CSS/stylesheetbody.css">
    <script src="main.js"></script>
</head>

<body class="GNRowdata">

    <br>
    <div class="row"  id="filter">
        <form id="form1" action="" method="post">
            <table id="rowdataselect">
                <tr>
                    <td>
                        <lable> Gender: </lable>
</td>
                    <td><select name="gender" id="gender" class="form-control">
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
</td>
<td> </td>
                    <td>
                        <lable> Employment Type: </lable>
                    </td>
                    <td><select name="employmenttype" id="employmenttype" class="form-control">
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
                    <td><input type="submit" class="btn btn-primary btn-lg btn-block" name="search" value="Search" onclick="onClear()"></td>

                </tr>
            </table>
        </form>
    </div>
    <?php
//function getrowdata($gender){

require "config.php";

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

    //echo $where;
    $qertyshow = "SELECT h.householdMemberId, h.memberFirstName, h.memberLastName, h.NIC, h.DOB,h.genderId, g.gender,
 h.Relationship, e.employmentType, h.employementTypeId,h.employementDescription, h.income, h.statusId,s.status,
 h.userId, h.gramaNiladhariId FROM (((householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
    INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId) INNER JOIN status AS s
    ON s.statusId=h.statusId) $where";
    //h.gramaNiladhariId='$gnId' AND (h.statusId=0 OR h.statusId=1 OR h.statusId=4 OR h.statusId=9) AND h.genderId='$gender'";
    //echo $qertyshow;

} else {
    //echo "pageloaf";
    $qertyshow = "SELECT h.householdMemberId, h.memberFirstName, h.memberLastName, h.NIC, h.DOB,h.genderId, g.gender,
    h.Relationship, e.employmentType, h.employementTypeId,h.employementDescription, h.income, h.statusId,s.status,
    h.userId, h.gramaNiladhariId FROM (((householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
       INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId) INNER JOIN status AS s
       ON s.statusId=h.statusId)
       WHERE h.gramaNiladhariId='$gnId' AND (h.statusId=2 OR h.statusId=5 OR h.statusId=8)";
    //"AND (h.statusId=0 OR h.statusId=2 OR h.statusId=5 OR h.statusId=8)'";
}

//if ($gender==null){

//}
//else{
//}

if ($result_history = mysqli_query($link, $qertyshow)) {
    if (mysqli_num_rows($result_history) > 0) {

        ?>
    <div id='household_table'>
        <form method="POST" id="convert_form" action="export.php">
            <table id='t01' border=1>
                <thead>
                    <tr>
                        <th>Member No.</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>NIC</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Relationship</th>
                        <th>EmploymentType</th>
                        <th>Employement Desc</th>
                        <th>Income</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
while ($hh = mysqli_fetch_array($result_history)) {
            ?>

                    <tr>
                        <td><?php echo $hh['householdMemberId']; ?> </td>
                        <td><?php echo $hh['memberFirstName']; ?></td>
                        <td><?php echo $hh['memberLastName']; ?></td>
                        <td><?php echo $hh['NIC']; ?></td>
                        <td><?php echo $hh['DOB']; ?></td>
                        <td><?php echo $hh['gender']; ?></td>
                        <td><?php echo $hh['Relationship']; ?></td>
                        <td><?php echo $hh['employmentType']; ?></td>
                        <td><?php echo $hh['employementDescription']; ?></td>
                        <td><?php echo $hh['income']; ?></td>
                    </tr>

                    <?php
}
        ?>
                </tbody>
            </table>
            <input type="hidden" name="file_content" id="file_content" />
            <button type="button" name="convert" class="btn btn-dark btn-lg" id="convert">
                <i class="fas fa-file-excel"></i>   Download Excel</button>
                
        </form>
    </div>



    <?php
}
}
//}
//getrowdata(null);

?>
    <?php
/*if (isset($_POST['search'])) {

$gender = $_POST['gender'];
getrowdata($gender);
echo "welcome";
echo $gender;
}
 */
?>


    </div>

    <section>
        <?php
        require_once "Layouts/Footer.php";
        ?>
    </section>

</body>

</html>

<!--<script>
$(document).ready(function(){
    $('#create_excel').click(function(){
        var excel_data=$('household_table').html();
        var page="excel.php?data="+ excel_data;
        window.location=page;
    });
});

</script>-->

<script>
$(document).ready(function() {
    $('#convert').click(function() {
        var table_content = '<table>';
        table_content += $('#t01').html();
        table_content += '</table>';
        $('#file_content').val(table_content);
        $('#convert_form').submit();


    });
});
</script>