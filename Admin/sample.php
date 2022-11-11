<!DOCTYPE html>
<?php
include("includes/db.php");
include("functions/functions.php");

?> 

<head>
    <title>Adding Gas Cylinder</title>
    
</head>
<body bgcolor="#ff9a00">
    <div>
    <form action="addGas.php" enctype="multipart/form-data"><!--inserts videos,images in a form -->
        <table align="center" width="1500" bgcolor="#CDB99C">
            <tr align="center"><!--table rows -->

            <td><!--table columns -->
            <h2>Add New Gas Cylinder here</h2>
            <form>
            <select>
                        <option>Choose gas weight</option>  
                        <?php
                        getWeight();
                        ?>                    
                    </select> 
                    </form>
            </td>
            </tr>
            <tr>
                <td>
                    Gas Cylinder image
                </td>
                <td>
                    <input type="text"/>
                </td>
            </tr>
            <tr> <!-- Every tr has 2 td tags  -->
                <td>
                    Gas Cylinder Name 
                </td>
                <td>
                    <input type="text"/>
                
                </td>             
            </tr>
            
        
        </table>
    </form>
    </div>

</body>
</html>