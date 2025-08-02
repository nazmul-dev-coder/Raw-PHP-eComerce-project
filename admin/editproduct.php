<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>

<?php
$pd=new product();
if(isset($_GET['productId'])){
    $productId=mysqli_real_escape_string($db->link,$_GET['productId']);
}else{
    echo "<script>window.location='productlist.php'</script>";
}

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
    $result=$pd->updateProduct($_POST,$_FILES,$productId);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
    <?php

        if(isset($result)){
            echo $result;
        }
    ?>
        <div class="block">  
            <?php
            $result=$pd->getProduct($productId);
            if(isset($result)){
                while($value=$result->fetch_assoc()){
             
            ?>             
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?PHP echo $value['productName'];?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <option>Select Category</option>
                        <?php

                        $query="select * from tbl_catagory";
                        $result=$db->select($query);
                        if($result){
                        while($row=$result->fetch_assoc()){
                          
                       
                        ?>
                            <option <?php 
                        
                        if($value['catId']==$row['catId']){
                            echo "selected='selected'";
                        }
                        
                        ?>  value="<?php echo $row['catId']?>"><?php echo $row['catName']?></option>
                        <?php
                         }
                              }
                        ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>Select Brand</option>
                            <?php

                    $query="select * from tbl_brand";
                    $result=$db->select($query);
                    if($result){
                    while($row=$result->fetch_assoc()){
                    

                    ?>
                        <option  <?php 
                        
                        if($value['brandId']==$row['brandId']){
                            echo "selected='selected'";
                        }
                        
                        ?> value="<?php echo $row['brandId']?>"><?php echo $row['brandName']?></option>
                    <?php
                    }
                        }
                    ?>                         
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="body" class="tinymce">
                        <?PHP echo $value['body'];?>

                        </textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input name='price' type="text" value="<?PHP echo $value['price'];?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img style="height:80px;width:60px;margin-top:10px" src="upload/<?php echo $value['image']?>">
                        <br/>
                        <input name="image" type="file" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <option <?php
                            if($value['type']==1){
                                echo "selected='selected'";
                            }
                            ?> value="1">Featured</option>
                            <option
                            <?php if($value['type']==2){
                            echo "selected='selected'";
                            }
                            ?>
                            value="2">General</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
            <?php 
                   
                }
            }
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


