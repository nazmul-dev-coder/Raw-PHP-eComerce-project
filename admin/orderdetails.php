<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    if(isset($_GET['soid']) and $_GET['soid'] !=null){
        $soid=$_GET['soid'];
        $sql="update  tbl_order set status=1 where orderId=$soid";
        $result=$db->update($sql);
    }
    if(isset($_GET['doid']) and $_GET['doid'] !=null){
        $doid=$_GET['doid'];
        $sql="delete from tbl_order  where orderId=$doid";
        $result=$db->delete($sql);
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Message</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
                        <?php
                        if(isset($_GET['void']) and $_GET['void'] !=null){
                            $void=$_GET['void'];
                            $sql="select tbl_order.orderId, tbl_order.productName,tbl_order.image,tbl_order.date,tbl_order.price,tbl_order.quantity,tbl_customer.* from tbl_order inner join tbl_customer on tbl_order.customerId=tbl_customer.customerId where orderId=$void";
                            $result=$db->select($sql);
                            if($result){
                                while($row=$result->fetch_assoc()){
                        ?>
                        <tr>
							<td> Customer Name:</td>
                            <td><?php echo $row['customerName'];?></td>
                        </tr>
                        <tr>
                            <td> City:</td>
                            <td><?php echo $row['city'];?></td>
                        </tr>
                        <tr>
                            <td> Email:</td>
                            <td><?php echo $row['email'];?></td>
                        </tr>
                        <tr>
                            <td> Zipcode:</td>
                            <td><?php echo $row['zipCode'];?></td>
                        </tr>
                        <tr>
                            <td> Address:</td>
                            <td><?php echo $row['address'];?></td>
                        </tr>
                        <tr>
                            <td> Country:</td>
                            <td><?php echo $row['country'];?></td>
                        </tr>
                        <tr>
                            <td> Phone:</td>
                            <td><?php echo '0'.$row['phone'];?></td>
                        </tr>
                        <tr>
                            <td> Product Name:</td>
                            <td><?php echo $row['productName'];?></td>
                        </tr>
                        <tr>
                            <td> Image:</td>
                            <td><img src="upload/<?php echo $row['image'];?>" alt=""></td>
                        </tr>
                        <tr>
                            <td> Order Date:</td>
                            <td><?php echo $row['date'];?></td>
                        </tr>
                        <tr>
                            <td> Price:</td>
                            <td><?php echo $row['price'];?></td>
                        </tr>
                        <tr>
                            <td> Quantity:</td>
                            <td><?php echo $row['quantity'];?></td>
                        </tr>
                        <tr>
                            <td>Action</td>
                            <td ><a class='btn' onclick="return confirm('Are you sure product is shifted?')" href="?soid=<?php echo $row['orderId'];?>">Shift </a><a onclick="return confirm('Are you sure to cancel this order?')" class='btn' href="?doid=<?php echo $row['orderId'];?>">Cancel</a></td>
                        </tr>
                        <?php
                                }
                            }
                        }else{
                            echo "<script>window.location='order.php'</script>";
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