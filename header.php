
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Library</title>

        <!-- Required meta tags --> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1, shrink-to-fit=no">


        <link rel="icon" href="images/ticketlogo.png">
        <!--Bootstrap CSS --> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
      </head>
</html>

<nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #374785;">
  <a class="navbar-brand" href="index.php"><img src="images/logo.png" style="width:65px;" ></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="home.php">Home</a>
      </li>
      <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){ ?>
      <li class="nav-item ">
        <a class="nav-link" href="displaybook.php">Book</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="displayuser.php">User </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="borrow.php">Borrow </a>
      </li>
      <?php }else if(isset($_SESSION['role']) && $_SESSION['role'] == 'user'){ ?>

      <li class="nav-item ">
        <a class="nav-link" href="booklist.php">All Book List</a>
      </li>

      <li class="nav-item ">
        <a class="nav-link" href="borrowrecord.php">Borrow Record</a>
      </li>

      <?php } ?>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
    <!---form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form---->
  </div>
</nav>








