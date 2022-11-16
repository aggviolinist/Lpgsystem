<!DOCTYPE html>
<?php
$connection=mysqli_connect("localhost","root","","LPGSYSTEM");
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
                         $get_category = "select * from weight"; //sqlquerry

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
                    <input type="text" name="gas_price" required />
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
                    <input type="text" name="gas_keywords" size="80" required/>

                </td>
            </tr>
            <tr align="center">
               <td colspan="7">
                <input type="submit" name="add_gas_post" value="Add Gas"/>
               </td>
            </tr>
        
        </table>
    </form>
    </div>

</body>
</html>


<?php

if(isset($_POST['add_gas_post'])){

    //how to get text from the form

    $gas_name = $_POST['gas_name'];
    $gas_company = $_POST['gas_company'];
    $gas_weight = $_POST['gas_weight'];  
    $gas_price = $_POST['gas_price'];
    $gas_description = $_POST['gas_description'];
    $gas_keywords = $_POST['gas_keywords'];


    //how to get images from the form 
    
    $gas_image = $_FILES['gas_image']['name'];//the field we want i.e name, we dont want size,type
    $gas_image_tmp = $_FILES['gas_image']['tmp_name'];//we need temporary name for system

    move_uploaded_file($gas_image_tmp,"gas_images/$gas_image"); //temporary name file in server,folder,variable used above

    $add_gas = "insert into products(gas_name,gas_company,gas_weight,gas_price,gas_description,gas_image,gas_keywords) values('$gas_name','$gas_company','$gas_weight','$gas_price','$gas_description','$gas_image','$gas_keywords')";
    $insert_gas = mysqli_query($connection,$add_gas); //inserting data in DB 

    if($insert_gas){
        echo "<script>alert('gas has been added successfully to the database')</script>"; //alert notification
        echo "<script>window.open('addGas.php','_self')</script>"; //refresh the page by redirecting the page to the add gas page if there is any double entry on table
    }
    else{
        echo "<script>alert('gas has not been added successfully to the database')</script>";
    }
    






}



?>