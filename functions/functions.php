<Doctype html>
    <html>
        <head>
<!--<link rel="stylesheet" type="text/css"href="css font_awesome/all.min.css"> -->
        </head>

<?php
//Connection with Database
$connection=mysqli_connect("localhost","root","","LPGSYSTEM"); //servername,username,password,DBname
if(mysqli_connect_errno()) //default function if there is an error record
{
    echo "No connection to the Database:".mysqli_connect_error(); //if there is an errorr or connection wasnt established with the database 

}

function getWeight() //Getting the category straight from the database
{
    global $connection;
    $get_weight = "select * from weight"; //sqlquerry

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
         <a style='text-decoration:none; float:none;color: blue' href = 'index.php?page_id=$display_id'>$cart  Add to cart</a>  
        </div>";
    }

    }
}
}
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

function categorize_weight(){

    if(isset($_GET['weight'])){//if the weight is not active displays blank
    $weight_id = $_GET['weight'];//we are getting the post assocaited with this weight 
    global $connection; //connection
    $curr = "shillings";
    $cart = "<i class='fa-solid fa-cart-shopping'></i>";



    $choose_weight ="select * from products where gas_weight='$weight_id'"; //selecting products that has the value in gas_weight table same as the weight_id valiue picked by isset

    $show_weight = mysqli_query($connection,$choose_weight);

    $count_weight = mysqli_num_rows($show_weight);
    

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


?>

</html>
</Doctype

