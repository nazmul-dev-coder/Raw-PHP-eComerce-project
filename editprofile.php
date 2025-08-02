<?PHP
include_once 'common/header.php';
$value=session::get("customerLogin");
if($value!=true){
	header("Location:login.php");
}
?>

<?php
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['updateUser'])){
	$returnMsg=$cs->updateCustomer($_POST);
}
?>


 <div class="main">
    <div class="content">
    	<div class="register_account">
    		<h3>Update User information</h3>
			<?php

			if(isset($returnMsg)){
				echo $returnMsg;
			}
			
			?>
            <?php
            $results=$cs-> getCustomer();
            if($results){
                while($row=$results->fetch_assoc()){
              
            ?>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="customerName" value="<?php echo $row['customerName']?>" placeholder="Name">
							</div>
							
							<div>
							   <input type="text" name="city" value="<?php echo $row['city']?>" placeholder="City" >
							</div>
							
							<div>
								<input name="zipCode" value="<?php echo $row['zipCode']?>"  type="text" placeholder="Zip-Code" >
							</div>
							<div>
								<input name="email" value="<?php echo $row['email']?>" type="text" placeholder="E-Mail">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input name="address" value="<?php echo $row['address']?>" type="text" placeholder="Address" >
						</div>
		           <div>
		          <input name="country" value="<?php echo $row['country']?>" type="text" placeholder="Country" >
		          </div>
				  
				  <div>
					<input name="phone" value="<?php echo $row['phone']?>" type="text" placeholder="Phone" >
				</div>
				<div style="float:right;" class="search"><div><button type="submit" name="updateUser" class="grey">Update Account</button></div></div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		  
		    <div class="clear"></div>
		    </form>
            <?php
                  
                }
            }
            ?>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>


<?PHP
include_once 'common/footer.php';
?>