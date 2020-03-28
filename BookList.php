<?php 
    require 'header.php';
    require 'config.php';
   
    $sql = "SELECT books.BookName,authors.AuthorName,categories.CategoryName,
                   publishers.PublisherName,books.BookPrice,books.BookStatus
            FROM books,authors,categories,publishers
            WHERE books.AuthorID = authors.AuthorID
            and books.CategoryID = categories.CategoryID
            and books.PublisherID = publishers.PublisherID
            ";
    $stm = $connection->prepare($sql);
    $stm->execute();
    $books = $stm->fetchAll(PDO::FETCH_ASSOC);
    
 
?>


<div>
    <title>admin</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <!-- <div class="container mt-5"> -->
        <div class="card">
            <div class="card-header">
                <h3>ข้อมูลหนังสือ</h3>
                <a href="BookAdd.php" class ="btn btn-warning"><span>เพิ่มหนังสือ</span></a>
            </div>
            <div class="card-body">
         
            <table class="table table-striped table-dark">
            <thead class="thead-dark">
            <tr>
                    <th><center><h4 style="color:DodgerBlue"> ชื่อหนังสือ</h4></center></th>
                    <th><center><h4 style="color:DodgerBlue"> ผู้แต่ง</h4> </center></th>
                    <th><center> <h4 style="color:DodgerBlue">ประเภทหนังสือ</h4> </center></th>
                    <th><center> <h4 style="color:DodgerBlue">สำนักพิมพ์</h4></center></th>
                    <th><center> <h4 style="color:DodgerBlue">ราคา</h4> </center></th>
                    <th><center> <h4 style="color:DodgerBlue">สถานะการขาย</h4></center></th>
                    <th></th>      
                </tr>
                </thead>
 
                <?php foreach($books as $book): ?>
                <tr>
                    <td><center><?php echo $book['BookName']; ?></center></td>
                    <td><center><?php echo $book['AuthorName']; ?></center></td>
                    <td><center><?php echo $book['CategoryName']; ?></center></td>
                    <td><center><?php echo $book['PublisherName']; ?></center></td>
                    <td><center><?php echo $book['BookPrice']; ?></center></td>
                    <td>
                    <center>
                    <?php if($book['BookStatus']==1){
                            echo "ปกติ";
                          }else{
                            echo "เลิกจำหน่าย";
                          } 
                    ?></center>
                    </td>
                    <td>
                    <a href="BookEdit.php?bookname=<?= $book['BookName']; ?>" class ="btn btn-success">แก้ไข</a>
                    <a href="BookDelete.php?delbook=<?= $book['BookName'];?>" class ="btn btn-danger">ลบ</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </table>
                
            </div>
        </div>
    <!-- </div> -->
    
</div>
