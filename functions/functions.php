<Doctype html>
    <html>
        <head>
<!--<link rel="stylesheet" type="text/css"href="css font_awesome/all.min.css"> -->
        </head>

<?php
//Connection with Database
$connection=mysqli_connect("localhost","root","","LPGSYSTEM"); //servername,username,password,DBname

function getCategory() //Getting the category straight from the database
{
    global $connection;
    $get_category = "select * from weight"; //sqlquerry

    $run_category = mysqli_query($connection,$get_category); //running querry

    while($category=mysqli_fetch_array($run_category)) //retrieves all records in the database, so we are selectig the database and running it
    {
        $category_id = $category['category_id'];
        $category_name = $category['category_name'];


        echo "<li><a href= '#'>$category_name</a></li>";

    }
}

function getWeight()
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

function display(){
    global $connection; //connection
    $curr = "shillings";
    $cart = "<i class='fa-solid fa-cart-shopping'></i>";



    $display ="select * from products order by RAND() LIMIT 0,6"; //selecting 6 products to randomly show on the home page

    $display_run = mysqli_query($connection,$display);
    
    while($fetch_row=mysqli_fetch_array($display_run)){ //while loop to fetch the data that we need from the DB by fetching array of display run
        //fetching the needed data from the table
        $display_id = $fetch_row['gas_id'];//id field
        $display_name = $fetch_row['gas_name'];//name field
        $display_comapny = $fetch_row['gas_company'];//company field
        $display_weight = $fetch_row['gas_weight'];//weight field
        $display_price = $fetch_row['gas_price'];//price field
        $display_image = $fetch_row['gas_image'];//image field

        echo "<div id='dislay_onegas'>
        <h2>$display_name</h2>
       <img style= border:1px solid black src = 'images/$display_image' width='250' height='250'/>
        <!-- we are getting the images folder and getting the images in the database saved as a local variable --> 
        <p><b>$display_price $curr</b></p> 
        <br>
         <a href = 'index.php'>$cart  Add to cart</a>

         <style>
         border_img {
           
           padding: 18px 18px 2px 18px;
           border: 8px solid #999999;
           margin: 50px;
        
         }
       </style>
       
        
        </div>";


        
    }


}


?>

</html>
</Doctype

