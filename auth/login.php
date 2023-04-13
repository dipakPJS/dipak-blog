 <?php

require '../includes/autoload.inc.php'; ?>
<?php require '../templates/navbar.php'; ?>
<?php require '../templates/header.php'; ?>

<?php

// using session

if (isset($_SESSION['username'])) {
    header('location: http://localhost/clean-blog/index.php');
}

// initiatin object of class DatabasePost

$login = new DatabasePost();

if (isset($_POST['login'])) {
    if ($_POST['email'] == '' or $_POST['password'] == '') {
        echo "<div class='alert alert-danger bg-danger text-center text-white' role='alert'>
                Enter data into inputs
                </div>";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        echo $login->loginUser($email, $password);
    }
}?> 

 

<form method="POST" action="login.php">
<!-- Email input -->
<div class="form-outline mb-4">
<input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />

</div>


<!-- Password input -->
<div class="form-outline mb-4">
<input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />

</div>



<!-- Submit button -->
<button type="submit" name="login" class="btn btn-primary  mb-4 text-center">Login</button>

<!-- Register buttons -->
<div class="text-center">
<p>a new member? Create an acount<a href="register.php"> Register</a></p>



</div>
</form>

<?php require '../templates/footer.php'; ?>
