<?php
include 'config.php';
session_start();
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
    $gnOfficerId=$_POST['GNOfficerId'];
    $gnFirstName=$_POST['GnFName'];
    $gnLastName=$_POST['GnLName'];
    $gender=$_POST['Gender'];
    $contactNo=$_POST['ContactNo'];

    $query = "INSERT INTO gramaniladhariofficer (gramaNiladhariOfficerid, gramaniladhariOfficerFirstname, gramaNiladhariOfficerLastName, genderid, contactNo, gramaNiladhariId) VALUES('$gnOfficerId', '$gnFirstName', '$gnLastName','$gender','$contactNo','$gnId')";
    if (mysqli_query($link, $query)) {
        echo "Grama Niladhari Officer details added Successfully";
        
        
    } else {
        echo "Error gn: " . $query . "<br>";
    }

}
?>


