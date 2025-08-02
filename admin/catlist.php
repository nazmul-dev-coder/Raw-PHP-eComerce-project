<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
if(isset($_GET['dcatId'])){
	$dcatId=mysqli_real_escape_string($db->link,$_GET['dcatId']);
	if($dcatId != null){
		$query="delete from tbl_catagory where catId='$dcatId'";
		$result=$db->delete($query);
		if($result){
			$msg='<span style=" color:green">Catagory deleted successfully</span>';
		}else{
			header("Location:catlist.php");
		}
	}
}
?>

<?PHP
$query='select * from tbl_catagory order by catId desc';
$result=$db->select($query);
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
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
							<th>Category Name</th>
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
							<td><?PHP echo $row['catName'];?></td>
							<td><a href="editcat.php?catId=<?php echo $row['catId']?>&catName=<?php echo $row['catName']?>">Edit</a> || <a onclick="return confirm('Are you sure to delete this catagory')" href="?dcatId=<?php echo $row['catId']?>">Delete</a></td>
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

