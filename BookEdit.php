<?php 
    require 'header.php';
    require 'config.php';
    session_start(); 
    $bookname = $_GET['bookname'];
    $_SESSION["bookname"] = $bookname;
    // echo $bookname;
    $sql = "SELECT books.BookName,authors.AuthorName,categories.CategoryName,
    publishers.PublisherName,books.BookPrice,books.BookStatus,books.BookDescription,
    books.BookNumPages,books.BookISBN,categories.CategoryID,publishers.PublisherID,
    authors.AuthorID
    FROM books,authors,categories,publishers
    WHERE books.AuthorID = authors.AuthorID
    and books.CategoryID = categories.CategoryID
    and books.PublisherID = publishers.PublisherID
    and books.BookName = '$bookname'";
    $stm = $connection->prepare($sql);
    $stm->execute();
    $books = $stm->fetch(PDO::FETCH_ASSOC);

    $sql1 = "SELECT * FROM `categories`";
    $stm = $connection->prepare($sql1);
    $stm->execute();
    $cat = $stm->fetchAll(PDO::FETCH_ASSOC);

    $sql2 = "SELECT * FROM `authors`";
    $stm = $connection->prepare($sql2);
    $stm->execute();
    $aut = $stm->fetchAll(PDO::FETCH_ASSOC);

    $sql3 = "SELECT * FROM `publishers`";
    $stm = $connection->prepare($sql3);
    $stm->execute();
    $pub = $stm->fetchAll(PDO::FETCH_ASSOC);

    
?>

<div>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>ข้อมูลหนังสือ</h2>
            </div>
            <div class="card-body">
            <form action="BookEditComplete.php" method="POST" class="needs-validation" novalidate >
                
                <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm" >ชื่อหนังสือ</label>
                <div class="col-sm-10">
                <input type="text" name="bookname" class="form-control" value= "<?= $books['BookName'];?>">
                </div>
                </div>
                <!-- dropdown category-->
                <div class="form-group row">
                <label  for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">ประเภทหนังสือ</label>
                <select name="category">
                <option value ="<?= $books['CategoryID'];?>"><?= $books['CategoryName']; ?></option>
                <?php foreach($cat as $list): ?>
                <option value="<?php echo $list['CategoryID']; ?>">
                <?php echo $list['CategoryName'];?>
                </option>
                <?php endforeach; ?>
               </select><br>
                <!-- dropdown auther-->
                </div>
                <div class="form-group row">
               <label  for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">ผู้แต่ง</label>
                 <select name="auther">
                <option value="<?= $books['AuthorID'];?>"><?= $books['AuthorName'];?></option>
                <?php foreach($aut as $auts): ?>
                    <option value="<?php echo $auts['AuthorID']; ?>">
                    <?php echo $auts['AuthorName'];?>
                    </option>
                <?php endforeach; ?>
               </select>
               </div> 
                <!-- dropdown publissher-->
                <div class="form-group row">
               <label  for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">สำนักพิมพ์</label>
               <select name="publissher">
                <option value="<?= $books['PublisherID'];?>"readonly><?= $books['PublisherName'];?></option>
                <?php foreach($pub as $publis): ?>
                <option value="<?php echo $publis['PublisherID']; ?>">
                <?php echo $publis['PublisherName']; ?>
                </option>
                <?php endforeach; ?>
               </select>
               </div>   
                <!-- คำอธิบาย -->
                <div class="form-group">
                <label for="exampleFormControlTextarea1">คำอธิบาย</label>
                <textarea class="form-control" rows="3" name="about" >
                <?= $books['BookDescription'];?>
                </textarea>
                </div>
                <!-- ราคา -->
                <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm" >ราคา</label>
                <input type=""  name="BookPrice" value = "<?= $books['BookPrice'];?>" pattern="([1-9])+(?:-?\d){4,}" title ="ใส่ตัวเลขเท่านั้น">
                </div>
         
                <!-- จำนวนหน้า -->
                <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">จำนวนหน้า</label>
                <input type="number" name="BookNumPages" value = "<?= $books['BookNumPages'];?>" pattern="([1-9])+(?:-?\d){4,}" title ="ใส่ตัวเลขเท่านั้น">
                </div>
                <!-- ISBN -->
                <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">ISBN</label>
                <input type="text" name="BookISBN" value="<?= $books['BookISBN'];?>"><br>
                </div>
                <!-- Radio สถานะการขาย -->
                <label >สถานะการขาย</label><br>
                    <?php if($books['BookStatus']==1): ?>
                        <input type="radio" name="status" Value="1" checked>
                        <label>ปกติ</label>
                        <input type="radio" name="status" Value="0" >
                        <label>เลิกจำหน่าย</label>
                            <?php else: ?>
                            <input type="radio" name="status" Value="1">
                            <label>ปกติ</label>
                            <input type="radio" name="status" Value="0" checked>
                            <label>เลิกจำหน่าย</label> 
                    <?php endif; ?><br>
                <center><input type="submit" class="btn btn-primary btn-lg" name="editbook" value ="บันทึก">
                <a href="Booklist.php" class="btn btn-secondary btn-lg">ยกเลิก</a></center>
                </form>
            </div>
        </div>
    </div>
</div>
