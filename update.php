<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Update a Record - PHP CRUD Tutorial</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Update Product</h1>
        </div>
     
        <?php

             include 'config/database.php';
     
             $stmt = $mysqli -> prepare("SELECT id, name, description, price FROM products WHERE id = ? LIMIT 1");
             $stmt -> bind_param("i", $id);  
             $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');           
             $stmt->execute();
             $result = $stmt->get_result();
             $row = $result->fetch_assoc();
             $name = $row['name'];
             $description = $row['description'];
             $price = $row['price'];             
             $stmt -> close();
             $mysqli -> close();      
        ?>

<?php
    if($_POST){

    include 'config/database.php';

    $stmt = $mysqli -> prepare("UPDATE products SET name = ?, description = ?, price= ? WHERE id = ?");
    $stmt -> bind_param("ssdi", $name, $description, $price, $id); 
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $description = htmlspecialchars(strip_tags($_POST['description'])); 
    $price = htmlspecialchars(strip_tags($_POST['price']));  

    if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was updated.</div>";       
    } else {
            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
    }    

    $stmt -> close();
    $mysqli -> close();  
    } 
?>

 
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type='text' name='price' value="<?php echo htmlspecialchars($price, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <a href='index.php' class='btn btn-danger'>Back to read products</a>
                    </td>
                </tr>
            </table>
        </form>
         
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>