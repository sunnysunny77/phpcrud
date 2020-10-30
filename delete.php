<?php

    include 'config/database.php';
  
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
    $stmt = $mysqli -> prepare("DELETE FROM products WHERE id = ?");
    $stmt -> bind_param("i", $id);     
    if($stmt->execute()){
       
        header('Location: index.php?action=deleted');
    }else{
        die('Unable to delete record.');
    }

    $stmt -> close();
    $mysqli -> close();
?>