<!DOCTYPE html>
<?php
$connection=mysqli_connect("localhost","root","","LPGSYSTEM");


/**$host = "127.0.0.1"; //IP of your database
$userName = "root"; //Username for database login
$userPass = ""; //Password associated with the username
$database = "LPGSYSTEM"; //Your database name

$connectQuery = mysqli_connect($host,$userName,$userPass,$database);

if(mysqli_connect_errno()){
    echo mysqli_connect_error();
    exit();
}else{
    $selectQuery = "SELECT * FROM Category";
    $result = mysqli_query($connectQuery,$selectQuery);
    if(mysqli_num_rows($result) > 0){
    }else{
        $msg = "No Record found";
    }
}**/

?> 

<head>
    <title>Adding Gas Cylinder</title>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> <!--script for tinymce  --> 
  
<script>tinymce.init({selector:'textarea'});</script> <!-- targets text area field and makes it look good -->

    
</head>
<body bgcolor="#ff9a00">
    <div>
    <form action="addGas.php" method="post" enctype="multipart/form-data"><!--inserts videos,images in a form -->
        <table align="center" width="1500" bgcolor="#CDB99C">
            <tr align="center"><!--table rows -->

            <td colspan="18px"><!--table columns -->
            <h2>Add New Gas Cylinder here</h2>
            </td>
            </tr>
            <tr> <!-- Every tr has 2 td tags  -->
                <td style=font-size:20px;>
                    Gas Cylinder Name 
                </td>
                <td colspan="18px">
                    <input type="text" name="gas_name" required/>
                
                </td>             
            </tr>
            <tr>
                <td style=font-size:20px;>Gas Cylinder weight</td>
                 <td>
                    <select name="gas_weight">
                        <option>Choose gas weight</option>  
                        <?php
                         $get_category = "select * from Category"; //sqlquerry

                         $run_category = mysqli_query($connection,$get_category); //running querry
             
                                         
                         while($category=mysqli_fetch_array($run_category)) //retrieves all records in the database, so we are selectig the database and running it
                        {
                         $category_id = $category['category_id'];
                         $category_name = $category['category_name'];
                                  
                                  
                         echo "<option value='$category_id'>$category_name</option>";
                                  
                          }
                         
                        ?>                    
                    </select>         
                 </td>
                
            </tr>
            <tr>
                <td style=font-size:20px;>Gas Cylinder company</td>
                <td colspan="18px">
                <select name="gas_company">
                        <option>Choose gas company</option>  
                        <?php
                         $get_gas = "select * from brand"; //sqlquerry

                         $run_gas = mysqli_query($connection,$get_gas); //running querry
             
                                         
                         while($gas=mysqli_fetch_array($run_gas)) //retrieves all records in the database, so we are selectig the database and running it
                        {
                         $brand_id = $gas['brand_id'];
                         $brand_name = $gas['brand_name'];
                                  
                                  
                         echo "<option value='$brand_id'>$brand_name</option>";
                                  
                          }
                         
                        ?>                    
                    </select>    
                    
                </td>
            </tr>
            <tr>
                <td style=font-size:20px;>
                    Gas Cylinder image
                </td>
                <td colspan="18px">
                    <input type="file" name="gas_image"/> <!--file type for image -->
                </td>
            </tr>
            <tr>
                <td style=font-size:20px;>
                    Gas Cylinder price
                </td>
                <td colspan="18px">
                    <input type="text" name="gas_price"/>
                </td>
            </tr>
            <tr>
                <td style=font-size:20px;>
                    Gas Cylinder description
                </td>
                <td colspan="18px">

                    <textarea name="gas_description" cols="20" rows="3"></textarea><!--text area with columns and rows i.e size of the box -->
                </td>
            </tr>
            <tr>
                <td style=font-size:20px;>
                    Gas Cylinder keywords
                </td>
                <td colspan="18px">
                    <input type="text" name="gas_keywords" size="80"/>

                </td>
            </tr>
            <tr align="center">
               <td colspan="7">
                <input type="submit" name="insert_post" value="Add Gas"/>
               </td>
            </tr>
        
        </table>
    </form>
    </div>

</body>
</html>


<?php

if(isset($_POST['insert_post'])){

    //how to get text from the form

    $gas_name = $_POST['gas_name'];
    $gas_weight = $_POST['gas_weight'];
    $gas_company = $_POST['gas_company'];
    $gas_price = $_POST['gas_price'];
    $gas_description = $_POST['gas_description'];
    $gas_keywords = $_POST['gas_keywords'];


    //how to get images from the form 
    

    $gas_image = $_FILES['gas_image']['name'];//the field we want i.e name, we dont want size,type
    $gas_image_tmp = $_FILES['gas_images']['tmp_name'];//we need temporary name for system

    $add_gas = "";



}



?>