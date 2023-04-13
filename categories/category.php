
<?php require '../includes/autoload.inc.php'; ?>
<?php require '../templates/navbar.php'; ?>
<?php require '../templates/header.php'; ?>

<!-- initialization of the object starts -->

<?php

$dataPost = new DatabasePost();

if (isset($_GET['category_id'])) {
    $id = $_GET['category_id'];

    $mainCategory = $dataPost->postCategories($id);
} else {
    header('location: http://localhost/clean-blog/404.php');
}

?>

<!-- initialization of the object ends -->

<div class="row gx-4 gx-lg-5 justify-content-center">
<div class="col-md-10 col-lg-8 col-xl-7">


<!-- Post preview-->
<?php foreach ((array) $mainCategory as $posts) { ?>  


<div class="post-preview">


<a href="http://localhost/clean-blog/posts/post.php?post_id=<?php echo $posts['id']; ?>">

<h2 class="post-title"><?php echo $posts['title']; ?></h2>
<h3 class="post-subtitle"><?php echo $posts['subtitle']; ?></h3>

</a>


<p class="post-meta">
Posted by
<a href="#!"><?php echo $posts['user_name']; ?></a>
on <?php echo date('M', strtotime($posts['created_at'])).','.date('D', strtotime($posts['created_at'])).','
.date('Y', strtotime($posts['created_at'])); ?>
</p>

</div>

 
<?php
} ?>
                    <!-- Divider-->
                    <hr class="my-4" />
                    
                    <!-- Pager-->
                    
                </div>
            </div>

<?php require '../templates/footer.php'; ?>
