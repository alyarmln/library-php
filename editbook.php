<?php
include 'connect.php';
include 'header.php';


if(isset($_POST['submit'])){

        $id = $_POST['id'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $year = $_POST['year'];
        $oldpath = $_POST['oldpath'];
       
            $sql = "UPDATE book SET book_title='$title', book_author = '$author', book_publication_year = '$year' ";
            
            if(isset($_FILES['image']['name']) && $_FILES['image']["name"] != '' ){

                $img = $_FILES['image'];
                $filename = date('YmdHis').'_'.(str_replace(' ','',$img['name']));
                $path = $img['tmp_name'];
                $move = move_uploaded_file($path,'upload/'.$filename);

                if($move){
                    $sql .= ", book_cover = '$filename'";
                    if(!empty($oldpath)){
                          if (file_exists("upload/".$oldpath)) {
                              unlink("upload/".$oldpath);
                          } 
                    }
                }

            }

            $sql .= "WHERE book_id = '$id'";

            if (mysqli_query($conn, $sql)) {

                $msg = "Successfully update book info";
                $status = "success";
                $_SESSION['msg'] = $msg;
                $_SESSION['msg_status'] = $status;
                header('location:editbook.php?id='.$id);
                exit();
                
            
            } else {
            
                $msg = "Failed to update book";
                $status = "danger";
                $_SESSION['msg'] = $msg;
                $_SESSION['msg_status'] = $status;
                header('location:editbook.php?id='.$id);
                exit();
            }



}



if(isset($_GET['id']) && !empty($_GET['id'])){

    $edtid = $_GET['id'];
    $sqlE = "SELECT * FROM book WHERE book_id = '$edtid'";
    $resultE = mysqli_query($conn, $sqlE);
    $rowE = mysqli_fetch_assoc($resultE);

}else{

    echo "<script>alert('Please select one record first');</script>";
    echo "<script>window.location.href = 'displaybook.php';</script>";

}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">

    <title>Edit Book</title>
</head>

<body>
    <div class="container my-5">
        <h1>Edit Book</h1>
        <?php if(isset($_SESSION['msg'])): ?>
            <ul class="alert alert-<?php echo $_SESSION['msg_status']?>"><?php echo $_SESSION['msg']?></ul>
        <?php unset($_SESSION['msg']); unset($_SESSION['msg_status'] );?>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" class="form-control" id="id" name="id" placeholder="Enter ID" value="<?php echo $rowE['book_id']; ?>">
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" placeholder="Enter Book Title" name="title" autocomplete="off" required value="<?php echo $rowE['book_title']; ?>">
            </div>

            <div class="form-group">
                <label>Author</label>
                <input type="text" class="form-control" placeholder="Enter Book Author" name="author" autocomplete="off" required value="<?php echo $rowE['book_author']; ?>">
            </div>

            <div class="form-group">
                <label>Publication Year</label>
                <input type="text" class="form-control" placeholder="Enter Book Publication Year" name="year" autocomplete="off" required value="<?php echo $rowE['book_publication_year']; ?>"> 
            </div>

            <input type="hidden" class="form-control" id="oldpath" name="oldpath" required  value="<?php echo $rowE['book_cover']; ?>"> 

            <div class="form-group">
                <label>New Cover Image (Optional)</label>
                <input type="file" class="form-control"  name="image" accept="image/*">
            </div>

            <div class="form-group">
                <label>Book Cover</label>
                <div>
                    <img src="upload/<?php echo $rowE['book_cover']; ?>" width="200" />
                </div>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>
<?php
include 'footer.php';
?>