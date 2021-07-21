<!doctype html>
<html lang="en">

<head>
    <title>GramaNiladhari's Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1, shrink-to-fit=no">
    <?php
    require_once "Layouts/HeaderBody.php";
    ?>
    <link rel="stylesheet" href="CSS/stylesheetbody.css">
</head>

<body style="background-image:url('images/bckedit.png');height: 100vh; width:100% ; background-size: cover;">
    <section>
        <div class="row no-gutters">
            <div class="card-deck">
                <div class="card-container">
                    <a href="GNProfile.php" />
                    <div class="card text-center product p-4 pt-5">
                        <img src="images/profile.png">
                        <div class="card-body p-4 py-0 h-xs-440p">
                            <b>PROFILE</b>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="card-container">
                    <a href="GNApproval.php" />
                    <div class="card text-center product p-4 pt-5">
                        <img src="images/download.png">
                        <div class="card-body p-4 py-0 h-xs-440p">
                            <b>APPROVALS</b>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="card-container">
                    <a href="GNReport.php" />
                    <div class="card text-center product p-4 pt-5">
                        <img src="images/the-business-report-icon-audit-and-analysis-vector-6522497.jpg">
                        <div class="card-body p-4 py-0 h-xs-440p">
                            <b>REPORT</b>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="card-container">
                    <a href="GNDataTable.php" />
                    <div class="card text-center product p-4 pt-5">
                        <img src="images/data_table.png">
                        <div class="card-body p-4 py-0 h-xs-440p">
                            <b>RAW DATA</b>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="push"></div>
    <section>
        <?php
        require_once "Layouts/Footer.php";
        ?>
    </section>
    <?php
$userId=$_SESSION['userid'];
$username=$_SESSION['username']
?>
</body>

</html>