<?php
include_once "../config/config.php";
include_once "../lib/database.php";
include_once "../lib/session.php";
include_once "../helper/helper.php";
?>

<?php
$db=new Database();
$session=new session();
$helper=new helper();
$msg='';
session::init();
session::checklogin();

if(isset($_POST['adminLogin']) & $_SERVER['REQUEST_METHOD']=='POST'){
	$adminUser=mysqli_real_escape_string($db->link,$_POST['adminUser']);
	$adminPass=mysqli_real_escape_string($db->link,$_POST['adminPass']);
	//echo $adminPass;

	if($adminUser=='' || $adminPass==''){
		$msg= 'Field must not be empty!';
		
	}else{
		$adminPass=md5($adminPass);
		 $sql="SELECT * FROM tbl_admin WHERE adminUser='$adminUser' and adminPass='$adminPass'";
		 //echo $sql;
		$result=$db->select($sql);
		if($result){
			//$msg='congratulation you are logged in';
			$row=$result->fetch_assoc();
			session::init();
			session::set('login',true);
			session::set('adminUser',$adminUser);
			session::set('adminName',$row['adminName']);
			session::set('adminEmail',$row['adminEmail']);
			session::set('adminID',$row['adminId']);
			//echo session::get('adminName');
			header("Location:index.php");
		}else{
			$msg="Password doesn't match try <a href='forgetout.php'>recover</a> your password";
		}
	}



}

?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<span style="color:red;">
			<?php
			if (isset($msg)){
				echo $msg;
			}
			?>
			</span>
			<div>
				<input type="text" value='nazmul' placeholder="Username"  name="adminUser"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="adminPass"/>
			</div>
			<div>
				<input type="submit" name="adminLogin" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>