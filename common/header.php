<?php
  //set headers to NOT cache a page
  header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
//   Date in the past
//   or, if you DO want a file to cache, use:
//   header("Cache-Control: max-age=2592000"); 
// 30days (60sec * 60min * 24hours * 30days)
?>
<?PHP
$file=realpath(dirname(__FILE__));
include_once "$file/../helper/helper.php";
include_once "$file/../config/config.php";
include_once "$file/../lib/database.php";
include_once "$file/../classes/product.php";
include_once "$file/../classes/card.php";
include_once "$file/../lib/session.php";
include_once "$file/../classes/customer.php";
include_once "$file/../classes/order.php";

?>
<?php
session::init();
$db=new database();
$helper=new helper();
$pd=new product();
$cd=new card();
$cs=new customer();
$or=new order();
?>

<?php
if(isset($_GET['logout'])){
	$result=$cd->deleteCardData();
	session_destroy();
	session_unset();
	header('location:index.php');
}
?>

<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="./css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="./js/jquerymain.js"></script>
<script src="./js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="./js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="./js/nav.js"></script>
<script type="text/javascript" src="./js/move-top.js"></script>
<script type="text/javascript" src="./js/easing.js"></script> 
<script type="text/javascript" src="./js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<style>
 .error{color:red} .success{color:green;} .register_account form input[type="text"]{color:#444}
</style>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form>
				    	<input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
							<?php
							$result=$cd->getCardInformation();
							if($result){
								$price=0;
								$qnty=0;
								while($row=$result->fetch_assoc()){
									$qprice=$row['price']*$row['quantity'];
									$price +=$qprice;
									$qnty+=$row['quantity'];
								}
							?>
								<span class="cart_title">Cart</span>
								<span style="font-size:0.8rem;" class="no_product">($<?php echo $price;?> | Q:<?php echo $qnty;?>)</span>
								<?php
										
										
									}else{ ?>
										<span class="c art_title">Cart</span>
										<span class="no_product">(empty)</span>
								<?php

									}
								?>
						</a>
					</div>
			    </div>

				<?php
				$sessionValue=session::get('customerLogin');
				if($sessionValue!=true){

				?>

		   <div class="login"><a href="login.php">Login</a></div>
		   <?php
				}else{

			
		   ?>
		<div class="login"><a href="?logout">Logout</a></div>
		   <?php
		   	}
		   ?>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="products.php">Products</a> </li>
	  <li><a href="topbrands.php">Top Brands</a></li>

	 			 <?php
					$result=$cd->getCardInformation();
					if($result){
									
									?>
					<li><a href="cart.php">Cart</a></li>
					<?php
							}	
				?>

				<?php

					$sessionValue=session::get('customerLogin');
					if($sessionValue==true){

					$result=$or->getMyOrder();
					if($result){
									
									?>
					<li><a href="orderdetails.php">Orders</a></li>
					<?php
							}	
						}
				?>


	      <?php
				$sessionValue=session::get('customerLogin');
				if($sessionValue==true){

				?>
	 		 <li><a href="profile.php">Profile</a></li>
			<?php
						}

					
				?>

	  <li><a href="contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>