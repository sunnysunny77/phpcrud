<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Read Records - PHP CRUD Tutorial</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>
 
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Read Products</h1>
        </div>

        <?php            
            include 'config/database.php';

            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $records_per_page = 5;
            $from_record_num = ($records_per_page * $page) - $records_per_page;       

            $action = isset($_GET['action']) ? $_GET['action'] : "";

            if($action=='deleted'){
                echo "<div class='alert alert-success'>Record was deleted.</div>";
            }

            echo "<a href='create.php' class='btn btn-primary m-b-1em'>Create New Product</a>";

            $stmt = $mysqli -> prepare("SELECT id, name, description, price FROM products ORDER BY id DESC LIMIT ?,?");
            $stmt -> bind_param("dd", $from_record_num,  $records_per_page);
            $stmt->execute();  
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo "<table class='table table-hover table-responsive table-bordered'>";
                        echo "<tr>";
                            echo "<th>ID</th>";
                            echo "<th>Name</th>";
                            echo "<th>Description</th>";
                            echo "<th>Price</th>";
                            echo "<th>Action</th>";
                        echo "</tr>";
                        while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['name']}</td>";
                            echo "<td>{$row['description']}</td>";
                            echo "<td>&#36;{$row['price']}</td>";
                            echo "<td>";
                                echo "<a href='read_one.php?id={$row['id']}' class='btn btn-info m-r-1em'>Read</a>";
                                echo "<a href='update.php?id={$row['id']}' class='btn btn-primary m-r-1em'>Edit</a>";
                                echo "<a href='#' onclick='delete_user({$row['id']});'  class='btn btn-danger'>Delete</a>";
                            echo "</td>";
                        echo "</tr>";
                        }
                echo "</table>";
            }else {
                echo "<div class='alert alert-danger'>No records found.</div>";
            }
            $result -> free_result();
            $stmt -> close();
            $result = $mysqli -> query("SELECT COUNT(*) as total_rows FROM products");
            $row = $result->fetch_assoc();
            $total_rows = $row['total_rows'];
            $page_url="index.php?";
            include_once "paging.php";
            $result -> free_result();           
            $mysqli -> close();
        ?>

    </div> <!-- end .container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
<script type='text/javascript'>
    // confirm record deletion
    function delete_user( id ){

var answer = confirm('Are you sure?');
if (answer){
    // if user clicked ok, 
    // pass the id to delete.php and execute the delete query
    window.location = 'delete.php?id=' + id;
} 
}
</script>

</body>
</html>




