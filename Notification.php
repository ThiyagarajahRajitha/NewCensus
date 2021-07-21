<?php
require_once "config.php";
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

$qertyshow = "SELECT count(h.householdMemberId) AS countt FROM householdmember AS h 
INNER JOIN status AS s ON s.statusId=h.statusId WHERE h.gramaNiladhariId='$gnId' 
AND (h.statusId=1 OR h.statusId=4 OR h.statusId=7)";

if ($result_history = mysqli_query($link, $qertyshow)) {
    if (mysqli_num_rows($result_history) > 0) {
        while ($hcount = mysqli_fetch_array($result_history)) {
        echo $hcount['countt'];
    }
}
}
?>