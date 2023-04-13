<?php

require '../includes/autoload.inc.php'; ?>
<?php require '../templates/navbar.php'; ?>
<?php require '../templates/header.php'; ?>

<?php

// using session

if (isset($_SESSION['username'])) {
    header('location: http://localhost/clean-blog/index.php');
}

// initiating object of the class DatabasePost

$registerPost = new DatabasePost();

if (isset($_POST['register'])) {
    if ($_POST['email'] == '' or $_POST['username'] == '' or $_POST['password'] == '') {
        echo "<div class='alert alert-danger bg-danger text-center text-white' role='alert'>
     please fill all the input fields.
      </div>";
    } else {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $registerPost->registerUser($email, $username, $password);

        header('location: login.php');
    }
}

?>

<form method="POST" action="register.php">
<!-- Error input -->
<div class="form-outline mb-4 bg-danger">
  <h1></h1>
</div>
<!-- Email input -->
<div class="form-outline mb-4">
  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
  
</div>

<div class="form-outline mb-4">
  <input type="" name="username" id="form2Example1" class="form-control" placeholder="Username" />
  
</div>

<!-- Password input -->
<div class="form-outline mb-4">
  <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
  
</div>



<!-- Submit button -->
<button type="submit" name="register" class="btn btn-primary  mb-4 text-center">Register</button>

<!-- Register buttons -->
<div class="text-center">
  <p>Aleardy a member? <a href="login.php">Login</a></p>
  

  
</div>
</form>

            <?php require '../templates/footer.php'; ?>


           
    