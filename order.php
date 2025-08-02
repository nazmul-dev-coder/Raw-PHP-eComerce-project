<?php
include_once 'common/header.php';

$value=session::get("customerLogin");
if($value!=true){
	header("Location:login.php");
}
?>
<style>
    .order{
        padding:6rem;
        margin:auto;
        font-size: 5rem;
        text-align: center;
        justify-content: center;
    }
    .table{
        text-align: center;
        justify-content: center;
        margin: auto;
    }
    .link1{
        padding:0px 1rem;
        display: block;
        color:white;
        background: red;
        margin: 0px 0.7rem;
        border-radius:1rem;
        
    }
    .link2{
        padding:0px 1rem;
        display: block;
        color:white;
        background: red;
        border-radius:1rem;
        
    }
</style>
<div style="font-size:50px">Payment Method</div>
<div class="order">
    <table class="table">
        <tr>
            <td><a href="codpayment.php" class="link1">COD</a></td>
            <td><a href="onlinepayment.php" class="link2">Online</a></td>
        </tr>
    </table>
</div>
<?php
include_once 'common/footer.php';
?>