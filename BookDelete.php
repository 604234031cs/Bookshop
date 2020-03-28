<?php 
    require 'config.php'; 
    $bookdel = $_GET['delbook'];
    // echo $bookdel;
    $sql = "DELETE FROM books WHERE BookName = '$bookdel'";
    $stm = $connection->prepare($sql);
    if($stm->execute()){
        header("refresh:2;BookList.php"); 
    }else{
        echo "Error";
    }
?>

