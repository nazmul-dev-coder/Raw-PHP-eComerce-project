<?PHP
include_once 'common/header.php';
?>
<?php
if(isset($_GET['dorderId'])){
    $dorderId=$_GET['dorderId'];
    $delete=$or->deleteOrder($dorderId);
}
?>


         		 <!-- container -->
				 

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Orders</h2>
					<?php

                    if(isset($delete)){
                        echo $delete;
                    }
						$result=$or->getMyOrder();
						$i=0;
						if($result){
							$price=0;
							?>
						<table class="tblone">
							<tr><th width="5%">Sl</th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price&Q</th>
								<th width="20%">Total</th>
								<th width="20%">Status</th>
								<th width="10%">Action</th>
							</tr>
						
						<?PHP	
							while($row=$result->fetch_assoc()){
								$i++;
						
						?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $row['productName'];?></td>
								<td><img src="admin/upload/<?php echo $row['image'];?>" alt=""/></td>
								<td>$ <?php echo $row['price'];?> Q:<?php echo $row['quantity'];?></td>
								<td>
                                <?php
                                    $qprice=$row['price']*$row['quantity'];
                                    echo $qprice;
                                            
                                        					
                                ?>	
								</td>
								<td><?php 
                                if($row['status']==0){
                                    echo "Pending";
                                }else{
                                    echo "Shifted";
                                }
                                ?>
                                </td>
								<td>
                                    <?php 
                                    if($row['status']==0){
                                    ?>
                                    <a onclick="return confirm('Are you sure to Cancel this order?')" href="?dorderId=<?php echo $row['orderId'];?>">Cancel</a></td>
                                    <?php }else{ echo 'N/A';}?>
							</tr>
					
							<?php }?>
						</table>
					   <?php }else{header("Location:cart.php");}?>
						<!-- <table class="tblone">
							<tr><td><h3 style="color:red;">Card empty please shop now</h3></td></tr>
					   </table> -->
						<?php// header("Location:index.php"); }?>
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