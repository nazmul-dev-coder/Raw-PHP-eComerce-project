<?PHP
include_once 'common/header.php';
$value=session::get("customerLogin");
if($value!=true){
	header("Location:login.php");
}
?>

<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
						<table class="tblone">
							<tr>
                            <?php
						$result=$cs->getCustomer();
						$i=0;
						if($result){
							$price=0;
							?>
								<th width="15%">Name</th>
								<th width="20%">Email</th>
								<th width="20%">Address</th>
								<th width="10%">Zipcode</th>
								<th width="10%">Country</th>
                                <th width="10%">City</th>
								<th width="10%">Phone</th>
                                <th width="5%">Action</th>
                                
							</tr>
						
						<?PHP	

							while($row=$result->fetch_assoc()){
								$i++;
						
						?>
							<tr>
								<td><?php echo $row['customerName'];?></td>
								<td><?php echo $row['email'];?></td>
								<td><?php echo $row['address'];?></td>
								<td> <?php echo $row['zipCode'];?></td>
								<td>
                                <?php echo $row['country'];?>
								</td>
								<td><?php echo $row['city'];?></td>
                                <td><?php echo $row['phone'];?></td>
								<td><a onclick="return confirm('Are you sure to edit this information?')" href="editprofile.php">Edit</a></td>
							</tr>
						<?php
							}}

							//session::set('TOTAL',$price);
						
								
						?>	
							
						</table>
						
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>

							<!-- footer section -->


<?PHP
	include_once 'common/footer.php';
?>