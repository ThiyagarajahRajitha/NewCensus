
<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $gnuserName=$_POST['gnusername'];
    $gnuser = $_POST['gndivision'];
    $gnpassword = $_POST['gnpassword'];
    $gnconfirmpassword = $_POST['gnconfirmpassword'];
    // $typpe= $_POST['usertype'];
    $nic = $_POST['nic'];
    $hhpassword = $_POST['hhpassword'];
    $hhconfirmpassword = $_POST['hhconfirmpassword'];
    $type = $_POST['usertype'];
    $gnId = "";

    echo $gnuserName;
    if ($type == 'GramaNiladhari') {
        $gnId = $_POST['gndivision'];
        //echo $gnuser;

        $query = "INSERT INTO user (username, password, Role, GramaNiladhariId) VALUES ('$gnuserName', '$gnpassword', '$type','$gnId')";
        
        if (mysqli_query($link, $query)) {
            echo "Grama Niladhari account has been Created Successfully";
            //header("location:http://localhost/NewCensus/login.html"); //to redirect back to "login.php" after registeration
            header("Location:login.php"); //to redirect back to "login.php" after registeration
            exit();
        } else {
            echo "Error gn: " . $query . "<br>";
        }
		
    } elseif ($type == 'HouseholdHead') {

        //echo $type;
        $query = "INSERT INTO user (username, password, Role, GramaNiladhariId) VALUES ('$nic', '$hhpassword', '$type',null)";
        if (mysqli_query($link, $query)) {
            echo "Household Head account has been Created Successfully";
            header("location:http://localhost/NewCensus/login.php"); //to redirect back to "login.php" after registeration
            exit();
        } else {
            echo "Error hh: " . $query . "<br>";
        }

    }

}
?>