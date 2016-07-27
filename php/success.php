<?php
	class Success{
	
		function getSuccess($successnumber){
			if($successnumber == 2){
				echo "<div class='alert alert-success' style='position:absolute; top:60%; left:41.11%'> 
							<b>Successfully</b> Disabled an account.
							&nbsp;&nbsp;&nbsp;<button type = 'button' class = 'close' data-dismiss = 'alert'> &times;</button>
							</div>";
			}else if( $successnumber == 1 ){
				echo "<div class='alert alert-success' style='position:absolute; top:70%; left:42%'> 
					<b>Successfully</b> added an account.
					&nbsp;&nbsp;&nbsp;<button type = 'button' class = 'close' data-dismiss = 'alert'> &times;</button>
					</div>";
			}
			
			else if($successnumber==3){
					echo "<br><div class='alert alert-success' role='alert'><strong>Success </strong> Item Added</div>";
				 }
				 else if($successnumber==4){
					echo "<br><div class='alert alert-success' role='alert'><strong>Success </strong> Item Removed</div>";
				 }
				 else if($successnumber==5){
					echo "<br><div class='alert alert-success' role='alert'><strong>Success </strong> Quantity Added</div>";
				 }else if($successnumber==6){
					echo "<br><div class='alert alert-success' role='alert'><strong>Success </strong> Quantity Deducted</div>";
				 }else if($successnumber == 7){
				echo "<div class='alert alert-success' style='position:absolute; top:73%; left:42%'> 
						<b>Successfully</b> Activated an account.
						&nbsp;&nbsp;&nbsp;<button type = 'button' class = 'close' data-dismiss = 'alert'> &times;</button>
						</div>";
				}else if($successnumber==8){
					echo "<br><div class='alert alert-success' role='alert'><strong>Success </strong> Request Sent!</div>";
				 }else if($successnumber==9){
					echo "<br><div class='alert alert-success' role='alert'><strong>Success </strong> Updated!</div>";
				 }
		
		}
	
	}
	
	$successHandler = new Success;

?>