$(document).ready(function(){
	$('#addsubmit').click(function(){
			//Gets text in the input
			var _multiName= $('#addmultiname').val();
			var _userEmail = $('#user-email').val();
			var channels = '';
			if(_multiName.length > 0){
			//proceed with ajax
			$('#addmultiname').css('border','1px solid #dae0e6');
			
			$.post("ajax/multiinsert.php",
				{
					task: "multiinsert",
					userEmail : _userEmail,
					multiName : _multiName,
					channels : channels,
				}
			).error(
				function( data ){
					console.log("Error");
				}
			).success(
				function( data ){
											
					$('#multilist').prepend('<a href="index.php?id="><div class="multilistitem">variablegoeshere</div></a>');
			console.log(_multiName + " " + _userEmail);
			});
		} else {
			//Put a red border on
			$('#addmultiname').css('border','2px solid #e74c3c');
			console.log("Empty Text Area");
		}
		
		//Removes text in new multi input
		$('#addmultiname').val("");
		});
		
	});


