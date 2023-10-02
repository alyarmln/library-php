<?php
include 'connect.php';
include 'header.php';


// Delete Operation
if(isset($_POST['delete'])){
        $id = $_POST['bid'];
        $oldpath = $_POST['imagepath'];

        if(!empty($oldpath)){
              if (file_exists("upload/".$oldpath)) {
                  unlink("upload/".$oldpath);
              } 
        }

        $sql = "DELETE FROM book WHERE book_id='$id'";
 
        if(mysqli_query($conn, $sql)){
            echo "<script>
                    alert('Successfully delete book!');
                    window.location.href= 'displaybook.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Failed to delete book!');
                    window.location.href= 'displaybook.php';
                  </script>";
        }
        mysqli_close($conn);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <style type="text/css">
        .table thead tr th{
            white-space: nowrap;
        }

        .bookgroup{
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    
        
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Book ID</th>
                    <th scope="col">Cover Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Publication Year</th>
                    
                    <th scope="col">Operation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `book`";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['book_id'] . "</td>";
                        echo "<td><img src='upload/".$row['book_cover']."' width='120'/></td>";
                        echo "<td>" . $row['book_title'] . "</td>";
                        echo "<td>" . $row['book_author'] . "</td>";
                        echo "<td>" . $row['book_publication_year'] . "</td>";
                        echo "<td>
                            <div class='bookgroup'>
                                <a href='editbook.php?id=" . $row['book_id'] . "' class='btn btn-primary'>Edit</a>
                                <form method='POST' action='displaybook.php' onsubmit='javascript:return confirm(\"Confirm to delete book info?\")'>
                                 <input value='".$row['book_id']."' name='bid' type='hidden' />
                                 <input value='".$row['book_cover']."' name='imagepath' type='hidden' />
                                 <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                                </form>
                            </div>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No data found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <center><button class="btn btn-primary my-5"><a href="addbook.php" class="text-light">Add New Book Here</a></button> </center>
</body>
</html>
<?php
include 'footer.php';
?>