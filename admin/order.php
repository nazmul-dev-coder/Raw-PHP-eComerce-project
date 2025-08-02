<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Orders</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Email</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                        <?php
                        $sql="select * from tbl_order where status=0 order by orderId";
                        $result=$db->select($sql);
                        if($result){
                        $i=0;
                        while($row=$result->fetch_assoc()){
                            $i++;
                        ?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $row["email"];?></td>
							<td><a  href="orderdetails.php?void=<?php echo $row['orderId'];?>">View</a></td>
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
