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


    $display ="select * from products order by RAND() LIMIT 0,6"; //selecting 6 products to randomly show on the home page

    $display_run = mysqli_query($connection,$display);
    
    while($fetch_row=mysqli_fetch_array($display_run)){ //while loop to fetch data from the DB by fetching array of display run

        $display_id = $fetch_row['gas_id'];//id field
        $display_name = $fetch_row['gas_name'];//name field
        $display_comapny = $fetch_row['gas_company'];//company field
        $display_weight = $fetch_row['gas_weight'];//weight field
        $display_price = $fetch_row['gas_price'];//price field
        $display_description = $fetch_row['gas_description'];//description field
        $display_image = $fetch_row['gas_image'];//image field
        $display_keywords = $fetch_row['gas_keywords'];//keywords field


        
    }


}


?>

