<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Message</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
                        <?php
                        if(isset($_GET['mvid']) and $_GET['mvid'] !=null){
                            $mvid=$_GET['mvid'];
                            $sql="select * from tbl_message where id=$mvid";
                            $result=$db->select($sql);
                            if($result){
                                while($row=$result->fetch_assoc()){
                        ?>
                        <tr>
							<td>Name:</td>
                            <td><?php echo $row['name'];?></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><?php echo $row['email'];?></td>
                        </tr>
                        <tr>
                            <td>Phone:</td>
                            <td><?php echo $row['number'];?></td>
                        </tr>
                        <tr>
                            <td> Message:</td>
                            <td><?php echo $row['text'];?></td>
                        </tr>
                        <tr>
                            <td>Action</td>
                            <td class='btn btn-primary'><a href="messagerepley.php?repid=<?php echo $row['id'];?>">Repley</a></td>
                        </tr>
                        <?php
                                }
                            }
                        }else{
                            echo "<script>window.location='inbox.php'</script>";
                        }
                        ?>		
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