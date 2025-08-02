<?PHP
include_once 'common/header.php';
?>
<style>
    .shopping{
        text-align: center;
        justify-content: center;
        margin: auto;
    }
    .shopping a{
        padding:2rem 1rem;
        display: block;
        color:white;
        background: red;
        margin: 0.5rem 0rem;
        border-radius:0.5rem;
        font-size: 2rem;
        
    }
</style>


         		 <!-- container -->
				 

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
					<?php
						$result=$cd->getCardList();
						$i=0;
						if($result){
							$price=0;
							?>
						<table class="tblone">
							<tr><th width="5%">Sl</th>
								<th width="25%">Product Name</th>
								<th width="15%">Image</th>
								<th width="15%">Price</th>
								<th width="20%">Quantity</th>
								<th width="20%">Total Price</th>
							</tr>
						
						<?PHP	
							while($row=$result->fetch_assoc()){
								$i++;
						
						?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $row['productName'];?></td>
								<td><img src="admin/upload/<?php echo $row['image'];?>" alt=""/></td>
								<td>$ <?php echo $row['price'];?></td>
								<td>
									<form action="" method="post">
										<input disabled type="number" name="quantity" value="<?php echo $row['quantity'];?>"/>
									</form>
								</td>
								<td>$ <?php echo $row['price']*$row['quantity'];?></td>
							</tr>
						<?php
						$qprice=$row['price']*$row['quantity'];
						$price +=$qprice;
								
							}

							//session::set('TOTAL',$price);
						
								
						?>	
							
						</table>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>$ <?php echo $price;?></td>
							</tr>
							<tr>
								<th>VAT(10%) : </th>
								<td><?php echo $price*0.1;?></td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>$ <?php echo $price+$price*0.1;?> </td>
							</tr>
					   </table>
					   <?php }else{?>
						<table class="tblone">
							<tr><td><h3 style="color:red;">Card empty please shop now</h3></td></tr>
					   </table>
						<?php }?>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Profile</h2>
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
                  <div class="shopping">
						<div>
							<a href="paymentdetails.php?order=order">Confirm Order </a>
						</div>
					</div> 	
       <div class="clear"></div>
    </div>
 </div>
</div>

							<!-- footer section -->


<?PHP
	include_once 'common/footer.php';
?>