<?php require '../includes/autoload.inc.php'; ?>
 <?php require '../templates/navbar.php'; ?>
 <?php require '../templates/header.php'; ?>
       
 <?php

 // initializing object of DatabasePost class

$editProfile = new DatabasePost();

// updating post section starts

if (isset($_POST['update_profile'])) {
    $id = $_GET['profile_id'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    $editProfile->updateProfile($id, $email, $username);

    $_SESSION['username'] = $username;
}

// update post section ends

if (isset($_GET['profile_id'])) {
    $id = $_GET['profile_id'];

    $posts = $editProfile->editProfile($id);

    foreach ((array) $posts as $post) {
        if ($_SESSION['user_id'] !== $post['id']) {
            header('location: http://localhost/clean-blog/index.php');
        }
        ?> 
 
     
       


    <!-- Main Content-->
<div class="container px-4 px-lg-5">

 

<form method="POST" action="profile.php?profile_id=<?php echo $id; ?>" enctype="multipart/form-data">
  <!-- Email input -->

  <div class="form-outline mb-4">
    <input type="email" name="email" value="<?php echo $post['email']; ?>" id="form2Example1" class="form-control" placeholder="email" />
    
  </div>

  <div class="form-outline mb-4">
    <input type="text" name="username" value="<?php echo $post['username']; ?>" id="form2Example1" class="form-control" placeholder="user name"   />
</div>
 

  <!-- Submit button -->
  <button type="submit" name="update_profile" class="btn btn-primary  mb-4 text-center">Update</button>
<a href="http://localhost/clean-blog/index.php" class="btn btn-danger mb-4 text-center">Cancel</a>

          
            </form>


           
        </div>

        <?php
    }
} else {
    header('location: http://localhost/clean-blog/404.php');
}

?>
        <?php require '../templates/footer.php'; ?>
