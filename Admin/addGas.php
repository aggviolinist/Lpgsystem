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
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> 
  
<script>tinymce.init({selector:'textarea'});</script>
    
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
                    <input type="text" name="gas_name"/>
                
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
                <td style=font-size:20px;>
                    Gas Cylinder company
                </td>
                <td colspan="18px">
                <select name="gas_company">
                        <option>Choose gas company</option>  
                        <?php
                         $get_products = "select * from products"; //sqlquerry

                         $run_products = mysqli_query($connection,$get_products); //running querry
             
                                         
                         while($product=mysqli_fetch_array($run_products)) //retrieves all records in the database, so we are selectig the database and running it
                        {
                         $gas_id = $product['gas_id'];
                         $gas_name = $product['gas_name'];
                                  
                                  
                         echo "<option value='$gas_id'>$gas_name</option>";
                                  
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
                    <input type="file" name="gas_image"/>
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
                    <textarea name="gas_description" cols="30" rows="5"></textarea>
                </td>
            </tr>
            <tr>
                <td style=font-size:20px;>
                    Gas Cylinder keywords
                </td>
                <td colspan="18px">
                    <input type="text" name="gas_keywords"/>

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