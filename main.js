
	var gn = document.getElementById("gnregisterform");
	var hh = document.getElementById("hhregisterform");
	if(hh!=null)
    hh.style.display="none";
	

		function usertypeonChange(value){
			var gn = document.getElementById("gnregisterform");
	        var hh = document.getElementById("hhregisterform");
			if(value=="GramaNiladhari"){
				gn.style.display="block";
				hh.style.display="none";
			}
			else{
				gn.style.display="none";
				hh.style.display="block";
			}
		}

		function provinceonChange(value){
			
			var provid = parseInt(value);
	
			$.ajax({
				url: 'district.php',
				type: 'post',
				data: {province:provid},
				dataType: 'json',
				success:function(response){
					
					var len = response.length;
	
					$("#district").empty();
					$("#district").append("<option value='0'>"+'---Select---'+"</option>");
					for( var i = 0; i<len; i++){
						var id = response[i]['districtId'];
						var name = response[i]['districtName'];
						
						$("#district").append("<option value='"+id+"'>"+name+"</option>");
	
					}
				},
				error:function(x,e)
				{
				
				}
			});
		}


		function districtOnChange(value){
			
			var districtid = parseInt(value);
	
			$.ajax({
				url: 'dsdivision.php',
				type: 'post',
				data: {district:districtid},
				dataType: 'json',
				success:function(response){
					
					var len = response.length;
					$("#dsdivision").empty();
					$("#dsdivision").append("<option value='0'>"+'---Select---'+"</option>");
					for( var i = 0; i<len; i++){
						var id = response[i]['divisionalSecretariatId'];
						var name = response[i]['divisionalSecretariatName'];
						
						$("#dsdivision").append("<option value='"+id+"'>"+name+"</option>");
	
					}
				},
				error:function(x,e)
				{
				
				}
			});
		}

		

		function DivSecOnChange(value){
			
			var divsecid = parseInt(value);
	
			$.ajax({
				url: 'gramaNiladhari.php',
				type: 'post',
				data: {divisionalsec:divsecid},
				dataType: 'json',
				success:function(response){
					
					var len = response.length;
					
					$("#gndivision").empty();
					$("#gndivision").append("<option value='0'>"+'---Select---'+"</option>");
					for( var i = 0; i<len; i++){
						var id = response[i]['gramaNiladhariId'];
						var name = response[i]['gramaNiladhariName'];
						var code = response[i]['gnCodeNo'];
						
						$("#gndivision").append("<option value='"+id+"'>"+code+"-"+name+"</option>");
	
					}
				},
				error:function(x,e)
				{
				
				}
			});
		}

		function gnOnChange(value){

			
			var gnId = document.getElementById("gndivision");
			var gnUname = gnId.options[gnId.selectedIndex].text;
			document.getElementById("gnusername").value = gnUname;
			
		}




		
		function nicOnkeypress() {
  			var d=document.getElementById("nic").value;
  			document.getElementById("hhusername").value = d;
  			//alert(d);
		}


		//function onClear(){
		//	debugger;
		//$("#t01 tr").remove();
		//document.getElementById("t01").remove();
	//}

