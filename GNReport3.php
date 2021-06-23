<?php
require "config.php";
session_start();
$userId = $_SESSION['userid'];
$username = $_SESSION['username'];

$gn = "SELECT GramaNiladhariId FROM user WHERE userId=$userId";
if ($result_gnId = mysqli_query($link, $gn)) {
    if (mysqli_num_rows($result_gnId) > 0) {
        $res = mysqli_fetch_array($result_gnId);
        $gnId = $res['GramaNiladhariId'];
    }
}

$qertyshow = "SELECT g.gender, COUNT(h.householdMemberId) AS gender_count 
FROM ((householdmember AS h INNER JOIN gender AS g ON g.genderId = h.genderId)
INNER JOIN status AS s ON s.statusId=h.statusId) WHERE h.gramaNiladhariId='$gnId' 
AND (h.statusId=0 OR h.statusId=1 OR h.statusId=4 OR h.statusId=9) 
GROUP BY h.genderId ";
    //"AND (h.statusId=0 OR h.statusId=2 OR h.statusId=5 OR h.statusId=8)'";
$result = mysqli_query($link, $qertyshow);  

  if ( ! $result ) {
    echo mysql_error();
    die;
  }

  $data = array();

for ($x = 0; $x < mysqli_num_rows($result); $x++) {
    //if (mysqli_num_rows($result) > 0) {
        //while($row=mysqli_fetch_array($result)){
        $data[] = mysqli_fetch_assoc($result);
}
 
  // encode data to json format
  echo json_encode($data);  
 
  // close connection
  mysqli_close($link);

?>