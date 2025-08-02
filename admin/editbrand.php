<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
$brandNamep='';
$brandId="";
if(isset($_GET['brandId']) & isset($_GET['brandName'])){
    $brandId=mysqli_real_escape_string($db->link,$_GET['brandId']);
    $brandName=mysqli_real_escape_string($db->link,$_GET['brandName']);
    $brandNamep=mysqli_real_escape_string($db->link,$_GET['brandName']);
if($brandId=="" || $brandNamep==""){
    echo "<script>window.location='catlist.php'</script>";
}
}else{
    echo "<script>window.location='catlist.php'</script>";
}
?>


<?php
if(isset($_POST['update']) & $_SERVER['REQUEST_METHOD']=='POST'){
    $brandName=mysqli_real_escape_string($db->link,$_POST['brandName']);
    //echo "<script>alert()</script>";
    if($brandName==null){
        $msg='<span style=" color:red">Field must not be empty</span>';
    // }elseif($catName==$catNamep){
    //     $msg='<span style=" color:red">You have to change the value</span>';
    }
    
    else{
        $brandName=$helper->validation($brandName);
        $query="update tbl_brand set
        brandName='$brandName' 
        where brandId='$brandId'
        ";
        $result=$db->update($query);
        if($result){
            $msg='<span style=" color:green">Catagory updated successfully</span>';
            $finalvalue=$brandName;
            //$catNamep=$catName;
        }
    }
   
}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Brand</h2>
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
                                <input type="text" name='brandName' value="<?php
                                if(!isset($finalvalue)){
                                    if(isset($brandNamep)) echo $brandNamep;
                                }else{
                                    echo $finalvalue;
                                }
                                 
                                 
                                 ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="update" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>