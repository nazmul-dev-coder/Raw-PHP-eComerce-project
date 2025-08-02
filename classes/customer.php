<?php
$file=realpath(dirname(__FILE__));
include_once "$file/../helper/helper.php";
include_once "$file/../config/config.php";
include_once "$file/../lib/database.php";
?>
<?php
class customer{
private $db;
private $helper;

public function __construct(){
    $this->db=new database();
    $this->helper=new helper();
}

public function addNewCustomer($data){
    $customerName=mysqli_real_escape_string($this->db->link,$data['customerName']);
    $city=mysqli_real_escape_string($this->db->link,$data['city']);
    $zipCode=mysqli_real_escape_string($this->db->link,$data['zipCode']);
    //$email=$this->helper->validation($data['email']);
    $email=mysqli_real_escape_string($this->db->link,$data['email']);
    //return $email;
    $address=mysqli_real_escape_string($this->db->link,$data['address']);
    $country=mysqli_real_escape_string($this->db->link,$data['country']);
    $phone=mysqli_real_escape_string($this->db->link,$data['phone']);
    $password=$data['password'];

    if($customerName=='' or $city=='' or $zipCode=='' or $email=='' or $address=='' or $country==''or $phone==''or $password==''){
       $error='<span class="error">Field must not be empty</span>';
   }elseif(strlen($password) <6){
    $error='<span class="error">Password shuold be minimum six digit</span>';
   }
   
   else{
    $sql="select * from tbl_customer where email='$email'";
    $result=$this->db->select($sql);
       if($result){
       $error='<span class="error">Email already exist</span>';
       }else {
        $password=md5($password);
           $sql="insert into tbl_customer(customerName,city,zipCode,email,address,country,phone,password) values('$customerName','$city','$zipCode','$email','$address','$country','$phone','$password')";
           $result=$this->db->insert($sql);
           if($result){
               $error='<span class="success">User added succesfully please login</span>';
           }else{
            $error='<span class="success">User doesnt added</span>';
            header("location:login.php");
           }
       }
    
   }
   
  

   if(isset($error)){
       return $error;
   }else{return false;}
}

public function checkLogIn($data){
    $email=mysqli_real_escape_string($this->db->link,$data['email']);
    $password=$data['password'];

if($email=='' or $password==''){
   $error='<span class="error">Field must not be empty</span>';
}else{
    $password=md5($password);
    $sql="select * from tbl_customer where email='$email' and password='$password'";
    $result=$this->db->select($sql);
    if($result){
        $row=$result->fetch_assoc();
        //session::init();
        session::set('customerLogin',true);
        session::set('customerId',$row['customerId']);
        session::set('customerName',$row['customerName']);
        session::set('customerEmail',$row['email']);
        header("location:order.php");
    }else{
        $error='<span class="error">Email and password dont match</span>';
    }
}

if(isset($error)){
    return $error;
}
}

public function getCustomer(){
    $customerId=session::get('customerId');
    $query="select * from tbl_customer where customerId=$customerId";
    $result=$this->db->select($query);
    return $result;
}

public function updateCustomer($data){
    $customerId=session::get('customerId');
    $customerName=mysqli_real_escape_string($this->db->link,$data['customerName']);
    $city=mysqli_real_escape_string($this->db->link,$data['city']);
    $zipCode=mysqli_real_escape_string($this->db->link,$data['zipCode']);
    //$email=$this->helper->validation($data['email']);
    $email=mysqli_real_escape_string($this->db->link,$data['email']);
    //return $email;
    $address=mysqli_real_escape_string($this->db->link,$data['address']);
    $country=mysqli_real_escape_string($this->db->link,$data['country']);
    $phone=mysqli_real_escape_string($this->db->link,$data['phone']);

    if($customerName=='' or $city=='' or $zipCode=='' or $email=='' or $address=='' or $country==''or $phone==''){
       $error='<span class="error">Field must not be empty</span>';
   } else{
    $sql="select * from tbl_customer where email='$email' and customerId=$customerId";
    $result=$this->db->select($sql);
       if($result){
        $sql="update tbl_customer SET
         customerName='$customerName',
         city='$city',
         zipCode='$zipCode',
         address='$address',
         country='$country',
         phone='$phone'
         where customerId=$customerId
        ";
        $result=$this->db->insert($sql);
        if($result){
            $error='<span class="success">User updated succesfully</span>';
        }else{
         $error='<span class="error">User doesnt updated</span>';
        }
       
       }else {
        $sql="select * from tbl_customer where email='$email'";
        $result=$this->db->select($sql);
           if($result){
          $error='<span class="error">Email already exist</span>';
       }else{
        $sql="update tbl_customer SET
        customerName='$customerName',
        city='$city',
        zipCode='$zipCode',
        email='$email',
        address='$address',
        country='$country',
        phone='$phone'
        where customerId=$customerId
       ";
       $result=$this->db->insert($sql);
       if($result){
           $error='<span class="success">User updated succesfully</span>';
       }else{
        $error='<span class="error">User doesnt updated</span>';
       }
       }
    
   }
   
  
   }

   if(isset($error)){
       return $error;
   }else{return false;}


}
}