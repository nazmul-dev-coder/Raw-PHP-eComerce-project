<?php
$file=realpath(dirname(__FILE__));
include_once "$file/../helper/helper.php";
include_once "$file/../config/config.php";
include_once "$file/../lib/database.php";
?>
<?php
class card{
private $db;
private $helper;

public function __construct(){
    $this->db=new database();
    $this->helper=new helper();
}

public function addToCard($data){
    $sId= session_id();
    $productId=mysqli_real_escape_string($this->db->link,$data['productId']);
    $quantity=mysqli_real_escape_string($this->db->link,$data['quantity']);
    $query ="select * from tbl_cart where productId='$productId' and sId='$sId'";
    $result=$this->db->select($query);
    if($result){
        echo "<script>
        alert('Product already included to card')
        </script>";
    }else{
    $query="select * from tbl_product where productId='$productId'";
    $result=$this->db->select($query)->fetch_assoc();
    if($result){


    
    $productName=$result['productName'];
    $price      =$result['price'];
    $image      =$result['image'];

    if($quantity <1){
        $quantity =1;
    }


    $query ="insert into tbl_cart (sId,productId,productName,price,quantity,image ) values('$sId','$productId','$productName','$price','$quantity','$image' )";

    $result=$this->db->insert($query);
    if($result){
        return;
    }

}else{
    echo "<script>window.location='index.php'</script>";
}
    }

}

public function getCardList(){
    $sId=session_id();
    $query="select * from tbl_cart where sId='$sId'";
    $result=$this->db->select($query);
    return $result;
}

public function updateToCard($data){
    $sId=session_id();
    $cartId=mysqli_real_escape_string($this->db->link,$data['cartId']);
    $quantity=mysqli_real_escape_string($this->db->link,$data['quantity']);
    //echo $cartId;
    if($quantity <1){
        $query="delete from tbl_cart where cartId=$cartId and sId='$sId'";
        $result=$this->db->delete($query);
    }else{
        $query="update tbl_cart
        set
        quantity=$quantity
        where
        cartId=$cartId and sId='$sId'
        ";
        $result=$this->db->update($query);
       
            return $result;
        
     }
 }
public function delateCardItem($dcartId){
    $dcartId=mysqli_real_escape_string($this->db->link,$dcartId);
    //echo  $dcartId;
     $sId=session_id();
    $query="delete from tbl_cart where cartId='$dcartId' and sId='$sId' ";
    $result=$this->db->delete($query);
    if($result){
        return;
    }
}

public function getCardInformation(){
    $sId=session_id();
    $query="select * from tbl_cart where sId='$sId'";
    $result=$this->db->select($query);
    return $result;
    
}

public function deleteCardData(){
    $sId=session_id();
    $sql="delete from tbl_cart where sId='$sId'";
    $result=$this->db->delete($sql);
    return $result;
}

}
?>