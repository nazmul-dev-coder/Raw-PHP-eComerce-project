<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>

<?php
$pd=new product();

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
    $resultp=$pd->insertProduct($_POST,$_FILES);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
    <?php
        if(isset($resultp)){
             echo $resultp;
        }
    ?>
        <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" placeholder="Enter Product Name..." class="medium" />
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
                            <option value="<?php echo $row['catId']?>"><?php echo $row['catName']?></option>
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
                        <option value="<?php echo $row['brandId']?>"><?php echo $row['brandName']?></option>
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
                        <textarea name="body" class="tinymce"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input name='price' type="text" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
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
                            <option value="1">Featured</option>
                            <option value="2">General</option>
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


