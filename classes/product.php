<?php
$file=realpath(dirname(__FILE__));
include_once "$file/../helper/helper.php";
include_once "$file/../config/config.php";
include_once "$file/../lib/database.php";
?>
<?php
class product{
private $db;
private $helper;

public function __construct(){
    $this->db=new database();
    $this->helper=new helper();
}

public function insertProduct($data,$file){
    $productName=mysqli_real_escape_string($this->db->link,$data['productName']);
    $catId=mysqli_real_escape_string($this->db->link,$data['catId']);
    $brandId=mysqli_real_escape_string($this->db->link,$data['brandId']);
    $body=mysqli_real_escape_string($this->db->link,$data['body']);
    $price=mysqli_real_escape_string($this->db->link,$data['price']);
    $type=mysqli_real_escape_string($this->db->link,$data['type']);

    $fileName=$file['image']['name'];
    $fileSize=$file['image']['size'];
    $fileTemp=$file['image']['tmp_name'];
    $permited=array('jpg','jpeg','png','gif');
    $fileExt=explode('.',$fileName);
    $fileExt=end($fileExt);
    $fileExt=strtolower($fileExt);
    $unicdName=substr(md5(time()),0,10).'.'.$fileExt;


    if($fileName==''){
        $error= '<span class="error">Please select a image file</span>';
    }elseif(in_array($fileExt,$permited)==false){
        $error= '<span class="error">You can only upload '.implode(',',$permited).' files'.'</span>';
    }elseif($fileSize >2097152){
        $error= '<span class="error">File size must have to less than 2MB </span>';

    }elseif($productName=='' or $catId=='' or $brandId=='' or $body=='' or $price=='' or $type==''){
		 $error='<span class="error">Field must not be empty</span>';
	}else{
        $sql="insert into tbl_product(productName,catId,brandId,body,price,image,type) values('$productName','$catId','$brandId','$body','$price','$unicdName','$type')";
        $result=$this->db->insert($sql);
        if($result){
            move_uploaded_file($fileTemp,"upload/".$unicdName);
            $error='<span class="success">Product uploaded succesfully</span>';
        }
    }
    if(isset($error)){
        return $error;
    }
    
}

public function getAllProduct(){
    $query="SELECT tbl_product.*, tbl_catagory.catName,tbl_brand.brandName 
    FROM tbl_product
    INNER JOIN tbl_catagory 
    ON
     tbl_product.catId=tbl_catagory.catId
    INNER JOIN tbl_brand
    ON tbl_product.brandId=tbl_brand.brandId
    ORDER BY tbl_product.productId DESC
    ";
    $result=$this->db->select($query);
    if($result){
        return $result;
    }
}

public function getProduct($productId){
    $productId=mysqli_real_escape_string($this->db->link,$productId);
    $query="select * from tbl_product where productId=$productId";
    $result=$this->db->select($query);
    if($result){
        return $result;
    }
}

public function updateProduct($data,$file,$productId){
    $productId=mysqli_real_escape_string($this->db->link,$productId);
    $productName=mysqli_real_escape_string($this->db->link,$data['productName']);
    $catId=mysqli_real_escape_string($this->db->link,$data['catId']);
    $brandId=mysqli_real_escape_string($this->db->link,$data['brandId']);
    $body=mysqli_real_escape_string($this->db->link,$data['body']);
    $price=mysqli_real_escape_string($this->db->link,$data['price']);
   // $image=$this->helper->validation(mysqli_real_escape_string($this->db->link,$data['image']));
    $type=mysqli_real_escape_string($this->db->link,$data['type']);
    $fileName=$file['image']['name'];


    if($fileName==''){
       // $error= '<span class="error">Please select a image file</span>';
    
        if($productName=='' or $catId=='' or $brandId=='' or $body=='' or $price=='' or $type==''){
            return '<span class="error">Field must not be empty</span>';
        }else{
            {
                $sql="update tbl_product
                 set
                 productName='$productName',
                 catId='$catId',
                 brandId='$brandId',
                 body='$body',
                 price='$price',
                 type='$type'
                 where productId=$productId
                ";
                $result=$this->db->update($sql);
                if($result){
                    $error='<span class="success">Product updated succesfully</span>';
                }
            }
        }
    }else{

        
    
    $fileSize=$file['image']['size'];
    $fileTemp=$file['image']['tmp_name'];
    $permited=array('jpg','jpeg','png','gif');
    $fileExt=explode('.',$fileName);
    $fileExt=end($fileExt);
    $fileExt=strtolower($fileExt);
    $unicdName=substr(md5(time()),0,10).'.'.$fileExt;

    if(in_array($fileExt,$permited)==false){
        $error= '<span class="error">You can only upload '.implode(',',$permited).' files'.'</span>';
    }elseif($fileSize >2097152){
        $error= '<span class="error">File size must have to less than 2MB </span>';

    }elseif($productName=='' or $catId=='' or $brandId=='' or $body=='' or $price=='' or $type==''){
		 $error='<span class="error">Field must not be empty</span>';
	}else{
        $sql="select image from tbl_product where productId=$productId";
        $result=$this->db->select($sql);
        if($result){
            while($data=$result->fetch_assoc()){
                unlink('upload/'.$data['image']);
            }
        }
        $sql="update tbl_product
         set
         productName='$productName',
         catId='$catId',
         brandId='$brandId',
         body='$body',
         price='$price',
         image='$unicdName',
         type='$type'
         where productId=$productId
        ";
        $result=$this->db->update($sql);
        if($result){
            move_uploaded_file($fileTemp,"upload/".$unicdName);
            $error='<span class="success">Product updated succesfully</span>';
        }
    }
    }
    
 
    if(isset($error)){
        return $error;
    }
}

    public function delProduct($dproductId){
        $dproductId=mysqli_real_escape_string($this->db->link,$dproductId);
        $sql="select image from tbl_product where productId=$dproductId";
        $result=$this->db->select($sql);
        if($result){
            while($data=$result->fetch_assoc()){
                unlink('upload/'.$data['image']);
            }
        }
        $query="delete from tbl_product where productId=$dproductId";
        $result=$this->db->delete($query);
        if($result){
            return '<span class="success">Product deleted succesfully</span>';
        }
    }

    public function getFeaturedProduct(){
        $query="select * from tbl_product where type=1 order by productId desc limit 4";
        $result=$this->db->select($query);
        if($result){
            return $result;
        }
    }

    public function getNewProduct(){
        $query="select * from tbl_product order by productId desc limit 4";
        $result=$this->db->select($query);
        if($result){
            return $result;
        }
    }

    public function getPrevewProduct($productId){
        $productId=mysqli_real_escape_string($this->db->link,$productId);
        $query="SELECT tbl_product.*, tbl_catagory.catName,tbl_brand.brandName 
        FROM tbl_product
        INNER JOIN tbl_catagory 
        ON
         tbl_product.catId=tbl_catagory.catId
        INNER JOIN tbl_brand
        ON tbl_product.brandId=tbl_brand.brandId
        WHERE tbl_product.productId=$productId
        ORDER BY tbl_product.productId DESC
        ";
        $result=$this->db->select($query);
        if($result){
            return $result;
        }
    }

    public function getProductByBrand(){
        $query="SELECT tbl_product.*,tbl_brand.brandName
        FROM tbl_brand,tbl_product
        WHERE tbl_brand.brandId=tbl_product.brandId 
        GROUP BY tbl_brand.brandId
        order by tbl_brand.brandId desc LIMIT 4 
        ";
        $result=$this->db->select($query);
       
            return $result;
        
    }

    public function getProductByCat($catId){
        $catId=mysqli_real_escape_string($this->db->link,$catId);
        $query="select * from tbl_product where catId='$catId'";
        $result=$this->db->select($query);
        return $result;
    }

}


?>