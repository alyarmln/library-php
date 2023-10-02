<?php
include 'connect.php';
include 'header.php';


// Delete Operation
if(isset($_POST['borrow'])){

        $id = $_POST['bid'];
        $sql = "UPDATE book SET book_status = 0 WHERE book_id='$id' ";
        mysqli_query($conn, $sql);

        $uid = $_SESSION['id'];
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $current = date('Y-m-d H:i:s');

        $sqlI = "INSERT INTO borrow (book_id, user_id, borrow_at) VALUES ('$id', '$uid', '$current')";
 
        if(mysqli_query($conn, $sqlI)){
            echo "<script>
                    alert('Successfully borrow book!');
                    window.location.href= 'booklist.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Failed to borrow book!');
                    window.location.href= 'booklist.php';
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

        .booktitle{
            font-size: 18px;
            font-weight: 600;
            padding-top: 6px;
            padding-bottom: 6px;
        }
    </style>
</head>
<body>
    
        
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Cover Image</th>
                    <th scope="col">Book Infomation</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `book` WHERE book_status = 1";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td><img src='upload/".$row['book_cover']."' width='120'/></td>";
                        echo "<td>
                                <div class='booktitle'>" . $row['book_title'] . "</div>
                                <div>Author: " . $row['book_author'] . "</div>
                                <div>Publication Year: " . $row['book_publication_year'] . "</div>
                              </td>";
                       
                        echo "<td>
                            <div class='bookgroup'>
                                <form method='POST' action='booklist.php' onsubmit='javascript:return confirm(\"Confirm to borrow book?\")'>
                                    <input value='".$row['book_id']."' name='bid' type='hidden' />
                                    <button type='submit' name='borrow' class='btn btn-danger'>Borrow</button>
                                </form>
                            </div>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No Book Data found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
</body>
</html>
<?php
include 'footer.php';
?>