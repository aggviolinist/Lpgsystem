<?php
include("includes/db.php");
include("functions/functions.php");
?>
<div>
    <form method="post" action="">
        <table width="500" align="center" bgcolor="#ADD8E6">
            <tr align="center">
                <td colspan="10"><h2>Register and login to make your booking!!!!</h2></td>
            </tr>
            <tr colspan="10">
                <td align="right"><br><b>Email:</b></td>
                <td><br><input type="text" name="email" placeholder="enter your email" required /></td>
            </tr>
            <tr colspan="100"><!--colspan matches the extra td's-->
                <td align="right"><br><b>Password:</b></td>
                <td><br><input type="password" name="password" placeholder="enter your password"/></td>
            </tr>
            <br>
            <tr>
                <br>
                <td align="right" colspan="1"><br><input type="submit" name="login" value="login" required /></td>
                <br>
            </tr>
            
            <tr>
                <td align="right" colspan="2"><a href="checkout.php?forgot_passwd">Forgot Password?</a></td> <!-- ?forgot_passwd is a get variable -->
            </tr>
            
        </table>
        <h3 style="float:right; padding:15px;"><a href="customer_signup.php" style="text-decoration:none">Welcome, please Sign Up Here</a></h3>

    </form>
</div>

<?php
if(isset($_POST['login']))
{
    $c_email = $_POST['email'];
    $c_pass = $_POST['password'];

    $selection_db = "select * from customers where customer_email='$c_email' AND customer_passwd='$c_pass'";

    $run_selection_db = mysqli_query($connection,$selection_db);

    $check_selection_customer = mysqli_num_rows($run_selection_db);

    if($check_selection_customer==0)
    {
        echo "<script>alert('credentials are incorrect, please try again')</script>";
    }

    $ip = getIp();

    $select_from_cart = "select * from cart where ip_address='$ip'";

    $run_cart_selection = mysqli_query($connection,$select_from_cart);

    $check_cart_selection = mysqli_num_rows($run_cart_selection);

    if($check_selection_customer>0 AND $check_cart_selection==0)
    {
        
    }
}


?>