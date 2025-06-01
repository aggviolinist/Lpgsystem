<Doctype html>
    <html>
        <head>
<!--<link rel="stylesheet" type="text/css"href="css font_awesome/all.min.css"> -->
        </head>

<?php
//Connection with Database
$connection=mysqli_connect("localhost"," "," ","farmstore"); //servername,username,password,DBname
if(mysqli_connect_errno()) //default function if there is an error record
{
    echo "No connection to the Database:".mysqli_connect_error(); //if there is an errorr or connection wasnt established with the database 

}

function getWeight() //Getting the category straight from the database
{
    global $connection;
    $get_weight = "select * from weight"; //select sqlquerry

    $run_weight = mysqli_query($connection,$get_weight); //running querry

    while($weight=mysqli_fetch_array($run_weight)) //retrieves all records in the database, so we are selectig the database and running it
    {
        $weight_id = $weight['weight_id'];
        $cylinder_weight = $weight['cylinder_weight'];


        echo "<li><a href= 'index.php?weight=$weight_id'>$cylinder_weight</a></li>";//the link has the index page, gets the isset variable from function display
                                                                                      //_index and finally the variable weight id receiving data from database "weight_id" from function getweight
                                                                               //Links here pick their own id
    }
}
/** 
function getWeightNull()
{  
            global $connection;

            $get_category = "select * from weight"; //sqlquerry

            $run_category = mysqli_query($connection,$get_category); //running querry

                            
            while($category=mysqli_fetch_array($run_category)) //retrieves all records in the database, so we are selectig the database and running it
           {
            $category_id = $category['category_id'];
            $category_name = $category['category_name'];
                     
                     
            echo "<option>.$category_name.</option>";
                     
             }
            
                        
}
**/

function display_index(){

    if(!isset($_GET['weight'])){//if the weight is not active displays blank
    if(!isset($_GET['company'])){//if the company of the gas is not active displays blank

    global $connection; //connection
    $curr = "shillings";
    $cart = "<i class='fa-solid fa-cart-shopping'></i>";
    $display ="select * from products order by RAND() LIMIT 0,8"; //selecting 6 products to randomly show on the home page

    $display_run = mysqli_query($connection,$display);
    
    while($fetch_row=mysqli_fetch_array($display_run)){ //while loop to fetch the data that we need from the DB by fetching array of display run
        //fetching the needed data from the table
        $display_id = $fetch_row['gas_id'];//id field
        $display_name = $fetch_row['gas_name'];//name field
        $display_company = $fetch_row['gas_company'];//company field
        $display_weight = $fetch_row['gas_weight'];//weight field
        $display_price = $fetch_row['gas_price'];//price field
        $display_image = $fetch_row['gas_image'];//image field

        echo "<div id='dislay_onegas'>
        <h2>$display_name</h2>
       <img style='border:3px solid #FFE5B4; margin:30px;' src = 'images/$display_image' width='250' height='250'/>
        <!-- we are getting the images folder and getting the images in the database saved as a local variable --> 
        <p><b>$display_price $curr</b></p> 
        <br>
        <a href = 'description.php?page_id=$display_id' style='text-decoration:none; color: green'>Gas Description</a>
        <a style='text-decoration:none; float:none;color: blue' href = 'index.php?add_to_cart=$display_id'>$cart  Add to cart</a>  
        </div>";
    }

    }
}
}
//****************************php to detect ip address of user**********************************************/
function getIP()
{
    $user_ip = $_SERVER['REMOTE_ADDR']; //default php function saved in loal variable

    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $user_ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif(!empty($_SERVER['HTTP_X_FORWARDED FOR']))
    {
        $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $user_ip;
}

//****************************php to detect ip address of user**********************************************/
//**********************************************Shoppping Cart********************************************/
function cart()
{
    if(isset($_GET['add_to_cart']))//once a person clicks the add_to_cart button brings specific product id line 86.......
    {
        //php to get cart
        global $connection;

        $ip = getIP(); //saved the above ip function in a local variable
        $get_id = $_GET['add_to_cart'];//this get method has a value and it transfers it to get_id

        $check_if_gas_exists = "select * from cart where ip_address='$ip' AND cylinder_id='$get_id'";//statement to avoid duplication coz there is another record

        $run_cart = mysqli_query($connection,$check_if_gas_exists);

        if(mysqli_num_rows($run_cart)>0)//number of gases or records in the table is greater than 0, refresh the page and do nothing
        {
            echo "";

        }
        else  //if the table is empty then insert a record of a gas
        {
            $insert_gas = "insert ignore into cart(cylinder_id,ip_address) values('$get_id','$ip')";
            $run_insert = mysqli_query($connection,$insert_gas); //running the select query

            echo "<scrip>window.open('index.php','_self')</script>";//refresh the page and go back to the index.php
            echo '<script>alert("Gas Cylinder added successfully ")</script>';
        }
    }
}
/**********************************************FIN**********************************************************************/

/**THE FUNCTION BELOW IS NEVER CALLED ITS JUST FOR REFERENCE**/
function display_description()
{
if(isset($_GET['page_id'])){ //get gas id from DB line 70

    $get_id = $_GET['page_id']; //variable get method to get variable from url address bar

$display = "select * from products where gas_id = '$get_id'"; //select everything from products if the id coming is same as the gas id so we get all entries of a specific gas
$display_run = mysqli_query($connection,$display);

while($fetch_row=mysqli_fetch_array($display_run))
{
    $display_id = $fetch_row['gas_id'];
    $display_name = $fetch_row['gas_name'];
    $display_weight = $fetch_row['gas_weight'];
    $display_price = $fetch_row['gas_price'];
    $display_image = $fetch_row['gas_iamge'];
    $display_description = $fetch_row['gas_description'];

    echo "<div id='dislay_onegas'>
        <h2>$display_name</h2>
       <img style='border:3px solid #FFE5B4; margin:30px;' src = 'images/$display_image' width='400' height='300'/>
        <!-- we are getting the images folder and getting the images in the database saved as a local variable --> 
        <p><b>$display_price $curr</b></p> 
        <br>
        <a href = 'index.php'style='text-decoration:none; color: green'>Back</a>
         <a style='text-decoration:none; float:none;color: blue' href = 'index.php?page_id=$display_id'>$cart  Add to cart</a>  
        </div>";

}
}
}
/************************Function to choose a weight and if not available to display to user****************************/
function categorize_weight(){

    if(isset($_GET['weight'])){//if the weight is not active displays blank
    $weight_id = $_GET['weight'];//we are getting the post assocaited with this weight 
    global $connection; //connection
    $curr = "shillings";
    $cart = "<i class='fa-solid fa-cart-shopping'></i>";

    $choose_weight ="select * from products where gas_weight='$weight_id'"; //selecting products that has the value in gas_weight table same as the weight_id valiue picked by isset

    $show_weight = mysqli_query($connection,$choose_weight);

    $count_weight = mysqli_num_rows($show_weight);//counts number of rows in table
    

    if($count_weight==0)
    {
   
    echo "<h2 style='margin-left:500px'> The weight you chose is not available in our records, please choose another weight </h2>";
    }
    
    while($fetch_weight_row=mysqli_fetch_array($show_weight)){ //while loop to fetch the data that we need from the DB by fetching array of display run
        //fetching the needed data from the table
        $display_id = $fetch_weight_row['gas_id'];//id field
        $display_name = $fetch_weight_row['gas_name'];//name field
        $display_company = $fetch_weight_row['gas_company'];//company field
        $display_weight = $fetch_weight_row['gas_weight'];//weight field
        $display_price = $fetch_weight_row['gas_price'];//price field
        $display_image = $fetch_weight_row['gas_image'];//image field

        echo "<div id='dislay_onegas'>
        <h2>$display_name</h2>
       <img style='border:3px solid #FFE5B4; margin:30px;' src = 'images/$display_image' width='250' height='250'/>
        <!-- we are getting the images folder and getting the images in the database saved as a local variable --> 
        <p><b>$display_price $curr</b></p> 
        <br>
        <a href = 'description.php?page_id=$display_id' style='text-decoration:none; color: green'>Gas Description</a>
         <a style='text-decoration:none; float:none;color: blue' href = 'index.php?page_id=$display_id'>$cart  Add to cart</a>  
        </div>";
    }

    }
}
/****************************************FIN******************************************************************************************* */
/**********************************************Getting the total items in the cart*************************************************** */
function total_gas_in_the_cart()
{
    if(isset($_GET['add_cart']))//getting active url variable from the html
    {
        global $connection;

        $ip = getIP();

        $get_gas = "select * from cart where ip_address='$ip'";
        $run_cart = mysql_query($connection,$get_gas);

        $count_cart = mysqli_num_rows($run_cart);

    
    }
    else
    {
        global $connection;
        $ip = getIP();

        $get_gas = "select * from cart where ip_address='$ip'";

        $run_cart = mysqli_query($connection,$get_gas);

        $count_cart = mysqli_num_rows($run_cart);

    }
     echo $count_cart;

}

/****************************************************************FIN********************************************************************/
/******************************************************Total price in the cart****************************************************** */

function total_sum_in_cart()
{
    $total_prices = 0; //initiating the price to 0.
    global $connection;
    $ip = getIP();

    $total_cart = "select * from cart where ip_address = '$ip'";//querry to select the ip on the cart table

    $run_total_cart = mysqli_query($connection,$total_cart);

    while($fetch_cart=mysqli_fetch_array($run_total_cart))//there are many ip addresses selected, so this while loop fetches each one by one ,being specific

     {
        $display_cylinderID = $fetch_cart['cylinder_id']; //we need id from the table detected using the while loop

        $fetch_price = "select * from products where gas_id = '$display_cylinderID' "; //selecting from another table!!!!!!!!!!!!!!!So we are matching the id to the price on products table //taking data from 2 tables
        $run_fetch_price = mysqli_query($connection,$fetch_price);
        
        //$execute_run_fetch_price = mysqli_run_fetch_price($run_fetch_price);
        while($execute_run_fetch_price=mysqli_fetch_array($run_fetch_price))
        {
            
           /******$gas_price = fetch_gas_price['gas_price']; *****/
           //the prices of the gases are in one array so we'll be selecting each one by one 1500,1200,1000
           $all_gas_prices = array($execute_run_fetch_price['gas_price']);//all gas prices are in one array so easily accessed.
           $sum_all_gas_prices = array_sum($all_gas_prices);//array_sum is a function that finds the sum of all the array components


           $total_prices+=$sum_all_gas_prices;


        }

     }
     echo $total_prices;
}


?>
</html>
</Doctype

