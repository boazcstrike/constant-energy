<?php
	 class Error{
		
		public function getE($errornumber){
				if($errornumber == 1){
				echo "<div class='alert alert-danger' style='position:absolute; top:60%; left:41.5%'> 
					      <b>Uhh oh!</b> Please enter username.
					      &nbsp;&nbsp;&nbsp;<button type = 'button' class = 'close' data-dismiss = 'alert'> &times;</button>
					      </div>";
				} else if($errornumber == 2){
			     echo "<div class='alert alert-danger' style='position:absolute; top:60%; left:42.2%'> 
				        <b>Oops!</b> User already disabled.
						 &nbsp;&nbsp;&nbsp;<button type = 'button' class = 'close' data-dismiss = 'alert'> &times;</button>
						 </div>";
				}else if($errornumber == 3){
				echo "<div class='alert alert-danger' style='position:absolute; top:60%; left:42.5%'> 
						 <b>Woops!</b> User does not exist.
						 &nbsp;&nbsp;&nbsp;<button type = 'button' class = 'close' data-dismiss = 'alert'> &times;</button>
						 </div>";
				}else if($errornumber == 4){
				echo "<div class='alert alert-danger' style='position:absolute; top:70%; left:39.5%'> 
						 <b>Uhh oh!</b> Please fill up all information needed.
						 &nbsp;&nbsp;&nbsp;<button type = 'button' class = 'close' data-dismiss = 'alert'> &times;</button>
						 </div>";
				}else if($errornumber == 5){
				echo "<div class='alert alert-danger' style='position:absolute; top:70%; left:42.5%'> 
						 <b>Woops!</b> User already exist.
						 &nbsp;&nbsp;&nbsp;<button type = 'button' class = 'close' data-dismiss = 'alert'> &times;</button>
						 </div>";
						 
						 //change all below this
				}else if($errornumber == 6){
					echo "<br><div class='alert alert-danger' role='alert'><strong>Try Again </strong> No Input
					         </div>";
				 }else if($errornumber == 7){
					echo "<br><div class='alert alert-danger' role='alert'><strong>Try Again </strong> Incomplete/Wrong Input Placed</div>";
				 }else if($errornumber == 8){
					echo "<br><div class='alert alert-danger' role='alert'><strong>Try Again </strong> Item name doesn't exists</div>";
				 }else if($errornumber == 9){
					echo "<br><div class='alert alert-danger' role='alert'><strong>Try Again </strong> Item name already exists</div>";
				 }else if($errornumber == 10){
					echo "<br><div class='alert alert-danger' role='alert'><strong>Error </strong> Number of quantity to be deducted is too large</div>";
				 }else if($errornumber == 11){
				echo "<div class='alert alert-danger' style='position:absolute; top:71%; left:38.5%'> 
				        <b>Oops!</b> User is still Active or already Activated.
						 &nbsp;&nbsp;&nbsp;<button type = 'button' class = 'close' data-dismiss = 'alert'> &times;</button>
						 </div>";
				}else if($errornumber == 12){
					echo "<br><div class='alert alert-danger' role='alert'><strong>Try Again </strong> Item code already exists</div>";
				}
				else if($errornumber == 13){
					echo "<br><div class='alert alert-danger' role='alert'><strong>Error</strong> Quantity to be withdrawn is higher that current stock</div>";
				}
				else if($errornumber == 14){
					echo "<br><div class='alert alert-danger' role='alert' style='margin-top:0px;'><strong>Error</strong> Input must be numeric</div>";
				}else if($errornumber == 15){
					echo "<br><div class='alert alert-danger' role='alert'><strong>Error</strong> Numerical inputs cannot be negative</div>";
				}else if($errornumber == 16){
					echo "<br><div class='alert alert-danger' role='alert'><strong>Error</strong> No matching issuance number</div>";
				}
				
				
			}
			
		
			
	}
	
	
	$errorHandler = new Error;
	 
	 

?>