<?php include '../classes/mail.php';?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>



<div class="grid_10">
    <?php
        if(isset($_GET['repid']) and $_GET['repid'] !=null){
            $adminEmail=session::get('adminEmail');
            $repid=$_GET['repid'];
            $sql="select email,name from tbl_message where id=$repid";
            $result=$db->select($sql);
            if($result){
                while($row=$result->fetch_assoc()){
          
    ?>
<?php
if (isset($_POST["submitMsg"])) {
   if($_POST['body']==''){
    $msmail="<span style='color:red'>Field must not be empty!</span>";
   }else{
    $mail=new mail();
    $msmail=$mail->sendMail('nazmulhasan32.nzh@gmail.com',$row['email'],'mggaivgblkppshhb',$_POST['body']);
   }
}
?>
    <div class="box round first grid">
        <h2>Message repley</h2>
        <div class="block">  
            <?php
            if(isset($msmail)){
                if($msmail==1){
                    echo "
                    <script>
                    alert('Mail sent successfully');
                    window.location='index.php'
                    </script>
                    ";
                }else{
                    echo $msmail;
                }

            }
            ?>             
         <form method='post' action=''>
            <table class="form">					
                <tr>
                    <td>
                        <label>To</label>
                    </td>
                    <td>
                        <input disabled type="Email" value="<?php echo $row['email'];?>"  name="title" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>From</label>
                    </td>
                    <td>
                        <input disabled value="<?php echo $adminEmail;?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="body" class="tinymce"></textarea>
                    </td>
                </tr>
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" class="btn" name="submitMsg" Value="Send" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
    <?php
                  
                }
            }
    
    ?>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
 <?php }else {
    echo "<h1 style='color:white;margin:auto;text-align:center;'>NO host founded....</h1>";
 }
 
 ?>
<?php include 'inc/footer.php';?>