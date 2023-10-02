<?php
include 'connect.php'; // Including the 'connect.php' file to establish a database connection
include 'header.php'; // Including the 'header.php' file for the header section of the HTML page


// Delete Operation
if(isset($_POST['return'])){ // Checking if the 'return' form button is clicked

    // Only user admin can see this part

        $id = $_POST['bid']; // Getting the book ID from the form
        $sql = "UPDATE book SET book_status = 1 WHERE book_id='$id' "; // SQL query to update the book status to indicate it has been returned
        mysqli_query($conn, $sql); // Executing the SQL query
        date_default_timezone_set("Asia/Kuala_Lumpur"); // Setting the default timezone to Kuala Lumpur
        $current = date('Y-m-d H:i:s'); // Getting the current date and time

        $borrowid = $_POST['borrowid']; // Getting the borrow ID from the form
        $sqlI = "UPDATE borrow SET returned_at = '$current' WHERE borrow_id = '$borrowid'"; // SQL query to update the return date and time for the borrow record
 
        if(mysqli_query($conn, $sqlI)){ // Executing the SQL query
            echo "<script>
                    alert('Successfully return book!');
                    window.location.href= 'borrowrecord.php';
                  </script>"; // Displaying a success message and redirecting to 'borrowrecord.php' page
        } else {
            echo "<script>
                    alert('Failed to return book!');
                    window.location.href= 'borrowrecord.php';
                  </script>"; // Displaying an error message and redirecting to 'borrowrecord.php' page
        }
        mysqli_close($conn); // Closing the database connection
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
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){ ?>
                    <th scope="col">Borrow By</th>
                    <?php } ?>
                    <th scope="col">Borrowed At</th>
                    <th scope="col">Returned At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $userid = $_SESSION['id']; // Getting the user ID from the session
                $sql = "SELECT * FROM borrow INNER JOIN crud on borrow.user_id = crud.id INNER JOIN book ON borrow.book_id = book.book_id WHERE borrow.user_id = '$userid'"; // SQL query to retrieve borrow records and associated book and user information
                $result = mysqli_query($conn, $sql); // Executing the SQL query

                if (mysqli_num_rows($result) > 0) { // Checking if there are any borrow records
                    while ($row = mysqli_fetch_assoc($result)) { // Looping through each borrow record

                        if(empty($row['returned_at'])){
                            $return = '-';
                        }else{
                            $return = $row['returned_at'];
                        }
                        echo "<tr>";
                        echo "<td><img src='upload/".$row['book_cover']."' width='120'/></td>"; // Displaying the book cover image
                        echo "<td>
                                <div class='booktitle'>" . $row['book_title'] . "</div> 
                                <div>Author: " . $row['book_author'] . "</div>
                                <div>Publication Year: " . $row['book_publication_year'] . "</div>
                              </td>";

                        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){ 
                        echo "<td>
                                <div>Name: " . $row['name'] . "</div>
                                <div>Email: " . $row['email'] . "</div>
                                <div>Mobile: " . $row['mobile'] . "</div>
                              </td>";
                        }   
                        echo "<td>".$row['borrow_at']."</td>";
                        echo "<td>".$return."</td>";
                         

                        if(empty($row['returned_at'])){
                        echo "<td>
                            <div class='bookgroup'>
                                <form method='POST' action='borrowrecord.php' onsubmit='javascript:return confirm(\"Confirm to return book?\")'>
                                    <input value='".$row['book_id']."' name='bid' type='hidden' />
                                    <input value='".$row['borrow_id']."' name='borrowid' type='hidden' />
                                    <button type='submit' name='return' class='btn btn-danger'>Return Now</button>
                                </form>
                            </div>
                        </td>";
                        }else{

                            echo "<td>Returned</td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No Borrow Book Data found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <center><button class="btn btn-primary my-5"><a href="booklist.php" class="text-light">Borrow More Book Now</a></button> </center>
        
</body>
</html>
<?php
include 'footer.php';
?>