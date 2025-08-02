<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
if(isset($_GET['dbrandId'])){
	$dbrandId=mysqli_real_escape_string($db->link,$_GET['dbrandId']);
	if($dbrandId != null){
		$query="delete from tbl_brand where brandId='$dbrandId'";
		$result=$db->delete($query);
		if($result){
			$msg='<span style=" color:green">Brand deleted successfully</span>';
		}else{
			header("location:brandlist.php");
		}
	}
}
?>

<?PHP
$query='select * from tbl_brand order by brandId desc';
$result=$db->select($query);
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
				<?php
				if(isset($msg)){
					echo $msg;
				}
				?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
				<?php
				if($result){
					$i=0;
					while($row=$result->fetch_assoc()){ $i++
						?>

						<tr class="odd gradeX">
							<td><?PHP echo $i;?></td>
							<td><?PHP echo $row['brandName'];?></td>
							<td><a href="editbrand.php?brandId=<?php echo $row['brandId']?>&brandName=<?php echo $row['brandName']?>">Edit</a> || <a onclick="return confirm('Are you sure to delete this brand')" href="?dbrandId=<?php echo $row['brandId']?>">Delete</a></td>
						</tr>
		<?PHP				
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

