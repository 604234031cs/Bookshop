<?php 
    require 'config.php';
    require 'header.php';
    session_start(); 
    $nameBook = $_SESSION["bookname"];
    // echo $nameBook; 

    if(isset($_POST['editbook'])){
        // echo $_POST['bookname'].'<br>';
        // echo $_POST['category'].'<br>';
        // echo $_POST['auther'].'<br>';
        // echo $_POST['publissher'].'<br>';
        //     echo $_POST['about'].'<br>';
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
        if($status==1){

        }
        $sql = "UPDATE books set CategoryID ='$cat',AuthorID='$aut',PublisherID='$pub',BookName='$name',BookDescription='$abou',BookPrice='$pric',BookStatus='$status',BookISBN='$isbn',BookNumPages='$page' WHERE BookName ='$nameBook'";
        $stm = $connection->prepare($sql);
        if($stm->execute()){       
            $sql1 = "SELECT books.BookName,authors.AuthorName,categories.CategoryName,
            publishers.PublisherName,books.BookPrice,books.BookStatus,books.BookDescription,
            books.BookNumPages,books.BookISBN
            FROM books,authors,categories,publishers
            WHERE books.AuthorID = authors.AuthorID
            and books.CategoryID = categories.CategoryID
            and books.PublisherID = publishers.PublisherID
            and BookName ='$name'";
            $stm = $connection->prepare($sql1);
            $stm->execute();
            $editbook = $stm->fetch(PDO::FETCH_ASSOC);
        }
    }

?>

<div>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
            <h2>ข้อมูลหนังสือ</h2>
            </div>
            <div class="card-body">
            <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm" ><b> ชื่อหนังสือ</b></label><b> 
      </b>      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm" ><?= $editbook['BookName'];?> </label><br>
            </div>
            <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm" ><b> ผู้แต่ง </b></label>
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><?= $editbook['AuthorName'];?> </label> <br>
            </div>  
            <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><b> ประเภทหนังสือ</b></label>
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><?= $editbook['CategoryName'];?> </label> <br> 
            </div>  
            <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><b> สำนักพิมพ์ </b></label>
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><?= $editbook['PublisherName'];?> </label>  <br>
            </div>  
            <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><b>คำอธิบาย</b></label>
            <!-- <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><?= $editbook['BookDescription'];?> </label><br>  -->
            <textarea for="colFormLabelSm" class="col col-form-label-sm" rows="3" name="about" readonly>
                    <?= $editbook['BookDescription'];?>
                </textarea>
        </div> 
            <div class="form-group row">   
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><b> ราคา</b></label><br>
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><?= $editbook['BookPrice'];?> </label>  <br>
            </div>  
            <div class="form-group row"> 
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><b> สถานะการขาย</b></label>
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">
            <?php if($editbook['BookStatus']==1){
                            echo "ปกติ";
                          }else{
                            echo "เลิกจำหน่าย";
                    } 
                ?>
            
            </label>  <br> 
            </div>
            <div class="form-group row"> 
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><b> ISBN </b></label>
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><?= $editbook['BookISBN'];?> </label>  <br> 
            </div>
            <div class="form-group row"> 
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><b> จำนวนหน้า</b></label>
            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm"><?= $editbook['BookNumPages'];?> </label>   
            </div>
        </div>
    </div>

</div>