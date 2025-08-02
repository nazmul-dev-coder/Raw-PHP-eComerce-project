<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';
$pd=new product();
?>
<?php
if(isset($_GET['dproductId'])){
	$dproductId=mysqli_real_escape_string($db->link,$_GET['dproductId']);
	$result=$pd->delProduct($dproductId);
	}
	
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
			<?php if(isset($result)){echo $result;}?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Sl</th>
					<th>product Name</th>
					<th>Cat Name</th>
					<th>Brand Name</th>
					<th>Body</th>
					<th>Image</th>
					<th>Price</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>

			<?PHP
			$result=$pd->getAllProduct();
			if($result){
				$i=0;
				while($row=$result->fetch_assoc()){
					$i++;

			?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $row['productName'];?></td>
					<td><?php echo $row['catName'];?></td>
					<td><?php echo $row['brandName'];?></td>
					<td><?php echo $helper->textShorten($row['body'],50);?></td>
					<td><img style='height:60px;width:40px;' src="upload/<?php echo $row['image'];?>"></td>
					<td><?php echo $row['price'];?></td>
					<td><?php if( $row['type']==1){
						echo 'Featuared';
					}else{
						echo "General";
					}
					
					
					?></td>
					<td><a href="editproduct.php?productId=<?php echo $row['productId']?>">Edit</a> || <a onclick="return confirm('Are you sure to delete this product')" href="?dproductId=<?php echo $row['productId']?>">Delete</a></td>
						</tr>
					
				</tr>
			<?php

				}
					}
			?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
