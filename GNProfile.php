<!doctype html>
<html lang="en">

<head>
    <title>GramaNiladhari Profile</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1, shrink-to-fit=no">
    <?php
require_once "HeaderBody.php";
?>
    <link rel="stylesheet" href="stylesheetbody.css">
    <?php
include 'config.php';

$user = $_SESSION['userid'];
$sql = "SELECT GramaNiladhariId FROM user WHERE userId='$user'";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $gnId = $row['GramaNiladhariId'];
        $_SESSION['$gnId'] = $gnId;
    }
}
$username = $_SESSION['username'];
$sql = "SELECT  divisionalSecretariatId FROM gramaniladhari WHERE gramaNiladhariId='$gnId'";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $divSecId = $row['divisionalSecretariatId'];
        $_SESSION['$divSecId'] = $divSecId;
    }
}
$sql = "SELECT divisionalSecretariatName FROM divisionalsecretariat WHERE divisionalSecretariatId='$divSecId' ";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $divSecName = $row['divisionalSecretariatName'];
        $_SESSION['$divSecName'] = $divSecName;
    }
}
$sql = "SELECT districtId FROM divisionalsecretariat WHERE divisionalSecretariatId='$divSecId' ";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $distId = $row['districtId'];
        $_SESSION['$distId'] = $distId;
    }
}
$sql = "SELECT districtName FROM district WHERE districtId='$distId' ";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $distName = $row['districtName'];
        $_SESSION['$districtName'] = $distName;
    }
}
$sql = "SELECT provinceId FROM district WHERE districtId='$distId' ";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $provId = $row['provinceId'];
        $_SESSION['$provId'] = $provId;
    }
}
$sql = "SELECT provinceName FROM province WHERE provinceId='$provId' ";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $provName = $row['provinceName'];
        $_SESSION['$provName'] = $provName;
    }
}
?>
</head>

<body>
    <section>
        <div class="row no-gutters">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div id="bg">
                    <h2 style="text-align: center; margin-top:10px;">GN Profile</h2>
                    <hr />
                    <form action="GN_Profile.php" method="post">
                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <input type="text" class="form-control input-lg" name="name"
                                placeholder="<?php $username = $_SESSION['username'];
echo $username?> " disabled
                                required>
                        </div>
                        <br />
                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <input type="text" class="form-control input-lg" name="DS"
                                placeholder="<?php echo $_SESSION['$divSecName'] ?>" disabled required>
                        </div>
                        <br />
                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <input type="text" class="form-control input-lg" name="district"
                                placeholder="<?php echo $_SESSION['$districtName'] ?>" disabled required>
                        </div>
                        <br />
                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <input type="text" class="form-control input-lg" name="province"
                                placeholder="<?php echo $_SESSION['$provName'] ?>" disabled required>
                        </div>
                        <br />
                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <input type="text" class="form-control input-lg" name="GNOfficerId"
                                placeholder="GN Officer Id" required>
                        </div>
                        <br />
                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <input type="text" class="form-control input-lg" name="GnFName" placeholder="GN First Name"
                                required>
                        </div>
                        <br />
                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <input type="text" class="form-control input-lg" name="GnLName" placeholder="GN Last Name"
                                required>
                        </div>
                        <br />
                        <select name="Gender">
                            <option value="1">Female</option>
                            <option value="2">Male</option>
                        </select>
                        <br /><br />
                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <input type="text" class="form-control input-lg" name="ContactNo"
                                placeholder="Contact Number" required>
                        </div>
                        <br />
                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <input type="text" class="form-control input-lg" name="email" placeholder="Email Address"
                                required>
                        </div>
                        <br />
                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6 ">
                            <textarea rows="5" columns="300" name="officialAddress"
                                placeholder="Official Address"></textarea>
                        </div>
                        <br />
                        <div class="col-5m-12 col-md-6 col-lg-6 col-md-6 col-md-6">
                            <button type="submit" class="btn btn-success col-md-6" id="btnSave">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
        <section>
            <?php
require_once "Footer.php";
?>
        </section>
</body>

</html>