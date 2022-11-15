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
?>

