<?php include '../classes/mail.php';?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    if(isset($_POST['updPass'])){
        $oldpass=$_POST['oldpass'];
        $newpass=$_POST['newpass'];
        if($oldpass=='' or $newpass==''){
            $chmass="<span style='color:red;'>Field must not be empty</span>";
        }else{
            $adminid=session::get('adminID');
            $sql="select * from tbl_admin where adminId=adminid";
            $result=$db->select($sql);
            $result=$result->fetch_assoc();
            $dpass=$result['adminPass'];
            $adminEmail=$result['adminEmail'];
            $oldpass=md5($oldpass);
            $newpass=md5($newpass);
            if($oldpass != $dpass){
                $chmass="<span style='color:red;'>Password doesn't match try <a style='color:green;text-decoration: underline' href='forget.php?sendOtp'>recover</a> your password</span>";
            }else{
                $mail=new mail();
                $sql="update tbl_admin set adminPass='$newpass' where adminId=$adminid";
                $resultup=$db->update($sql);
                if($resultup){
                    $chmass="<span style='color:green;'>Password updated successfully</span>";
                    session::destroy();
                    echo "<script>window.location='login.php'</script>";
                }
            }
        }
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <div class="block">
            <?php
                if(isset($chmass)){
                    echo $chmass;
                }
            ?>               
         <form action='' method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter Old Password..."  name="oldpass" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter New Password..." name="newpass" class="medium" />
                    </td>
                </tr>
				 
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="updPass" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>