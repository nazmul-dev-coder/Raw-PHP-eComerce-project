<?PHP
include_once 'common/header.php';
?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
	$result=$cd->addToCard($_POST);
}
?>

<?php
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['update'])){
	$result=$cd->updateToCard($_POST);
	if($result){
	echo '<meta http-equiv="refresh"content=0;url=cart.php?live=0>';
	}

}

if(isset($_GET['dcartId'])){
	$result=$cd->delateCardItem($_GET['dcartId']);
	//echo 'working';
}
if(!isset($_GET['live'])){
	echo '<meta http-equiv="refresh"content=0;url=cart.php?live=0>';
	//header("location:cart.php?live=0");
	//echo 'working';
}
?>

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
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="20%">Quantity</th>
								<th width="20%">Total Price</th>
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
								<td>$ <?php echo $row['price'];?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $row['cartId'];?>"/>
										<input type="number" name="quantity" value="<?php echo $row['quantity'];?>"/>
										<input type="submit" name="update" value="Update"/>
									</form>
								</td>
								<td>$ <?php echo $row['price']*$row['quantity'];?></td>
								<td><a onclick="return confirm('Are you sure to delete this item?')" href="?dcartId=<?php echo $row['cartId'];?>">X</a></td>
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
						<!-- <table class="tblone">
							<tr><td><h3 style="color:red;">Card empty please shop now</h3></td></tr>
					   </table> -->
						<?php header("Location:index.php"); }?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="login.php"> <img src="images/check.png" alt="" /></a>
						</div>
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