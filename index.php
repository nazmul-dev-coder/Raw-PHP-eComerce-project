<?PHP
include_once 'common/header.php';
?>


<?php
$result=$pd->getProductByBrand();

?>

				<!-- the end of header -->

	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php 
				if($result){
					$i=0;
					while($row=$result->fetch_assoc()){
				$i++;
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php"> <img src="admin/upload/<?php echo $row['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $row['brandName'];?></h2>
						<p><?php echo $helper->textShorten($row['body'],60);?></p>
						<div class="button"><span><a href="preview.php?productId=<?php echo $row['productId'];?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   
			   <?php
			   		if($i==2){
						echo "</div> <div class='section group'>";

					}
					}
				}
			   ?>
				<!-- <div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="preview.php"><img src="images/pic3.png" alt="" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Samsung</h2>
						  <p>Lorem ipsum dolor sit amet, sed do eiusmod.</p>
						  <div class="button"><span><a href="preview.php">Add to cart</a></span></div>
					</div>
				</div>
			</div>
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php"> <img src="images/pic3.jpg" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Acer</h2>
						<p>Lorem ipsum dolor sit amet, sed do eiusmod.</p>
						<div class="button"><span><a href="preview.php">Add to cart</a></span></div>
				   </div>
			   </div>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="preview.php"><img src="images/pic1.png" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Canon</h2>
						  <p>Lorem ipsum dolor sit amet, sed do eiusmod.</p>
						  <div class="button"><span><a href="preview.php">Add to cart</a></span></div>
					</div>
				</div> -->
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

		  <?php
		  $result=$pd->getFeaturedProduct();
		  if($result){
			while($row=$result->fetch_assoc()){

		
		  ?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?productId=<?PHP echo $row['productId'];?>"><img style="max-height:150px" src="admin/upload/<?PHP echo $row['image'];?>" alt="" /></a>
					 <h2><?PHP echo $row['productName'];?> </h2>
					 <p><?PHP  echo $helper->textShorten($row['body'],100);?></p>
					 <p><span class="price"><?PHP echo $row['price'];?></span></p>
				     <div class="button"><span><a href="preview.php?productId=<?PHP echo $row['productId'];?>" class="details">Details</a></span></div>
				</div>
				<?php
					}
				}
				?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php
		  $result=$pd->getNewProduct();
		  if($result){
			while($row=$result->fetch_assoc()){

		
		  ?>
				<div class="grid_1_of_4 images_1_of_4">
				<a href="preview.php?productId=<?PHP echo $row['productId'];?>"><img style="max-height:150px" src="admin/upload/<?PHP echo $row['image'];?>" alt="" /></a>
					 <h2><?PHP echo $row['productName'];?> </h2>
					 <p><span class="price"><?PHP echo $row['price'];?></span></p>
				     <div class="button"><span><a href="preview.php?productId=<?PHP echo $row['productId'];?>" class="details">Details</a></span></div>
				</div>
				<?php
					}
				}
				?>
			</div>
    </div>
 </div>
</div>

				<!-- footer start -->
<?php
include_once "common/footer.php";
?>


  
