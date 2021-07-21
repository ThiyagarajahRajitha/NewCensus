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
    </head>

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


<body>

    <form action="" method="post" form id="submittedForm"  style="display: none;">
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
                                <input type="text" class="form-control input-lg" name="GNOfficerId"   placeholder="GN Officer Id" value="<?php echo $row ['gramaNiladhariOfficerid']; ?>"
                                   >
                            </div>
                            <br/>
                            <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                                <input type="text" class="form-control input-lg" name="GnFName"  placeholder="GN First Name" value="<?php echo $gnFName; ?>"
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
                                    placeholder="Contact Number" value="<?php echo $row['contactNo']; ?>">
                            </div>
                            <br />

                            <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                                <input type="text" class="form-control input-lg" name="email" value="<?php echo $email ?>">
                            </div>
                            <br/>
                            
                            <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6 ">

                                <textarea rows="5" columns="300" name="officialAddress"  placeholder="Official Address"><?php echo $officialAddress ?></textarea>
                            </div>
                            <br />
                            <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                                <button type="submit" class="btn btn-success col-md-6" name="Save" id="btnSave">Save</button>
                                
                            </div>
                            <br/>
                            
                            <button type="submit" class="btn btn-success col-sm-3" name="Edit" id="btnEdit" >Edit</button>
                                
                         
                            <br/>
                           
                            
                        </form>








                <div class="col-lg-1"></div>

                

            
</body>
</html>
    
