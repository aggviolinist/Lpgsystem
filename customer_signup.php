<DOCTYPE html>
 <?php
 session_start();
 include("functions/functions.php"); //includes specific folders and files into html
 include("includes/db.php");

 //ini_set("display_errors","1");
 //ini_set("display_startup_errors","1");
 //error_reporting(E_ALL);
 ?>
    <head>
    <title>BOOK A CYLINDER</title>
    <link rel="stylesheet" href="css/style.css" media="all"> <!--Linking relationship stylesheet with hypertext reference on all kind of devices -->
    <link rel="stylesheet" type="text/css"href="css font_awesome/all.min.css"><!--font awesome link-->

</head>
<body>
<div class= "main_wrapper"> <!--css class-->
    <div class = "header_wrapper"> <!--header div -->
    <img id= "lpg" src = "images/dial.png" />  <!--image source-->
    <img style='margin-left: 250px;'id= "logo"src = "images/run.jpg"/>
    </div>
</div>
<div class="menubar"> <!--menu div -->
<ul id="menu">
    <li><a href="index.php">Home</a></li>
    <li><a href="allgases.php">Book Cylinder</a></li>
    <li><a href="mycart.php">Cart</a></li>
    <li><a href="login.php">Log in</a></li>
    <li><a href="signup.php">Sign up</a></li>
</ul>
<div id="form">
    <form method="get" action="search_gas.php" enctype="mutlipart/form-data"><!--Multitype  used when getting images from DB-->
    <input style= 'margin-left:220px;' type="text" name="user_text" placeholder="what are you looking for?"/>
    <input type="submit" name="search" value="find gas cylinder" />
    </form> 
</div>
</div> 

     <div class="content_wrapper">
     <?php
        cart();
    ?>
        <div style="width: 800px; height: 40px;background-color: lawngreen; padding-left: 700px; margin:right:100px; margin-left:250px;"><!--shopping cart -->
          <span style="float:left; text-align: center; font-size: 18px; padding:5px; line-height:40px">
          Welcome User!
          </span>
          <i style='padding:18px;'class="fa-solid fa-cart-shopping"></i><a style='text-decoration:none;color:blue' href="mycart.php">My Cart</a>


        </div>

        <div id="sidebar">  <!--side div -->
        <div>
            <ul id="siddy">
            <li><i class="fa-solid fa-house-user"></i><a href="index.php">Dashboard</a></li><br>
            <li><i class="fa-solid fa-cart-shopping"></i><a href="mycart.php">Cart</a></li><br>
            <li><i class="fa-solid fa-calendar-check"></i><a href="allgases.php">Book cylinder</a><li padding-right:10px;><?php //getWeight(); ?></li></li><br> 
            <li><i class="fa-solid fa-user"></i><a href="customer_account.php">My account</a></li><br>
            <li><i class="fa-solid fa-power-off"></i><a href="#">Log out</a></li>
       
        </ul>
        
        </div>

        </div>
        <div id= "content_area" ><!--content area div -->
        <form action="customer_signup.php" method="post" enctype="multipart/form-data">
            <table align="center" width="2000">
                <tr lign="center">
                    <th colspan="1"><h2>Create Account</h2></th>
                </tr>
                <tr>
                    <td align="right"><b>Name:</b></td>
                    <td><input type="text" name="c_name" required/> </td>
                </tr>
                <tr>
                    <td align="right"><b>Email</b></td>
                    <td><input type="text" name="c_email" required/></td>
                </tr>
                <tr>
                    <td align="right"><b>Password:</b></td>
                    <td><input type="password" name="passwd" required/></td>
                </tr>
                <tr>
                    <td align="right"><b>Confirm Password:</b></td>
                    <td><input type="password" name="confirm_passwd" required/></td>
                </tr>
                <tr>
                    <td align="right"><b>Phone number:</b></td>
                    <td><input type="number" name="mobile_no" required/></td>
                </tr>
                <tr>
                    <td align="right"><b>Image:</b></td>
                    <td><input type="file" name="image" required/></td>
                </tr>
                <tr>
                    <td align="right"><b>Country:</b></td>
                    <td>
                        <select name="country">
                            <option>Select a Country</option>
                            <option>Kenya</option>
                            <option>Uganda</option>
                            <option>Tanzania</option>
                            <option>Rwanda</option>
                            <option>Burundi</option>
                            <option>Malawi</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right"><b>City:</b></td>
                    <td><input type="text" name="city" required/></td>
                </tr>
                <tr align="center">
                    <td colspan="6"><input type="submit" name="sign_up" value="Create Account" /></td>
                </tr>
            </table>
        </form>       
        </div> 

      </div>
         <div id ="footer" style=padding-top:30px;>Kelvin Mulandi &copy; All Rights Reserved</div> <!--footer div -->

</body>
</html>

<?php
if(isset($_POST['sign_up'])) //isset command and post is the method, register is the button of the submit
{
    $ip = getIP();

    $customer_name = $_POST['c_name'];
    $customer_email = $_POST['c_email'];
    $customer_password = $_POST['passwd'];
    $customer_phoneNo = $_POST['mobile_no'];
    $customer_image = $_FILES['image'] ['name'];
    $customer_image_tmp = $_FILES['image'] ['tmp_name'];
    $customer_country = $_POST['country'];
    $customer_city = $_POST['city'];


   move_uploaded_file($customer_image_tmp,"customer/customer_images/$customer_image"); //temporary name of system then exact folder where the image will be stored finally

    $insert_customer_data = "insert into customers (customer_name,customer_ip,customer_email,customer_passwd,customer_mobile_no,customer_country,customer_city,customer_image) values ('$customer_name','$ip','$customer_email','$customer_password','$customer_phoneNo','$customer_country','$customer_city','$customer_image_tmp')";

    $run_customer_data=mysqli_query($connection,$insert_customer_data);

    //if($run_customer_data)
    //{
      //  "<script>alert('can't insert data')</script>";

    //}
    $selector = "select * from cart where ip_address='$ip'";

    $run_selector = mysqli_query($connection,$selector);
    $check_selector = mysqli_num_rows($run_selector);

    if($check_cart==0) //means there is no order, customer not logged in 
    {
        $_SESSION['customer_email'] = $customer_email;
        echo "<script>alert('Registration successful')</script>";
        echo"<script>window.open('customer_login.php','_self')</script>";

    }

    else
    {
        $_SESSION['customer_email'] = $customer_email;
        echo "<scipt>alert('Please pay here')</scipt>";

        echo "<script>window.open('checkout.php','_self')</script>";
    }
}

?>