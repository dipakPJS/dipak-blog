 <?php require '../includes/autoload.inc.php'; ?>
 <?php require '../templates/navbar.php'; ?>
 <?php require '../templates/header.php'; ?>
       
 <?php

 // initializing object of DatabasePost class

$showUpdate = new DatabasePost();

// updating post section starts

if (isset($_POST['update'])) {
    if ($_POST['title'] == '' or $_POST['subtitle'] == '' or $_POST['body'] == '') {
        echo "<div class='alert alert-danger bg-danger text-center text-white' role='alert'>
                Enter data into inputs
                </div>";
    } else {
        $id = $_GET['update_id'];
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $body = $_POST['body'];
        $img = $_FILES['img']['name'];

        // image folder directory

        $dir = 'images/'.basename($img);

        $showUpdate->updatePost($id, $title, $subtitle, $body, $img);
    }

    if (move_uploaded_file($_FILES['img']['tmp_name'], $dir)) {
        header('location: http://localhost/clean-blog/index.php');
    }

    if ($_SESSION['user_id'] !== $post['user_id']) {
        header('location: http://localhost/clean-blog/index.php');
    }
}

// update post section ends

if (isset($_GET['update_id'])) {
    $id = $_GET['update_id'];

    $posts = $showUpdate->editPost($id);

    foreach ((array) $posts as $post) {
        ?> 
 
     
       


    <!-- Main Content-->
<div class="container px-4 px-lg-5">

<form method="POST" action="update.php?update_id=<?php echo $id; ?>" enctype="multipart/form-data">
  <!-- Email input -->

  <div class="form-outline mb-4">
    <input type="text" name="title" value="<?php echo $post['title']; ?>" id="form2Example1" class="form-control" placeholder="title" required />
    
  </div>

  <div class="form-outline mb-4">
    <input type="text" name="subtitle" value="<?php echo $post['subtitle']; ?>" id="form2Example1" class="form-control" placeholder="subtitle"  required />
</div>

  <div class="form-outline mb-4">
  <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="body" rows="8" required><?php echo $post['body']; ?></textarea>
</div>

<?php echo "<img src='images/".$post['img']."' width=auto height=300px> "; ?>

  
  <div class="form-outline mb-4">
    <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" required/>
</div>

  <!-- Submit button -->
  <button type="submit" name="update" class="btn btn-primary  mb-4 text-center">Update</button>
<a href="http://localhost/clean-blog/index.php" class="btn btn-danger mb-4 text-center">Cancel</a>

          
            </form>


           
        </div>

        <?php
    }
}

?>
        <?php require '../templates/footer.php'; ?>
