<!doctype html>
<html lang="en">

<head>
    <title>House Head Home</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
        integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"">
	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--  <script src='https://kit.fontawesome.com/a076d05399.js'></script>-->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="main.js"></script>
    <style type="text/css">
        .button {
            background-color: #ecf3ed;
            /* Green */
            border: none;
            color: rgb(12, 0, 0);
            padding: 10px;
            text-align: center;
            font-weight: bolder;
            text-decoration: none;
            display: inline-block;
            font-size: 16 px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button5 {
            border-radius: 50%;
            margin-left: 1300px;
        }

        table {
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }

        #t01 tr:nth-child(even) {
            background-color: #eee;
        }

        #t01 tr:nth-child(odd) {
            background-color: #fff;
        }

        #t01 th {
            background-color: black;
            color: white;
        }

        #t02 tr:nth-child(even) {
            background-color: #eee;
        }

        #t02 tr:nth-child(odd) {
            background-color: #fff;
        }

        #t02 th {
            background-color: black;
            color: white;
        }

        th,
        td {
            padding: 5px;
        }

        table {
            border-spacing: 5px;
        }

        .right {
            float: right;
        }

       

        #btnAdd {
            margin-left: 260px;
        }
        .required{
            border-color:red;
        }
    </style>
</head>

<body>

<?php
require_once "config.php";
?>

    <div class="col-md-12" style="background-color: rgb(179, 226, 185);">

            <div class="row">
                <div class="col-sm-8"
                    style="background-color: rgb(95, 143, 103);font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                    <h1>E-Census Sri Lanka</h1>
                </div>
                <div class="col-sm-1" style="background-color: rgb(95, 143, 103);">
                    <i class="fa fa-bell" style="font-size:36px; margin-top:24px; float:right;"></i>

                </div>

                <div class="col-sm-1" style="background-color: rgb(95, 143, 103);">
                    <label style="margin-top:30px; float:right;">
                        <h5> <?php session_start();
$userId = $_SESSION['userid'];
$username = $_SESSION['username'];
echo $username?></h5>
                    </label>
                </div>

                <div class="col-sm-2" style="background-color: rgb(95, 143, 103);">
                    <i class='far fa-user-circle' style='font-size:36px; float: right;margin-top:30px;'><a href="logout.php">out</a></i>
                    <!--<img src="images/profile.png" style="float: right; width: 50px; height: 50px;margin-top: 20px;">-->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2">
                </div>

                <div class="col-lg-8">
                    <h2 style="text-align: center;margin-top:10px">Household Details</h2>
                    <hr />

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <input type="text" class="form-control input-lg" name="fname" placeholder="First Name"
                                required>
                        </div>
                        <br />

                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <input type="text" class="form-control input-lg" name="lname" placeholder="Last Name"
                                required>
                        </div>
                        <br />

                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <input type="NIC" class="form-control input-lg" name="nic" placeholder="NIC">
				            <!--<input type="text" class="form-control" name="gnusername" id="gnusername" placeholder="Username" readonly="readonly">-->
                        </div>
                        <br/>

                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                        <select name="province" id="province" onchange="provinceonChange(this.value)">
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
                        </div>
                        <br>

                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                        <select name="district" id="district" onchange="districtOnChange(this.value)">
                        <option value="">---Select---</option>
				        </select>
                        </div>
                        <br>

                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <select name="dsdivision" id="dsdivision" onchange="DivSecOnChange(this.value)">
					        <option value="">---Select---</option>
				            </select>

                        </div>
                        <br>


                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                        <select name="gndivision" id="gndivision" onchange="gnOnChange(this.value)">
					            <option value="">---Select---</option>
				        </select>
                        </div>
                        <br>

                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <input name="dob" type="date">
                        </div>
                        <br>

                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <select name="gender">
                                <option value="1">Female</option>
                                <option value="2">Male</option>
                            </select>
                        </div>
                        <br>

                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <input type="text" name="relationship" placeholder="Relationship to HH Head">
                        </div>
                        <br>

                       <!-- <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">

                            <textarea rows="5" columns="300" placeholder="Address"></textarea>
                        </div>
                        <br> -->


                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <select name="employment" id="employment">
                                <option value="0">--Select Employement Type--</option>
                                <option value="1">Government</option>
                                <option value="2">Private</option>
                                <option value="3">Daily Wage</option>
                                <option value="4">Business</option>
                            </select>
                        </div>
                        <br>

                      <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">

                            <textarea rows="5" columns="300" name="employment_desc" placeholder="Employement Description"></textarea>
                        </div>
                        <br>

                        <!--<div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <input type="text" placeholder="Education Level">
                        </div>
                        <br>-->

                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <input type="number" name="income" placeholder="Income">
                        </div>
                        <br>
                        <button class="btn btn-success col-md-6" id="btnAdd" onclick="onClear()">SAVE</button>
                    </form>

                </div>
                <div class="col-lg-2">
                </div>
            </div>
        

        <div class="row">
            <div class="col-lg-12" id="clear_tbl">


        <?php

require_once "config.php";


$qertyshow = "SELECT h.householdMemberId, h.memberFirstName, h.memberLastName, h.NIC, h.DOB,h.genderId, g.gender, h.Relationship, 
    e.employmentType, h.employementTypeId,h.employementDescription, h.income, h.statusId,s.status,h.userId, 
    h.gramaNiladhariId FROM (((householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
    INNER JOIN employmenttype AS e ON e.employmentTypeid = h.employementTypeId) INNER JOIN status AS s 
    ON s.statusId=h.statusId)
    WHERE userId='$userId'";
    //"SELECT * FROM householdmember WHERE userId='$userId'";

    if($result_history=mysqli_query($link,$qertyshow)){
		if(mysqli_num_rows($result_history)>0){
           // echo "before";
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
            echo "<th></th>";
            echo "<th></th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            

            
            while($hh=mysqli_fetch_array($result_history)){
                echo "<tr><form action='edit.php' method='post'>";
                echo "<td><input type='text' name='householdMemberId' size='3' value='".$hh['householdMemberId']."'readonly='readonly'</td>";
                //echo "<td>".$hh['householdMemberId']."</td>";
                echo "<td><input type='text' name='memberFirstName' size='10' value='".$hh['memberFirstName']."'></td>";
                echo "<td><input type='text' name='memberLastName' size='10' value='".$hh['memberLastName']."'></td>";
                echo "<td><input type='text' name='NIC' size='10' value='".$hh['NIC']."'></td>";
                echo "<td><input name='DOB' type='date' size='10' value='".$hh['DOB']."'></td>";
                echo "<td><select name='gender'>
                                <option value=".$hh['genderId'].">".$hh['gender']."</option>
                                <option value='1'>Male</option>
                                <option value='2'>Female</option></select></td>";
                //echo "<td><input type='text' name='gender' size='6' value='".$hh['gender']."'></td>";
                echo "<td><input type='text' name='Relationship' size='10' value='".$hh['Relationship']."'></td>";
                echo "<td><select name='employment' id='employment'>
                                <option value=".$hh['employementTypeId'].">".$hh['employmentType']."</option>
                                <option value='1'>Government</option>
                                <option value='2'>Private</option>
                                <option value='3'>Daily Wage</option>
                                <option value='4'>Business</option>
                            </select></td>";
                //echo "<td><input type='text' name='employmentType' size='10' value='".$hh['employmentType']."'</td>";
                echo "<td><input type='text' name='employementDescription' size='10' value='".$hh['employementDescription']."'</td>";
                echo "<td><input type='text' name='income' size='8' value='".$hh['income']."'</td>";
                //echo "<td><input type='text' name='gramaNiladhariId' size='5' value='".$hh['gramaNiladhariId']."'</td>";
                echo "<td><input type='text' name='statusId' size='5' value='".$hh['status']."'</td>";
            
                echo "<td><INPUT TYPE ='Submit' Name = 'Submit1' VALUE = 'Edit'></td>";
                //echo "<td><a href='edit.php?id=".$hh['householdMemberId']."'>Edit</a></td>";
                echo "<td><a href='delete.php?id=".$hh['householdMemberId']."'>Delete</a></td>";
                
				echo 	"</form></tr>";
            }
            
         //   echo "</tbody>";
           // echo "</table>";
           
            
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
            
                if($result_history=mysqli_query($link,$qertyshow)){
                    if(mysqli_num_rows($result_history)>0){
                        //echo "after";
                      /*  echo "<table id='t02'>";
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
                        echo "<th></th>";
                        echo "<th></th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
            */
                        while($hh=mysqli_fetch_array($result_history)){
                            echo "<tr><form action='edit.php' method='POST'>";
                            echo "<td><input type='text' name='householdMemberId' size='3' value='".$hh['householdMemberId']."'readonly='readonly'</td>";
                            //echo "<td>".$hh['householdMemberId']."</td>";
                            echo "<td><input type='text' name='memberFirstName' size='10' value='".$hh['memberFirstName']."'></td>";
                            echo "<td><input type='text' name='memberLastName' size='10' value='".$hh['memberLastName']."'></td>";
                            echo "<td><input type='text' name='NIC' size='10' value='".$hh['NIC']."'></td>";
                            echo "<td><input name='DOB' type='date' size='10' value='".$hh['DOB']."'></td>";
                            echo "<td><select name='gender'>
                                <option value=".$hh['genderId'].">".$hh['gender']."</option>
                                <option value='1'>Male</option>
                                <option value='2'>Female</option></select></td>";
                            //echo "<td><input type='text' name='gender' size='6' value='".$hh['gender']."'></td>";
                            echo "<td><input type='text' name='Relationship' size='10' value='".$hh['Relationship']."'></td>";
                            echo "<td><select name='employment' id='employment'>
                                <option value=".$hh['employementTypeId'].">".$hh['employmentType']."</option>
                                <option value='1'>Government</option>
                                <option value='2'>Private</option>
                                <option value='3'>Daily Wage</option>
                                <option value='4'>Business</option>
                            </select></td>";
                            //echo "<td><input type='text' name='employmentType' size='10' value='".$hh['employmentType']."'</td>";
                            echo "<td><input type='text' name='employementDescription' size='10' value='".$hh['employementDescription']."'</td>";
                            echo "<td><input type='text' name='income' size='8' value='".$hh['income']."'</td>";
                            //echo "<td><input type='text' name='gramaNiladhariId' size='5' value='".$hh['gramaNiladhariId']."'</td>";
                            echo "<td><input type='text' name='statusId' size='5' value='".$hh['status']."'</td>";
                            echo "<td><INPUT TYPE ='Submit' Name = 'Submit1' VALUE = 'Edit'></td>";
                            echo "<td><a href='delete.php?id=".$hh['householdMemberId']."'>Delete</a></td>";
                         
                                echo "</form></tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    }
                    else{
                        echo "No record is matching your query";
                    }
                }	
                else{
                    "ERROR:Could not able to execute $history ".mysqli_error($link);
                }
	
    } 
	
    
?>
</div>
    </div>
       

    </div>
</body>
</html>


