<?php 
    require 'header.php';
    require 'config.php';
    $message = "";
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

    if(isset($_POST['addbook'])){
        // echo $_POST['bookname'].'<br>';
        // echo $_POST['category'].'<br>';
        // echo $_POST['auther'].'<br>';
        // echo $_POST['publissher'].'<br>';
        // echo $_POST['about'].'<br>';
        // echo $_POST['BookPrice'].'<br>';
        // echo $_POST['BookNumPages'].'<br>';
        // echo $_POST['BookISBN'].'<br>';
        // echo $_POST['status'].'<br>';
        $name =  $_POST['bookname'];
        $cat = $_POST['category'];
        $aut = $_POST['auther'];
        $pub = $_POST['publissher'];
        $abou = $_POST['about'];
        $pric =$_POST['BookPrice'];
        $page = $_POST['BookNumPages'];
        $isbn = $_POST['BookISBN'];
        $status = $_POST['status'];
        
        $sql = "INSERT INTO books(CategoryID, AuthorID, PublisherID, BookName, BookDescription, BookPrice, BookStatus, BookISBN, BookNumPages) 
        VALUES ('$cat','$aut','$pub','$name','$abou ','$pric',' $status',' $isbn','$page')";
        $stm = $connection->prepare($sql);
        if($stm->execute()){
            $message = "เพิ่มหนังสือสำเร็จ";
            header("refresh:2;BookList.php"); 
        }else{
            echo "เกิดข้อผิดพลาด";
        }
    }


?>

<div>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2><b><b> ข้อมูลหนังสือ</b></h2>
            </div>
            <div class="card-body">
            <?php if(!empty($message)): ?>
                <div class="alert alert-success">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
                <form method="POST">  
                <div class="form-group row">
                <label  for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><b> ชื่อหนังสือ</b></label>
                <input type="text" name="bookname"><br>
                </div>
                <!-- dropdown category-->
                <div class="form-group row">
                <label  for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><b> ประเภทหนังสือ</b></label>
                <select name="category">
                <?php foreach($cat as $list): ?>
                <option value="<?php echo $list['CategoryID']; ?>">
                <?php echo $list['CategoryName'];?>
                </option>
                <?php endforeach; ?>
               </select><br>
                <!-- dropdown auther-->
                </div>
                <div class="form-group row">
                 <label  for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><b> ผู้แต่ง</b></label>
                 <select name="auther">
                <?php foreach($aut as $auts): ?>
                    <option value="<?php echo $auts['AuthorID']; ?>">
                    <?php echo $auts['AuthorName'];?>
                    </option>
                <?php endforeach; ?>
               </select><br> 
               </div>
                <!-- dropdown publissher-->
                <div class="form-group row">
               <label  for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><b> สำนักพิมพ์</b></label>
               <select name="publissher">
                <?php foreach($pub as $publis): ?>
                <option value="<?php echo $publis['PublisherID']; ?>">
                <?php echo $publis['PublisherName']; ?>
                </option>
                <?php endforeach; ?>
               </select><br>  
               </div>
                <!-- คำอธิบาย -->
                <div class="form-group">
                <label for="exampleFormControlTextarea1"><b> คำอธิบาย</b></label>
                <textarea class="form-control" rows="3" name="about"required>
                </textarea>
                </div>
                <!-- ราคา -->
                <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><b>ราคา</b></label>
                <input type="number" name="BookPrice" pattern="([1-9])+(?:-?\d){4,}" title ="ใส่ตัวเลขเท่านั้น" required><br>
                </div>
                <div class="form-group row">
                <!-- จำนวนหน้า -->
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><b>จำนวนหน้า</b></label>
                <input type="number" name="BookNumPages"  pattern="([1-9])+(?:-?\d){4,}" title ="ใส่ตัวเลขเท่านั้น" required><br>
                </div>
                <div class="form-group row">
                <!-- ISBN -->
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><b>ISBN</b></label>
                <input type="text" name="BookISBN" required><br>
                </div>
                <!-- Radio สถานะการขาย -->
                <label ><b> สถานะการขาย</b></label><br>
                        <input type="radio" name="status" Value="1" checked>
                        <label>ปกติ</label>
                        <input type="radio" name="status" Value="0" >
                        <label>เลิกจำหน่าย</label><br>
                <center><input type="submit" class="btn btn-success btn-lg "  name="addbook" value ="บันทึก">
                <a href="Booklist.php" class="btn btn-secondary btn-lg">ยกเลิก</a>
                </center>
                </form>
            </div>
        </div>
    </div>
</div>