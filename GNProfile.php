<!doctype html>
<html lang="en">

<head>
    <title>GramaNiladhari Profile</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
        integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel=" stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
	




    <style type="text/css">
        .right {
            float: right;
        }

        input,
        textarea {
            margin-left: 250px;
            font-size: 16px;
        }

        #btnSave {
            margin-left: 248px;
            font-size: 18px;
        }
        select{
            margin-left:265px;
            padding-left:8px;
            padding-top:8px;
            padding-bottom:8px;
            padding-right:8px;
            border-radius:4px;
            
        }
        #btnEdit{
            margin-left:260px;
        }
    </style>

    <?php
    include 'config.php';

session_start();
$user=$_SESSION['userid'];
$sql="SELECT GramaNiladhariId FROM user WHERE userId='$user'";
if($result=mysqli_query($link,$sql)){
    if(mysqli_num_rows($result) >0){
        $row=mysqli_fetch_assoc($result);
        $gnId=$row['GramaNiladhariId'];
        $_SESSION['$gnId']=$gnId;
    }
}

$username=$_SESSION['username'];
$sql="SELECT  divisionalSecretariatId FROM gramaniladhari WHERE gramaNiladhariId='$gnId'";
	
if($result=mysqli_query($link,$sql)){
    if(mysqli_num_rows($result) >0){
        $row=mysqli_fetch_assoc($result);
        $divSecId=$row['divisionalSecretariatId'];
        $_SESSION['$divSecId']=$divSecId;


    }
}
$sql="SELECT divisionalSecretariatName FROM divisionalsecretariat WHERE divisionalSecretariatId='$divSecId' ";
if($result=mysqli_query($link,$sql)){
if(mysqli_num_rows($result) >0){
    $row=mysqli_fetch_assoc($result);
    $divSecName=$row['divisionalSecretariatName'];
    $_SESSION['$divSecName']=$divSecName;


}
}

$sql="SELECT districtId FROM divisionalsecretariat WHERE divisionalSecretariatId='$divSecId' ";
if($result=mysqli_query($link,$sql)){
if(mysqli_num_rows($result) >0){
    $row=mysqli_fetch_assoc($result);
    $distId=$row['districtId'];
    $_SESSION['$distId']=$distId;


}
}

$sql="SELECT districtName FROM district WHERE districtId='$distId' ";
if($result=mysqli_query($link,$sql)){
if(mysqli_num_rows($result) >0){
    $row=mysqli_fetch_assoc($result);
    $distName=$row['districtName'];
    $_SESSION['$districtName']=$distName;


}
}



$sql="SELECT provinceId FROM district WHERE districtId='$distId' ";
if($result=mysqli_query($link,$sql)){
if(mysqli_num_rows($result) >0){
    $row=mysqli_fetch_assoc($result);
    $provId=$row['provinceId'];
    $_SESSION['$provId']=$provId;


}
}

$sql="SELECT provinceName FROM province WHERE provinceId='$provId' ";
if($result=mysqli_query($link,$sql)){
if(mysqli_num_rows($result) >0){
    $row=mysqli_fetch_assoc($result);
    $provName=$row['provinceName'];
    $_SESSION['$provName']=$provName;


}
}

$sql="SELECT * FROM gramaniladhariofficer WHERE gramaNiladhariId='$gnId' ";
if($result=mysqli_query($link,$sql)){
    if(mysqli_num_rows($result) >0){
        $row=mysqli_fetch_assoc($result);
        $gnOfficerId=$row['gramaNiladhariOfficerid'];
        $gnFName=$row['gramaniladhariOfficerFirstname'];
        $gnLName=$row['gramaNiladhariOfficerLastName'];
        $gender=$row['genderid'];
        $contactNo=$row['contactNo'];
        $email=$row['email'];
        $address=$row['Officialaddress'];

        

        
        
        

    }
}

$user=$_SESSION['userid'];
$sql="SELECT GramaNiladhariId FROM user WHERE userId='$user'";
if($result=mysqli_query($link,$sql)){
    if(mysqli_num_rows($result) >0){
        $row=mysqli_fetch_assoc($result);
        $gnId=$row['GramaNiladhariId'];
        //$_SESSION['$gnId']=$gnId;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['Save'])){
    $gnOfficerId=$_POST['GNOfficerId'];
    $gnFirstName=$_POST['GnFName'];
    $gnLastName=$_POST['GnLName'];
    $gender=$_POST['Gender'];
    $contactNo=$_POST['ContactNo'];
    $email=$_POST['email'];
    $officialAddress=$_POST['officialAddress'];

    $query = "INSERT INTO gramaniladhariofficer (gramaNiladhariOfficerid, gramaniladhariOfficerFirstname, gramaNiladhariOfficerLastName, genderid, contactNo, gramaNiladhariId,officialAddress,email) VALUES('$gnOfficerId', '$gnFirstName', '$gnLastName','$gender','$contactNo','$gnId','$officialAddress','$email')";
    if (mysqli_query($link, $query)) {
        echo "Grama Niladhari Officer details added Successfully";
         $inserted ='true';
        
        
    } else {
        echo "Error gn: " . $query . "<br>";
    }
}
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['Edit'])){
        $query="UPDATE gramaniladhariofficer SET gramaniladhariOfficerid='$gnOfficerId',gramaniladhariOfficerFirstname='$gnFName',gramaNiladhariOfficerLastName='$gnLName',genderid='$gender',contactNo='$contactNo',Officialaddress='$address' WHERE gramaNiladhariId='$gnId'";
        if (mysqli_query($link,$sql)){
            echo "GN profile updated successfully!";
            header("location:GNProfile.php");
        }else{
            echo "Error gn: " . $sql . "<br>";
        }
    
    
    }
}

    $sql="SELECT * FROM gramaniladhariofficer WHERE gramaNiladhariId='$gnId'";
    $result=mysqli_query($link,$sql) or die (mysqli_error());
    global $gnFName;
    while ($row=mysqli_fetch_array($result)){
        if(mysqli_num_rows($result) >0){
			$row=mysqli_fetch_assoc($result);
			$gnFName=$row['gramaniladhariOfficerFirstname'];
            $gnLName=$row['gramaNiladhariOfficerLastName'];
            $genderid=$row['genderid'];
            $contactNo=$row['contactNo'];
            $gnId=$row['gramaNiladhariId'];
            $officialAddress=$row['Officialaddress'];
            $email=$row['email'];


            $_SESSION['gnFName']=$gnFName;
            $_SESSION['gnLName']=$gnLName;
            $_SESSION['contactNo']=$contactNo;
            $_SESSION['gnId']=$gnId;
            $_SESSION['officialAddress']=$officialAddress;
            $_SESSION['email']=$email;

        }else{
            $gnFName="";
            $gnLName="";
            $genderid="";
            $contactNo="";
            $gnId="";
            $officialAddress="";
            $email="";
        }
    }
            

    
    
    ?>

    




</head>

<body style="background-color: rgb(179, 226, 185);">

    <div class="container-fluid">
        <section>
            <div class="row">
                <div class="col-sm-9"
                    style="background-color: rgb(95, 143, 103);font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                    <h1>E-Census Sri Lanka</h1>
                </div>
                <div class="col-sm-1" style="background-color: rgb(95, 143, 103);">
                    <i class="fa fa-bell" style="font-size:36px; margin-top:24px; float:right;"></i>

                </div>

                <div class="col-sm-1" style="background-color: rgb(95, 143, 103);">
                    <label style="margin-top:30px; float:right;"><h5> <?php $userId=$_SESSION['userid'];
                        $username=$_SESSION['username']; echo $username ?></h5>
                        
                        
                    </label>
                </div>

                <div class="col-sm-1" style="background-color: rgb(95, 143, 103);">
                    <i class='far fa-user-circle' style='font-size:36px; float: right;margin-top:30px;'></i>
                    <!--<img src="images/profile.png" style="float: right; width: 50px; height: 50px;margin-top: 20px;">-->
                </div>
            </div>

            <div class="row">

                <div class="col-lg-1"></div>

                <div class="col-lg-10">
                    <div id="bg">
                        <h2 style="text-align: center; margin-top:10px;">GN Profile</h2>

                        <hr />

                        <form action="" method="post" form id="newForm">
                            <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                                <input type="text" class="form-control input-lg" name="name"
                                    placeholder="<?php $username=$_SESSION['username']; echo $username ?> " disabled required>
                            </div>
                            <br />

                            <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                                <input type="text" class="form-control input-lg" name="DS"
                                    placeholder="<?php  echo $_SESSION['$divSecName'] ?>" disabled required>
                            </div>
                            <br />

                            <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                                <input type="text" class="form-control input-lg" name="district" placeholder="<?php  echo $_SESSION['$districtName'] ?>"
                                    disabled required>
                            </div>
                            <br />
                            <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                                <input type="text" class="form-control input-lg" name="province" placeholder="<?php echo $_SESSION['$provName'] ?>"
                                    disabled required>
                            </div>
                            <br />

                            <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                                <input type="text" class="form-control input-lg" name="GNOfficerId"   placeholder="GN Officer Id" value="<?php echo $gnId ?>">
                                   >
                            </div>
                            <br/>
                            <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                                <input type="text" class="form-control input-lg" name="GnFName"  placeholder="GN First Name" value="<?php if(isset($_SESSION['gnFName'])){ echo "gnf"; }?>"
                                    >
                            </div>
                            <br/>
                            <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                                <input type="text" class="form-control input-lg" name="GnLName"  placeholder="GN Last Name" value="<?php echo $gnLName ?>"
                                    >
                            </div>
                            <br />

                           
                                <select name="Gender" ><option value="1">Female</option><option value="2">Male</option>
                                 </select>
                          
                            <br/><br/>

                            <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                                <input type="text" class="form-control input-lg" name="ContactNo"
                                    placeholder="Contact Number" value="<?php echo $contactNo ?>" >
                            </div>
                            <br />

                            <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                                <input type="text" class="form-control input-lg" name="email" 
                                    placeholder="email" value="<?php echo $email  ?>">
                            </div>
                            <br/>
                            
                            <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6 ">

                                <input type="text" class="form-control input-lg" name="officialAddress"  placeholder="Official Address" value="<?php echo $officialAddress ?>">
                            </div>
                            <br />
                            <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                                <button type="submit" class="btn btn-success col-md-6" name="Save" id="btnSave">Save</button>
                                
                            </div>
                            <br/>
                            <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            
                            <button type="submit" class="btn btn-success col-md-6" name="Edit" id="btnEdit">Edit</button>
                                </div>
                         
                            <br/>
                           
                            
                        </form>
                    </div>
                </div>

                <div class="col-lg-1"></div>

                

            </div>
</body>
</html>
