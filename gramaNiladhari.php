
<?php
include "config.php";

                $divSecId=0;
				
                if(isset($_POST['divisionalsec'])){
					$divSecId = mysqli_real_escape_string($link,$_POST['divisionalsec']); 
					
					}
                   
                    $divisionalsec_arr = array();

                    $ds_res=mysqli_query($link,"Select gramaNiladhariId,gramaNiladhariName,gnCodeNo from gramaniladhari WHERE divisionalSecretariatId='".$divSecId."'");
                     while($row=mysqli_fetch_array($ds_res))
                    { 
                        $gnid = $row['gramaNiladhariId'];
                        $gn_name = $row['gramaNiladhariName'];  
                        $gn_code=$row['gnCodeNo'];                
                        $divisionalsec_arr[] = array("gramaNiladhariId" => $gnid, "gramaNiladhariName" => $gn_name, "gnCodeNo"=>$gn_code);
                    }
                 
                echo json_encode($divisionalsec_arr); 
?>