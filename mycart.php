<DOCTYPE html>
 <?php
 include("functions/functions.php"); //includes specific folders and files into html

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
    <li><a href="cart.php">Cart</a></li>
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
        //total_in_the_cart();
    ?>
        <div style="width: 800px; height: 40px;background-color: lawngreen; padding-left: 700px; margin:right:100px; margin-left:250px;"><!--shopping cart -->
          <span style="float:left; text-align: center; font-size: 18px; padding:5px; line-height:40px">
          Welcome User!
          </span>
          <i style='padding:18px;'class="fa-solid fa-cart-shopping"></i><a style='text-decoration:none;color:blue' href="cart.php">Cart has <?php
        total_gas_in_the_cart();?>gases </a> 
        <span>Please pay: <?php total_sum_in_cart(); ?> Shillings</span>


        </div>

        <div id="sidebar">  <!--side div -->
        <div>
            <ul id="siddy">
            <li><i class="fa-solid fa-house-user"></i><a href="index.php">Dashboard</a></li><br>
            <li><i class="fa-solid fa-cart-shopping"></i><a href="cart.php">Cart</a></li><br>
            <li><i class="fa-solid fa-calendar-check"></i><a href="allgases.php">Book cylinder</a><li padding-right:10px;><?php getWeight(); ?></li></li><br> 
            <li><i class="fa-solid fa-user"></i><a href="customer_account.php">My account</a></li><br>
            <li><i class="fa-solid fa-power-off"></i><a href="#">Log out</a></li>
       
        </ul>
        
        </div>

        </div>
        <div id= "content_area" ><!--content area div -->

        <form action="" method="post" enctype="multipart/form-data">
            <table align="center" width="1600" bgcolor="white">
            <tr align="right">
                
                <th><i class="fa-solid fa-trash" style=padding:10px></i>Remove from cart</th>
                <th>Gas cylinder(s)</th>
                <th>Quantity</th>
                <th><i class="fa-thin fa-square-dollar"></i>Total price</th>
            </tr>
            <?php
            $total = 0;

            $ip = getIP();

            $total_cart = "select * from cart where ip_addresses='$ip'";

            $run_total_cart = mysqli_query($connection,$total_cart);

            while($fetch_cart = mysqli_fetch_array($connection,$run_total_cart))
            {
                $display_cylinderID = $fetch_cart['cylinder_id'];

                $select_price = "select * from products where gas_id = '$display_cylinderID'";
                $run_fetch_price = mysqli_query($connection,$select_price);

                while($fetch_content = mysqli_fetch_array($connection,$run_fetch_price))
                {
                    $all_gas_prices = array($fetch_content['gas_price']);
                    $run_all_gas_prices = array_sum($all_gas_prices);
                    $total_prices  = $total+=$run_all_gas_prices;

                    $get_gas_name = $fetch_content['']

                
                }
            }
            echo $total_prices;

            ?>
            </table>
        </form>
      
        <div id="display"> <!--calling the display function --->
        <?php 
        //echo $ip = getIP()
        ?>

            <?php
            //display_index();
            ?>
            <?php categorize_weight();?>
         </div>
        </div> 

      </div>
         <div id ="footer" style=padding-top:30px;>Kelvin Mulandi &copy; All Rights Reserved</div> <!--footer div -->

</body>

</html>
