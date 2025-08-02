<?php
include_once "../config/config.php";
include_once "../lib/database.php";
include_once "../lib/session.php";
include_once "../helper/helper.php";
include_once "../classes/mail.php";
$slide=1;
?>

<?php
$db=new Database();
$session=new session();
$helper=new helper();
$email='';
$id='';
if(isset($_GET['email']) && isset($_GET['id']))
{
    $email=$_GET['email'];
    $id=$_GET['id'];
    $slide=0;
}
$msg='';
$mail=new mail();
if(isset($_POST['Search']) && $_SERVER['REQUEST_METHOD']=='POST'){
    
    $email=$_POST['email'];
    if($email== '') {$msg="Email must not be empty";}
    else{
    $sql="select * from tbl_admin where adminEmail='$email'";
    $result=$db->select($sql);
    if($result){
    $rand=rand(100000,1000000);
    $msmail=$mail->sendMail('nazmulhasan32.nzh@gmail.com',$email,'mggaivgblkppshhb',$rand);
    setcookie("adminOtp", $rand, time() + (60 * 5)); // 60 seconds ( 1 minute) * 20 = 20 minutes
    $adminId=$result->fetch_assoc()['adminId'];
    header("Location:forgetout.php?email=$email&id=$adminId");
        } else {$msg="Email doesnt found";}
        
    }
}


if(isset($_POST['otpsend']) && $_SERVER['REQUEST_METHOD']=='POST'){
	$otp=mysqli_real_escape_string($db->link,$_POST['otpverify']);
    $newpass=mysqli_real_escape_string($db->link,$_POST['newpass']);
	if($otp=='' or $newpass==''){
		$msg= 'Field must not be empty!';
		
	}else if(isset($_COOKIE['adminOtp']) && $_COOKIE['adminOtp'] == $_POST['otpverify']){
        $newpass=md5($newpass);
        //$id=session::get('adminID');
		$sql="update tbl_admin set adminPass='$newpass' where adminId=$id and adminEmail='$email'";
        $resultch=$db->update($sql);
        if($resultch){
            echo 
                 "
                    <script>
                        alert('password changed succesfully please re-login');
                        window.location='login.php';
                    </script>
            
                 ";
                // session::destroy();
        }
        else  {
            $msg="Password doesnt change";
        }
       
	}else {
        $msg="otp doesnt match";
    }



}

?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Forget password</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
        <?php if($slide){?>
		<form action="forgetout.php" method="post">
			<h1>Forget password</h1>
			<span style="color:red;">
			<?php
			if (isset($msg)){
				echo $msg;
			}
			?>
			</span>
			<div>
				<input type="text"  placeholder="Enter email"  name="email"/>
			</div>
			<div>
				<input type="submit" name="Search" value="Search" />
			</div>
		</form><!-- form -->
        <?php }else {?>

            <form action="" method="post">
			<h1>Verify OTP</h1>
			<span style="color:red;">
			<?php
			if (isset($msg)){
				echo $msg;
			}
			?>
			</span>
			<div>
				<input type="text"  placeholder="Enter otp"  name="otpverify"/>
			</div>
            <div>
				<input type="text"  placeholder="Enter new password"  name="newpass"/>
			</div>
			<div>
				<input type="submit" name="otpsend" value="Verify" />
			</div>
		</form><!-- form -->
        <div class="button">
			<span>Otp sended to <?php echo $email;?> </span>
		</div><!-- button -->

            <?php }?>
		
	</section><!-- content -->
</div><!-- container -->
</body>
</html>