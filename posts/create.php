 <?php require '../includes/autoload.inc.php'; ?>
 <?php require '../templates/navbar.php'; ?>
 <?php require '../templates/header.php'; ?>

<?php

// initiating object of class DatabasePost()

$dataPost = new DatabasePost();

if (isset($_POST['submit'])) {
    if ($_POST['title'] == '' or $_POST['subtitle'] == '' or $_POST['body'] == '' or $_POST['category_id'] == '' or $_FILES['img']['name'] == '') {
        echo "<div class='alert alert-danger bg-danger text-center text-white' role='alert'>
     All the input must be filled
      </div>";
    } else {
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $body = $_POST['body'];
        $category_id = $_POST['category_id'];
        $img = $_FILES['img']['name']; // 'name' is html attribute and 'img' is attribute value
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['username'];
        $dir = 'images/'.basename($img);

        // using the createPost method from class DatabasePost()

        $dataPost->createPost($title, $subtitle, $body, $category_id, $img, $user_id, $user_name, $dir);
    }
}

?>

  <form method="POST" action="" enctype="multipart/form-data">
    <!-- Email input -->
    <div class="form-outline mb-4">
      <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title" />
      
    </div>

    <div class="form-outline mb-4">
      <input type="text" name="subtitle" id="form2Example1" class="form-control" placeholder="subtitle" />
  </div>

    <div class="form-outline mb-4">
      <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="body" rows="8"></textarea>
  </div>

          <!-- select option -->
          <div class="form-outline mb-4">

    <select name="category_id" class="form-select" aria-label="Default select example">
          <option selected>Open this select menu</option>
         
         <!-- == php code for category starts == -->

         <?php
foreach ((array) $dataPost->showCategories() as $category) {
    ?>
          <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
        
   <?php } ?>

     <!-- == php code for category ends == -->
        </select>
          
          </div>

          <!-- select option ends -->
    <div class="form-outline mb-4">
      <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" />
  </div>


    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


  </form>


    <?php require '../templates/footer.php'; ?>