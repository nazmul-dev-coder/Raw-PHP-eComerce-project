<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
$catNamep='';
$catId="";
if(isset($_GET['catId']) & isset($_GET['catName'])){
    $catId=mysqli_real_escape_string($db->link,$_GET['catId']);
    $catNamep=mysqli_real_escape_string($db->link,$_GET['catName']);
if($catId=="" || $catNamep==""){
    echo "<script>window.location='catlist.php'</script>";
}
}else{
    echo "<script>window.location='catlist.php'</script>";
}
?>


<?php
if(isset($_POST['update']) & $_SERVER['REQUEST_METHOD']=='POST'){
    $catName=mysqli_real_escape_string($this->db->link,$_POST['catName']);
    //echo "<script>alert()</script>";
    if($catName==null){
        $msg='<span style=" color:red">Field must not be empty</span>';
    // }elseif($catName==$catNamep){
    //     $msg='<span style=" color:red">You have to change the value</span>';
    }
    
    else{
        $catName=$helper->validation($catName);
        $query="update tbl_catagory set
        catName='$catName' 
        where catId='$catId'
        ";
        $result=$db->update($query);
        if($result){
            $msg='<span style=" color:green">Catagory updated successfully</span>';
            $finalvalue=$catName;
            $catNamep=$catName;
        }
    }
   
}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
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
                                <input type="text" name='catName' value="<?php
                                if(!isset($finalvalue)){
                                    if(isset($catNamep)) echo $catNamep;
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