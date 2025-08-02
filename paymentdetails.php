<?php
include_once 'common/header.php';

$value=session::get("customerLogin");
if($value!=true){
	header("Location:login.php");
}
?>
<style>
    .payment{
        margin:2rem 0px;
        padding:1rem;
        font-size:2.5rem;
        background:#80dd7bbf;
        color:black;
        border-radius:1rem;

    }
</style>
<?php
if(isset($_GET['order']) && $_GET['order']=='order'){
    $order=$or->makeOrder();
}

// if(!isset($_GET['live'])){
// 	echo '<meta http-equiv="refresh"content=0;url=paymentdetails.php?live=0>';

// }
?>
<div style="font-size:50px">Payment Details</div>

<div class="payment">
Congratulation you make order payment of 
$
<?php 
$order=$or->getOderData();
if($order){
    $price=0;
    $total=0;
    while($row=$order->fetch_assoc()){
        $price=$row['price']*$row['quantity'];
        $total+=$price;
    }
    echo $total+$total*0.1;
}
?>
(includes VAT) Method:COD <a href="orderdetails.php">Click here</a> to get more information about your order
</div>

<?php
include_once 'common/footer.php';
?>