<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
if(isset($_GET['mvid']) and $_GET['mvid'] !=null){
	$mvid=$_GET['mvid'];
	$sql="update tbl_message set status =1 where id=$mvid";
	$result=$db->update($sql);
	if($result){
		echo "<script>window.location='messageview.php?mvid=$mvid'</script>";
	}
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Message</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sql="select * from tbl_message where status=0 order by id desc";
						$result=$db->select($sql);
						if($result){
							$i=0;
							while($row=$result->fetch_assoc()){
								$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $helper->textShorten($row['text'],50)?></td>
							<td><a href="?id=<?php echo $row['id']?>">Delete</a>|| <a href="?mvid=<?php echo $row['id']?>">View</a></td>
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
