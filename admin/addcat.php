<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
if(isset($_POST['submit']) & $_SERVER['REQUEST_METHOD']=='POST'){
    $catName=mysqli_real_escape_string($db->link,$_POST['catName']);
    //echo "<script>alert()</script>";
    if($catName==null){
        $msg='<span style=" color:red">Field must not be empty</span>';
    }else{
        $query="INSERT INTO tbl_catagory(catName) VALUES('$catName') ";
        $result=$db->insert($query);
        if($result){
            $msg='<span style=" color:green">Catagory inserted successfully</span>';
        }
    }
   
}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
                <?PHP
                if(isset($msg)){
                    echo $msg;
                }
                ?>
               <div class="block copyblock"> 
                 <form  action="" method='post'>
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name='catName' placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>