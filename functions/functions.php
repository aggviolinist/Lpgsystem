<Doctype html>
    <html>
        <head>
<!--<link rel="stylesheet" type="text/css"href="css font_awesome/all.min.css"> -->
        </head>

<?php
//Connection with Database
$connection=mysqli_connect("localhost","root","","LPGSYSTEM"); //servername,username,password,DBname

function getWeight() //Getting the category straight from the database
{
    global $connection;
    $get_weight = "select * from weight"; //sqlquerry

    $run_weight = mysqli_query($connection,$get_weight); //running querry

    while($weight=mysqli_fetch_array($run_weight)) //retrieves all records in the database, so we are selectig the database and running it
    {
        $weight_id = $weight['weight_id'];
        $cylinder_weight = $weight['cylinder_weight'];


        echo "<li><a href= 'index.php'>$cylinder_weight</a></li>";

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

    if(!isset($_GET['weight'])){//if the weight is not active
        if(!isset($_GET['company'])){//if the company of the gas is not active

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
         <a style='text-decoration:none; float:none;color: blue' href = 'index.php?page_id=$display_id'>$cart  Add to cart</a>  
        </div>";
    }

    }
}
}
function display_description()
{
if(isset($_GET['page_id'])){ //get gas id from DB line 77

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
?>

</html>
</Doctype

