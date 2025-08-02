<?php
$file=realpath(dirname(__FILE__));
include_once "$file/../helper/helper.php";
include_once "$file/../config/config.php";
include_once "$file/../lib/database.php";
?>
<?php
class order{
private $db;
private $helper;

public function __construct(){
    $this->db=new database();
    $this->helper=new helper();
}
public function makeOrder(){
    $customerId=session::get('customerId');
    $sId=session_id();
    $email=session::get('customerEmail');
    $query="select * from tbl_cart where sId='$sId'";
    $result=$this->db->select($query);
    //VAR_DUMP($result);
    if($result){
        while($row=$result->fetch_assoc()){
            $productId=$row['productId'];
            $productName=$row['productName'];
            $image=$row['image'];
            $price=$row['price'];
            $quantity=$row['quantity'];
            
            $query="insert into tbl_order
            (customerId,productId,productName,image,email,price,quantity) 
            values('$customerId','$productId','$productName','$image','$email','$price','$quantity')
            ";
            $value=$this->db->insert($query);
           
        }

        if($value){
            $sql="delete from tbl_cart where sId='$sId'";
            $result=$this->db->delete($sql);
       }
       
       
       

    }
}
public function getOderData(){
    $customerId=session::get('customerId');
    $query="select price,quantity from tbl_order where customerId='$customerId' and date=now()";
    $result=$this->db->select($query);
    return $result;
}

public function getMyOrder(){
    $customerId=session::get('customerId');
    $query="select * from tbl_order where customerId='$customerId' and status !=2 order by orderId desc";
    $result=$this->db->select($query);
    return $result;
}

public function deleteOrder($dorderId){
     $dorderId=mysqli_real_escape_string($this->db->link,$dorderId);
     $query="select status from tbl_order where orderId='$dorderId' and status=0";
     $result=$this->db->select($query);
     if($result){
        $query="delete from tbl_order where orderId='$dorderId'";
        $value=$this->db->delete($query);
        if($value){
            return "<span class='success'>You successfully cancel a order</span>";
        }
     }else{
        return "<span class='error'>Cancel not available</span>";
     }

}

}


    
?>