<?php
// include 'connect.php';
include 'homeheader.php';
?>

<div class="p-5 mb-4 bg-light rounded-3">

	<div class="container-fluid py-5">

		<h1 class="display-5 fw-bold">RaYa Library System</h1>

		<p class="fs-4">Welcome to our library, a haven for knowledge seekers and book lovers alike. Discover the treasures that await within our virtual shelves and embark on a literary journey that knows no bounds. Happy exploring!</p>

	</div>

</div>

<section style=" min-height: 450px; " >

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" img src="https://blog.kotobee.com/wp-content/uploads/2018/11/kuala-lampur-international-book-fair.jpg" style=" width: 100%; height: 500px;"  alt="First slide">
    </div>

    <div class="carousel-item">
      <img class="d-block w-100" img src="https://i.ytimg.com/vi/3hYSxVuJqZA/maxresdefault.jpg" style=" width: 100%; height: 500px;" alt="Second slide">
    </div>

    </div>
<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>



<div class="row align-items-md-stretch">

	<div class="col-md-6">

		<div class="h-100 p-5 text-white bg-dark rounded-3">

			<h2>Admin Login</h2>
			<p></p>
			<a href="adminlogin.php" class="btn btn-outline-light">Admin Login</a>

		</div>

	</div>

	<div class="col-md-6">

		<div class="h-100 p-5 bg-light border rounded-3">

			<h2>User Login</h2>

			<p></p>

			<a href="userlogin.php" class="btn btn-outline-secondary">User Login</a>


		</div>

	</div>

</div>







<?php
include 'footer.php';
?>