<?php
include 'connect.php';
include 'header.php';


if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];

    if(isset($_FILES['image']['name']) && $_FILES['image']["name"] != '' ){

            $img = $_FILES['image'];
            $filename = date('YmdHis').'_'.(str_replace(' ','',$img['name']));
            $path = $img['tmp_name'];
            $move = move_uploaded_file($path,'upload/'.$filename);
            
            $sql = "INSERT INTO book (book_title, book_author, book_publication_year, book_cover, book_status) VALUES ('$title', '$author', '$year' ,'$filename', 1)";

            $query_run = mysqli_query($conn, $sql);

           
            if ($query_run) {

                $msg = "Successfully save new book";
                $status = "success";
                $_SESSION['msg'] = $msg;
                $_SESSION['msg_status'] = $status;
                header('location:addbook.php');
                exit();
            
            } else {
                $msg = "Failed save new book";
                $status = "danger";
                $_SESSION['msg'] = $msg;
                $_SESSION['msg_status'] = $status;
                header('location:addbook.php');
                exit();
            
            }

    }

   
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

    <title>New Book</title>
</head>

<body>
    <div class="container my-5">
        <h1>New Book</h1>
        <?php if(isset($_SESSION['msg'])): ?>
            <ul class="alert alert-<?php echo $_SESSION['msg_status']?>"><?php echo $_SESSION['msg']?></ul>
        <?php unset($_SESSION['msg']); unset($_SESSION['msg_status'] );?>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" placeholder="Enter Book Title" name="title" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label>Author</label>
                <input type="text" class="form-control" placeholder="Enter Book Author" name="author" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label>Publication Year</label>
                <input type="text" class="form-control" placeholder="Enter Book Publication Year" name="year" autocomplete="off" required> 
            </div>

            <div class="form-group">
                <label>Cover Image</label>
                <input type="file" class="form-control"  name="image" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>
<?php
include 'footer.php';
?>