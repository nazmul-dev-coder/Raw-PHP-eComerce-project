<?PHP
include_once 'common/header.php';
$value=session::get("customerLogin");
if($value==true){
	header("Location:order.php");
}
?>

<?php
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
	$returnMsg=$cs->addNewCustomer($_POST);
}
?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])){
	$returnMsg2=$cs->checkLogIn($_POST);
	//echo "<script>alert()</script>";
}

?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
			<?php

			if(isset($returnMsg2)){
				echo $returnMsg2;
			}
			
			?>
        	<form action="" method="post" id="member">
                	<input name="email" type="text" placeholder="email" class="field">
                    <input name="password" type="password" placeholder="Password" class="field">
					<div class="buttons"><div><button type="submit" name="login" class="grey">Sign In</button></div></div>
                    </div>
            </form>
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                   
    	<div class="register_account">
    		<h3>Register New Account</h3>
			<?php

			if(isset($returnMsg)){
				echo $returnMsg;
			}
			
			?>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="customerName" placeholder="Name">
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="City" >
							</div>
							
							<div>
								<input name="zipCode"  type="text" placeholder="Zip-Code" >
							</div>
							<div>
								<input name="email"  type="text" placeholder="E-Mail">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input name="address"  type="text" placeholder="Address" >
						</div>
		    		<div>
					<input name="country"  type="text" placeholder="Country">
				 </div>		        
	
		           <div>
		          <input name="phone"  type="text" placeholder="Phone" >
		          </div>
				  
				  <div>
					<input name="password"  type="text" placeholder="Password" >
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button type="submit" name="submit" class="grey">Create Account</button></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>


<?PHP
include_once 'common/footer.php';
?>