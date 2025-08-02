<?php
include_once "../config/config.php";
include_once "../lib/database.php";
include_once "../lib/session.php";
include_once "../helper/helper.php";
include_once "../classes/mail.php";
?>

<?php
$db=new Database();
$session=new session();
$helper=new helper();
$msg='';
session::init();
session::checksession();
$mail=new mail();
$email=session::get('adminEmail');
if(isset($_GET['sendOtp'])){
 
    $rand=rand(100000,1000000);
    $msmail=$mail->sendMail('nazmulhasan32.nzh@gmail.com',$email,'mggaivgblkppshhb',$rand);
    setcookie("adminOtp", $rand, time() + (60 * 5)); // 60 seconds ( 1 minute) * 20 = 20 minutes
    header("Location:forget.php");
}


if(isset($_POST['otpsend']) && $_SERVER['REQUEST_METHOD']=='POST'){
	$otp=mysqli_real_escape_string($db->link,$_POST['otpverify']);
    $newpass=mysqli_real_escape_string($db->link,$_POST['newpass']);
	if($otp=='' or $newpass==''){
		$msg= 'Field must not be empty!';
		
	}else if(isset($_COOKIE['adminOtp']) && $_COOKIE['adminOtp'] == $_POST['otpverify']){
        $newpass=md5($newpass);
        $id=session::get('adminID');
		$sql="update tbl_admin set adminPass='$newpass' where adminId=$id";
        $resultch=$db->update($sql);
        if($resultch){
            echo 
                 "
                    <script>
                        alert('password changed succesfully please re-login');
                    </script>
            
                 ";
                 session::destroy();
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
	</section><!-- content -->
</div><!-- container -->
</body>
</html>