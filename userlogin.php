<?php
include 'connect.php';
include 'header.php';

$message = '';

if(isset($_POST["login_button"]))
{
    $formdata = array();

    if(empty($_POST["email"]))
    {
        $message .= '<li>Email Address is required</li>';
    }
    else
    {
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        {
            $message .= '<li>Invalid Email Address</li>';
        }
        else
        {
            $formdata['email'] = $_POST['email'];
        }
    }

    if(empty($_POST['password']))
    {
        $message .= '<li>Password is required</li>';
    }
    else
    {
        $formdata['password'] = $_POST['password'];
    }

    if($message == '')
    {
        $data = array(
            ':email' => $formdata['email']
        );

        $query = "SELECT * FROM crud WHERE email = :email";

        $statement = $connect->prepare($query);

        $statement->execute($data);

        if($statement->rowCount() > 0)
        {
            foreach($statement->fetchAll() as $row)
            {
                if($row['password'] == $formdata['password'])
                {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['role'] = "user";
                    header('Location: booklist.php');
         
                }
                else
                {
                    $message = '<li>Wrong Password</li>';
                }
            }
        }
        else
        {
            $message = '<li>Wrong Email Address</li>';
        }
    }
}

?>

<div class="d-flex align-items-center justify-content-center" style="height:700px;">
	<div class="col-md-6">
		
		<div class="card">
			<div class="card-header">User Login</div>
			<div class="card-body">
                <?php if($message): ?>
                <ul class="alert alert-danger"><?php echo $message; ?></ul>
                <?php endif; ?>
				<form method="POST">
					<div class="mb-3">
						<label class="form-label">Email address</label>
						<input type="text" name="email" id="email" class="form-control" />
					</div>
					<div class="mb-3">
						<label class="form-label">Password</label>
						<input type="password" name="password" id="password" class="form-control" />
					</div>
					<div class="d-flex align-items-center justify-content-between mt-4 mb-0">
						<input type="submit" name="login_button" class="btn btn-primary" value="Login" />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>






<?php
include 'footer.php';
?>