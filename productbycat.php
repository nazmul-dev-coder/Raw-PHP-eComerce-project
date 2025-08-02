<?PHP
include_once 'common/header.php';
?>

<?php
if(isset($_GET['catId'])){
	$catId=$_GET['catId'];
}else{
	header('Location:index.php');
}
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from Catagory</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			<?php
			$result=$pd->getProductByCat($catId);
			if($result){
				while($row=$result->fetch_assoc()){

			
			?>
				<div style='min-height:370px;' class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?productId=<?php echo $row['productId'];?>"><img src="admin/upload/<?php echo $row['image'];?>" alt="" /></a>
					 <h2><?php echo $row['productName'];?> </h2>
					 <p><?php echo $helper->textShorten($row['body'],100);?></p>
					 <p><span class="price">$<?php echo $row['price'];?></span></p>
				     <div class="button"><span><a href="preview.php?productId=<?php echo $row['productId'];?>" class="details">Details</a></span></div>
				</div>
				<?php
					}
				}else{
					echo "<h1 style='color:red;padding:100px;text-align:center;'>PRODUCT NOT AVAILABLE<h1>";
				}
				
				?>
				
			</div>

	
	
    </div>
 </div>
</div>
  
<?PHP
include_once 'common/footer.php';
?>