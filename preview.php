<?PHP

include_once 'common/header.php';

?>

<?php
$pd=new product();
if(isset($_GET['productId'])){
$productId=$helper->validation($_GET['productId']);
}else{
    echo "<script>window.location='index.php'</script>";
}
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
			<?php
			if(isset($productId)){
				$result=$pd->getPrevewProduct($productId);
				while($row=$result->fetch_assoc()){
			
			
			?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/upload/<?php echo $row['image'];?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $row['productName'];?> </h2>
					<p><?php echo $helper->textShorten($row['body'],200) ;?></p>					
					<div class="price">
						<p>Price: <span>$<?php echo $row['price'];?></span></p>
						<p>Category: <span><?php echo $row['catName'];?></span></p>
						<p>Brand:<span><?php echo $row['brandName'];?></span></p>
					</div>
				<div class="add-cart">
					<form action="cart.php" method="post">
						<input type="hidden" class="buyfield" name="productId" value="<?php echo $productId;?>"/>
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>				
				</div>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $row['body'];?></p>
	    <?php
				
			}
		}
		?>
		</div>
				
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
				<?php
				$query="select * from tbl_catagory order by catId desc limit 20";
				$result=$db->select($query);
				if($result){
					while ($row=$result->fetch_assoc()){

				?>
				      <li><a href="productbycat.php?catId=<?php echo $row['catId'];?>"><?php echo $row['catName'];?></a></li>
				    <?php
											
										}
									}
					?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
	</div>


	<?PHP
		include_once 'common/footer.php';
	?>