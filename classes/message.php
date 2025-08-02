<?php
$file=realpath(dirname(__FILE__));
include_once "$file/../helper/helper.php";
include_once "$file/../config/config.php";
include_once "$file/../lib/database.php";
?>
<?php
class message{
private $db;
private $helper;

public function __construct(){
    $this->db=new database();
    $this->helper=new helper();
}

public function addmessage($data){
    $name=mysqli_real_escape_string($this->db->link,$data['name']);
    $email=mysqli_real_escape_string($this->db->link,$data['email']);
    $text=mysqli_real_escape_string($this->db->link,$data['text']);
    $phone=mysqli_real_escape_string($this->db->link,$data['number']);

    if($name=='' or $email=='' or $phone==''or $text==''){
       $error='<span style="color:red;">Field must not be empty</span>';
   }else{
    $sql="insert into tbl_message (name,email,number,text)values('$name','$email','$phone','$text')";
    $result=$this->db->insert($sql);
    if($result){
        $error='<span style="color:green;">Message send successfully</span>';
    }
   }
   

   if(isset($error)){
       return $error;
   }else{return false;}
}

}

